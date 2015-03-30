<?php

namespace Hiera;

class Scope
{
    private $variables = array();
    
    public function setVariable($key, $value)
    {
        $this->variables[$key] = $value;
    }
    
    public function getVariable($key)
    {
        return $this->variables[$key];
    }

    public function hasVariable($key)
    {
        if (isset($this->variables[$key])) {
            return true;
        }
        return false;
    }
    
    public function getVariables()
    {
        return $this->variables;
    }
}
