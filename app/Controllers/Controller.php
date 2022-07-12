<?php 

namespace App\Controllers;


abstract class Controller 
{
    protected $template = "template";
    private static $fileView;
    private static array $response;
    public array $args;

    public function __construct()
    {
        
    }
 
    protected function view($view, $args = []): void 
    {
        self::$fileView = $view;
        self::$response = $args;
        $this->masterTemplate();
    }

    public static function load(): void 
    {
        $view = self::$fileView;
        $response = self::$response;
        require_once(__DIR__ . "/../Views/{$view}.php");
    }

    private function masterTemplate(): void 
    {
        require_once(__DIR__ . "/../Views/{$this->template}.php");
    }
}