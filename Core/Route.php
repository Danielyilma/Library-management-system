<?php

class Route {
    private $routes = array();

    public function setter($url, $controller, $method){
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'access' => NULL
        ];

        return $this;
    }

    public function post($url, $controller){
        return $this->setter($url, $controller, 'POST');
    }

    public function get($url, $controller){
        return $this->setter($url, $controller, 'GET');
    }

    public function put($url, $controller){
        return $this->setter($url, $controller, 'PUT');
    }

    public function delete($url, $controller){
        return $this->setter($url, $controller, "DELETE");
    }

    public function access($stat) {
        $this->routes[array_key_last($this->routes)]['access'] = $stat;
    }

    public function route($url) {
        $method = $_SERVER['REQUEST_METHOD'];
 
        foreach($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] == $method){

                if ($route['access'] === 'auth') {
                    (new Auth())->handler();
                }


                if ($route['access'] === 'guest') {
                    (new Guest())->handler();
                }
                require $route['controller'];
            }
        }
    }
}