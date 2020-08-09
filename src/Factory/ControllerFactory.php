<?php

namespace Tribe\Factory;

use Tribe\Controller\ActionController;
use Tribe\Controller\Controller;
use Tribe\Controller\Error404Controller;
use Tribe\Controller\ErrorController;
use Tribe\Controller\HomeController;
use Tribe\Controller\PermissionController;
use Tribe\Controller\UserController;

class ControllerFactory
{
    public const URL_DELIMITER = '/';
    private const HOME_ROUTE = '';
    private const USER_ROUTE = 'users';
    private const ACTION_ROUTE = 'actions';
    private const PERMISSION_ROUTE = 'permissions';

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
            case self::USER_ROUTE:
                return new UserController();
            case self::ACTION_ROUTE:
                return new ActionController();
            case self::PERMISSION_ROUTE:
                return new PermissionController();
            default:
                return new Error404Controller();
        }
    }
}