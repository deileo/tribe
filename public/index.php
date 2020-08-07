<?php

use Tribe\Controller\Controller;
use Tribe\Controller\Error404Controller;
use Tribe\Factory\ControllerFactory;
use Tribe\Factory\MethodFactory;
use Tribe\Response\JsonResponse;

require "../vendor/autoload.php";

$controller = (new ControllerFactory())->buildController();
$methodName = explode(ControllerFactory::URL_DELIMITER, $_SERVER['REQUEST_URI']);
$method = (new MethodFactory($controller, $methodName !== false && count($methodName) >= 2 ? $methodName[2] : null))->getMethodName();

$response = getResponse($controller, $method);
header('Content-Type: application/json');
http_response_code($response->getStatus());

echo $response->serialize();


function getResponse(Controller $controller, ?string $method): JsonResponse {
    return $method ? $controller->{$method}() : (new Error404Controller())->index();
}