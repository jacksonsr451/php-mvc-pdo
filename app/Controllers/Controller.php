<?php 

namespace App\Controllers;


abstract class Controller {
    protected $template = "template";
    private static $fileView;
    private static array $response;
    public array $args;

    public function __construct()
    {
        
    }
 
    protected function view($view, $args = []) {
        self::$fileView = $view;
        self::$response = $args;
        $this->masterTemplate();
    }

    public static function load() {
        $view = self::$fileView;
        $response = self::$response;
        require_once(__DIR__ . "/../Views/{$view}.php");
    }

    private function masterTemplate() {
        require_once(__DIR__ . "/../Views/{$this->template}.php");
    }
}