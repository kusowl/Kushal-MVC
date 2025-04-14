<?php 
    require_once __DIR__."/../vendor/autoload.php";
    use App\Core\Application;

    $app = new Application(dirname(__DIR__));

    // Specifying the get method for root
    $app->router->get('/', 'home');

    // Specifying the get method for contact
    $app->router->get('/contact', 'contact');
    $app->run();
    
?>