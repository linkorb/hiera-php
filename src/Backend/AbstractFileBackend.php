<?php

namespace Hiera\Backend;

use Hiera\Scope;
use Hiera\DataSource;

abstract class AbstractFileBackend
{
    protected $datadir;
    
    public function __construct($datadir)
    {
        $this->datadir = $datadir;
    }
    
    protected $datasources = array();
    
    public function setDataSources($datasources)
    {
        $this->datasources = $datasources;
    }
    
    public function datasources(Scope $scope, $order_override = null)
    {
        $res = array();
        foreach ($this->datasources as $datasource) {
            $key = $datasource->getKey();
            foreach ($scope->getVariables() as $var => $val) {
                $key = str_replace('%{' . $var . '}', $val, $key);
            }
            $s = new DataSource($key);
            $res[] = $s;
        }
        return $res;
    }

    public function datafile($backend, Scope $scope, DataSource $datasource, $extension)
    {
        // use $backend to resolve settings
        
        $filename = $this->datadir . '/' . $datasource->getKey() . '.' . $extension;
        if (file_exists($filename)) {
            return realpath($filename);
        }
        return null;
    }
    
    public function parse_answer($data, Scope $scope)
    {
        foreach ($scope->getVariables() as $var => $val) {
            $data = str_replace('%{' . $var . '}', $val, $data);
        }
        return $data;
    }
}
