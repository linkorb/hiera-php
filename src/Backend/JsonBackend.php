<?php

namespace Hiera\Backend;

class JsonBackend extends AbstractFileBackend implements BackendInterface
{
    public function lookup($key, $scope, $order_override, $resolution_type)
    {
        echo "JSON: " . $key . "\n";
    }
}
