<?php

namespace DevFullStack\Route;

use DevFullStack\Controller\UserController;

class Route
{
    public static function routes()
    {
        $requestUri = explode('?', $_SERVER['REQUEST_URI']);
        $route = $requestUri[0];
        $routeExploded = explode('/', $route);
        $resourse = ($routeExploded[1]) ?? null;
        $controller = ($routeExploded[2]) ?? null;
        $function = ($routeExploded[3]) ?? null;
        $value = ($routeExploded[4]) ?? null;

        switch ($resourse) {
            case 'api':
                switch ($controller) {
                    case 'users':
                        switch ($function) {
                            case 'create':
                                $userController = new UserController();
                                $userController->create();
                                break;
                            case 'edit':
                                $userController = new UserController();
                                $userController->find();
                                break;
                            case 'update':
                                $userController = new UserController();
                                $userController->update();
                                break;
                            case 'delete':
                                $userController = new UserController();
                                $userController->delete($value);
                                break;
                            default:
                                $userController = new UserController();
                                $userController->index();
                                break;
                        }
                        break;
                    case 'order':
                        break;
                }
                break;
            case 'web':
                switch ($controller) {
                    case 'users':
                        switch ($function) {
                            case 'edit':
                                require __DIR__ . '/../View/Header/ViewHeader.php';
                                require __DIR__ . '/../View/User/ViewEditUser.php';
                                require __DIR__ . '/../View/Footer/ViewFooter.php';
                                break;
                            default:
                                require __DIR__ . '/../View/Header/ViewHeader.php';
                                require __DIR__ . '/../View/User/ViewListUser.php';
                                require __DIR__ . '/../View/Footer/ViewFooter.php';
                                break;
                        }
                        break;
                    case 'order':
                        break;
                }
                break;
            default:
                // Rota padrão para lidar com rotas não encontradas
                http_response_code(404);
                echo 'Página não encontrada';
                break;
        }
//        switch ($controller) {
//            case 'users':
//                switch ($function) {
//                    case 'show':
//                        require __DIR__ . '/../View/Header/ViewHeader.php';
//                        require __DIR__ . '/../View/User/ViewListUser.php';
//                        require __DIR__ . '/../View/Footer/ViewFooter.php';
//                        break;
//                    case 'edit':
//                        require __DIR__ . '/../View/Header/ViewHeader.php';
//                        require __DIR__ . '/../View/User/ViewEditUser.php';
//                        require __DIR__ . '/../View/Footer/ViewFooter.php';
////                        $userController = new UserController();
////                        $userController->find();
//                        break;
//                    case 'create':
//                        $userController = new UserController();
//                        $userController->create();
//                        break;
//                    case 'update':
//                        $userController = new UserController();
//                        $userController->update();
//                        break;
//                    case 'delete':
//                        $userController = new UserController();
//                        $userController->delete($value);
//                        break;
//                    default:
//                        $userController = new UserController();
//                        $userController->index();
//                        break;
//                }
//                break;
//            case 'order':
//                break;
//        }
//        switch ($route) {
//            case 'users':
//                $userController = new UserController();
//                $userController->index();
//                break;
//            case '/users/create':
//                $userController = new UserController();
//                $userController->create();
//                break;
//            case '/users/edit':
//                $userController = new UserController();
//                $userController->find();
//                break;
//            case '/users/delete':
//                $userController = new UserController();
//                $userController->delete();
//                break;
//            default:
//                // Rota padrão para lidar com rotas não encontradas
//                http_response_code(404);
//                echo 'Página não encontrada';
//                break;
//        }
    }
}
