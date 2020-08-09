<?php

use Tribe\Controller\Controller;
use Tribe\Controller\Error404Controller;
use Tribe\Factory\ControllerFactory;
use Tribe\Factory\MethodFactory;
use Tribe\Request\Request;
use Tribe\Response\JsonResponse;

require "../vendor/autoload.php";

$controller = (new ControllerFactory())->buildController();
$methodName = explode(ControllerFactory::URL_DELIMITER, $_SERVER['REQUEST_URI']);

$method = (new MethodFactory($controller, $methodName !== false && count($methodName) >= 2 ? $methodName[2] : null))->getMethodName();
$urlParam = array_key_exists(3, $methodName) && is_numeric($methodName[3]) ? $methodName[3] : null;
$response = getResponse($controller, $method, $urlParam);

header('Content-Type: application/json');
http_response_code($response->getStatus());

echo $response->serialize();

function getResponse(Controller $controller, ?string $method, ?int $urlParam): JsonResponse {
    $request = new Request(file_get_contents('php://input'), $urlParam);

    return $method ? $controller->{$method}($request) : (new Error404Controller())->index();
}