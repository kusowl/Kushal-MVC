<?php 
namespace App\Core;

class Application
{
    public Router $router;
    public Request $request;
    public static $ROOT_DIR;
    function __construct($rootPath){
        $this->request = new Request();
        $this->router = new Router($this->request);
        self::$ROOT_DIR = $rootPath;
    }

    function run(): void {
        echo $this->router->resolve();
    }
}
?>