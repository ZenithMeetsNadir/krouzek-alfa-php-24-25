<?php

namespace App;

use App\Controller\BaseController;
use App\Controller\HomeController;
use App\Exception\ActionNotFoundException;
use App\Exception\ControllerNotFoundException;

final class Router {

    /**
     * @throws ControllerNotFoundException
     * @throws ActionNotFoundException
     */
    public function navigateRoute(): void {
        $defaultController = 'home';

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

        if (!method_exists($controllerInst, $actionQualfName)) {
            throw new ActionNotFoundException(
                "Action " . $actionQualfName . " not found on controller " . $controllerInst,
                404
            );
        }

        $controllerInst->$actionQualfName();
    }
}