<?php

class Route {
    private $routes = array();

    public function setter($url, $controller, $method){
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function post($url, $controller){
        $this->setter($url, $controller, 'POST');
    }

    public function get($url, $controller){
        $this->setter($url, $controller, 'GET');
    }

    public function put($url, $controller){
        $this->setter($url, $controller, 'PUT');
    }

    public function delete($url, $controller){
        $this->setter($url, $controller, "DELETE");
    }

    public function route($url) {
        $method = $_SERVER['REQUEST_METHOD'];
 
        foreach($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] == $method){
                require $route['controller'];
            }
        }
    }
}