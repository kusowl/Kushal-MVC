<?php 
namespace App\Core;

class Request
{
    function getMethod(): string {
        // Get the method of the request and return it in lowercase.
        // GET -> get
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    function getPath(): string {
        $path = $_SERVER["REQUEST_URI"];
        $pos = strpos($path,"?");

        // If the path does not contain any get key-value pair
        if($pos === false)
            return $path;

        // If the path does contain key-value pairs, remove it from the path,
        // and return the base path
        $path = substr($path, 0, $pos);
        return $path;
    }
}
?>