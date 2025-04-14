<?php

namespace App\Core;

use App\Core\Request;

class Router
{
    protected array $routes;
    protected Request $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }
    function get($path, $callback): void
    {
        // Store the get routes
        $this->routes['get'][$path] = $callback;
    }

    function post($path, $callback): void
    {
        // Store the post routes
        $this->routes['post'][$path] = $callback;
    }

    function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        // Get the associated callback function
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return "Not found 404";
        }

        // Check if the callback is view
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView(String $view)
    {
        // get the layout 
        $layoutContent = $this->getLayout('main');

        //get the view content
        $viewContent = $this->getView($view);

        return str_replace("{{placeholder}}", $viewContent, $layoutContent);
    }

    protected function getLayout($layout): String
    {
        ob_start();
        include Application::$ROOT_DIR . "/Views/layouts/" . $layout . ".php";
        return ob_get_clean();
    }

    protected function getView($view): String
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/Views//" . $view . ".php";
        return ob_get_clean();
    }
}
