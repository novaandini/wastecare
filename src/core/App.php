<?php

class App {
    private $controllerFile;
    private $controllerMethod;
    private $parameter = [];
    private const DEFAULT_GET = 'GET';
    private const DEFAULT_POST = 'POST';
    private $handlers = [];

    public function get($uri, $callback) {
        $this->setHandler(self::DEFAULT_GET, $uri, $callback);
    }

    public function post($uri, $callback) {
        $this->setHandler(self::DEFAULT_POST, $uri, $callback);
    }

    public function setDefaultController($controller) {
        $this->controllerFile = $controller;
    }

    public function setDefaultMethod($method) {
        $this->controllerMethod = $method;
    }

    private function setHandler(string $method, string $path, $handler) {
        $this->handlers[] = [
            'path' => trim($path, '/'),
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function run() {
        $url = $this->getUrl();
        $requested_method = $_SERVER['REQUEST_METHOD'];
        $found = false;

        foreach ($this->handlers as $handler) {
            $routeSegments = $handler['path'] === '' ? [''] : explode('/', $handler['path']);

            if ($requested_method === $handler['method'] && $this->matchPath($url, $routeSegments)) {
                $this->controllerFile = $handler['handler'][0];
                $this->controllerMethod = $handler['handler'][1];

                // ambil sisa URL sebagai parameter dinamis
                
                $this->parameter = [];
                foreach ($routeSegments as $i => $segment) {
                    if (str_starts_with($segment, '(:') && str_ends_with($segment, ')')) {
                        $this->parameter[] = $url[$i];
                    }
                }
                $found = true;
                break;
            }
        }

        if (!$found) {
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
            exit;
        }

        // Load controller & panggil method
        require_once __DIR__ . '/../controllers/' . $this->controllerFile . '.php';
        $controller = new $this->controllerFile;
        call_user_func_array([$controller, $this->controllerMethod], $this->parameter);
    }

    private function matchPath($urlSegments, $routeSegments) {
        if (count($urlSegments) !== count($routeSegments)) return false;

        foreach ($routeSegments as $i => $segment) {
            if (str_starts_with($segment, '(:') && str_ends_with($segment, ')')) {
                continue; // parameter dinamis
            }
            if (!isset($urlSegments[$i]) || $urlSegments[$i] !== $segment) {
                return false;
            }
        }
        return true;
    }

    private function getUrl() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');

        // root '/'
        return $uri === '' ? [''] : explode('/', $uri);
    }
}