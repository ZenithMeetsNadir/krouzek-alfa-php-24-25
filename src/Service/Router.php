<?php

namespace App\Service;

use App\Controller\BaseController;
use App\Exception\ActionNotFoundException;
use App\Exception\ControllerNotFoundException;
use App\Attribute\RequireAuth;
use ReflectionAttribute;
use ReflectionException;
use ReflectionObject;

final class Router {

    public const DEFAULT_CONTROLLER = 'home';

    /**
     * @throws ControllerNotFoundException
     * @throws ActionNotFoundException
     */
    public function navigateRoute(): void {
        $defaultController = self::DEFAULT_CONTROLLER;

        $route = empty($_GET['route']) ? $defaultController : $_GET['route'];

        $controllerAction = explode("/", $route);

        $controllerRoute = empty($controllerAction[0]) ? $defaultController : $controllerAction[0];
        $controllerInst = $this->controllerFactory($controllerRoute);

        $actionRoute = empty($controllerAction[1]) ? $controllerInst->defaultAction : $controllerAction[1];
        $this->callAction($controllerInst, $actionRoute);
    }

    /**
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     */
    public function navigate(string $controllerRoute, string $actionRoute): void {
        $controllerInst = $this->controllerFactory($controllerRoute);
        $this->callAction($controllerInst, $actionRoute);
    }

    /**
     * @throws ControllerNotFoundException
     */
    public function controllerFactory(string $controllerRoute): BaseController {
        $controllerQualfName = "App\Controller\\" .  ucfirst($controllerRoute) . "Controller";

        if (!class_exists($controllerQualfName)) {
            throw new ControllerNotFoundException(
                "Controller " . $controllerQualfName . " not found.",
                404
            );
        }

        return new $controllerQualfName();
    }

    /**
     * @throws ActionNotFoundException
     */
    public function callAction(BaseController $controllerInst, string $actionRoute): void {
        $actionQualfName = $actionRoute . "Action";

        $controllerInst->extractQuery();

        $reflection = new ReflectionObject($controllerInst);

        try {
            $action = $reflection->getMethod($actionQualfName);
        } catch (ReflectionException) {
            throw new ActionNotFoundException(
                "Action " . $actionQualfName . " not found on controller " . $controllerInst,
                404
            );
        }

        if (!empty($action->getAttributes(RequireAuth::class)))
            $controllerInst->requireAuth();

        $controllerInst->$actionQualfName();
    }

    public function getFullRoute(): string {
        $route = empty($_GET['route']) ? self::DEFAULT_CONTROLLER : $_GET['route'];

        $controllerAction = explode("/", $route);
        if (count($controllerAction) > 1 && !empty($controllerAction[1]))
            return $route;

        $controllerRoute = empty($controllerAction[0]) ? self::DEFAULT_CONTROLLER : $controllerAction[0];
        $controllerInst = $this->controllerFactory($controllerRoute);

        $actionRoute = empty($controllerAction[1]) ? $controllerInst->defaultAction : $controllerAction[1];

        return "$controllerRoute/$actionRoute";
    }
}