<?php

namespace Tribe\Factory;

use Tribe\Controller\Controller;
use Tribe\Controller\Error404Controller;
use Tribe\Controller\ErrorController;
use Tribe\Controller\HomeController;

class ControllerFactory
{
    public const URL_DELIMITER = '/';
    private const HOME_ROUTE = '';

    private string $url;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function buildController(): Controller
    {
        $parts = explode(self::URL_DELIMITER, $this->url);
        if ($parts === false || !count($parts)) {
            return new ErrorController();
        }

        switch ($parts[1]) {
            case self::HOME_ROUTE:
                return new HomeController();
            default:
                return new Error404Controller();
        }
    }
}