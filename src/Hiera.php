<?php

namespace Hiera;

use Hiera\Backend\BackendInterface;

class Hiera
{
    private $backends = array();
    //private $sources = array();
    
    public function addBackend(BackendInterface $backend)
    {
        $this->backends[] = $backend;
    }
    
    /*
    public function addSource(Source $source)
    {
        $this->sources[] = $source;
    }
    */
    
    public function lookup($key, $default, Scope $scope, $order_override = null, $resolution_type = null)
    {
        foreach ($this->backends as $backend) {
            $value = $backend->lookup($key, $scope, $order_override, $resolution_type);
            if ($value) {
                return $value;
            }
        }
        return $default;
    }
}
