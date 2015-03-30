<?php

namespace Hiera\ConfigLoader;

use Hiera\Hiera;
use Hiera\DataSource;
use Hiera\Backend\YamlBackend;
use Hiera\Backend\JsonBackend;
use Symfony\Component\Yaml\Parser;

class YamlConfigLoader
{
    public function load(Hiera $hiera, $filename)
    {
        $parser = new Parser();
        $yaml = file_get_contents($filename);
        $data = $parser->parse($yaml);
        
        $datasources = array();
        
        foreach ($data[':hierarchy'] as $datasourcekey) {
            $datasource = new DataSource($datasourcekey);
            //$hiera->addDataSource($datasource);
            $datasources[] = $datasource;
        }

        foreach ($data[':backends'] as $backendkey) {
            switch ($backendkey) {
                case 'yaml':
                    $config = $data[':yaml'];
                    $datadir = $config[':datadir'];
                    if ($datadir[0]!='/') {
                        $datadir = dirname($filename) . '/' . $datadir;
                    }
                    $backend = new YamlBackend($datadir);
                    break;
                case 'json':
                    $config = $data[':json'];
                    $datadir = $config[':datadir'];
                    if ($datadir[0]!='/') {
                        $datadir = dirname($filename) . '/' . $datadir;
                    }
                    $backend = new JsonBackend($datadir);
                    break;
                default:
                    throw new RuntimeException("Unsupported backend: " . $backendkey);
            }
            $backend->setDataSources($datasources);
            $hiera->addBackend($backend);
        }

        //print_r($hiera);
    }
}
