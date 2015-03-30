<?php

namespace Hiera\Backend;

use Symfony\Component\Yaml\Parser;

class YamlBackend extends AbstractFileBackend implements BackendInterface
{
    public function lookup($key, $scope, $order_override, $resolution_type, $context = null)
    {
        //echo "YAML: " . $key . "\n";
        $parser = new Parser();
        
        foreach ($this->datasources($scope, $order_override) as $source) {
            //echo " - source: " . $source->getKey() . "\n";
            $filename = $this->datafile($source->getKey(), $scope, $source, "yaml");
            if ($filename) {
                //echo "   file: " . $filename . "\n";
                $yaml = file_get_contents($filename);
                $data = $parser->parse($yaml);
                if (isset($data[$key])) {
                    $new_answer = $this->parse_answer($data[$key], $scope);
                    if ($new_answer) {
                        return $new_answer;
                    }
                }
            }
        }
        return null;
    }
}
