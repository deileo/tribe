<?php

namespace Tribe\Factory;

use Tribe\Controller\Controller;

class MethodFactory
{
    private Controller $controller;
    private ?string $methodName;
    
    public function __construct(Controller $controller, ?string $methodName)
    {
        $this->controller = $controller;
        $this->methodName = $methodName;
    }

    public function getMethodName(): ?string
    {
        if (!$this->methodName) {
            return 'index';
        }

        if (!method_exists($this->controller, $this->methodName)) {
            return null;
        }

        return $this->methodName;
    }
}