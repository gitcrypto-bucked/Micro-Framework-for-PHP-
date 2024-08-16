<?php 

namespace App\Views;

use \Cfg\Config;

class Render{

    function __call(string $name, array $args)
    {
        $this->render($name);
    }   

    function render(string $view, array $args = [], $flaskMessage = '', $session = null): void
    {
        $_SERVER['assets'] = \Cfg\Config::ASSETS_URL.'/';
        $_SERVER['url'] = \Cfg\Config::SERVER;
        
        extract($args, EXTR_SKIP);
        
        $view.=\Cfg\Config::TEMPLATE;
        if($session!=null && $session!='')
        {
                $_SESSION['_uid'] = $session;
                $_SESSION['ativa'] = 1;
        }

        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR ."/Views/$view";
        
        if (is_readable($file)==true & file_exists($file)==true)
        {
            $_SESSION['flask_message'] = $flaskMessage;
            $this->triggerHeader();
            require_once $file; 
            exit;
        } 
        if (is_readable($file)==false & file_exists($file)==false)
        {
           $this->trigger404(); exit;
        }
    }

    function redirect(string $url, $flaskMessage="", $session=null, $time=7):void
    {
        $url = \Cfg\Config::SERVER. $url;
        if($session!=null && $session!='')
        {
                $_SESSION['_uid'] = $session;
                $_SESSION['ativa'] = 1;
        }
        $_SESSION['flask_message'] = $flaskMessage;
        header("Refresh: {$time}; url={$url}");
        exit;
    }

    function trigger404()
    {
        require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR ."/Views/404/index.".\Cfg\Config::TEMPLATE); exit;
    }

    function triggerHeader()
    {
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR ."/Views/Header/header".\Cfg\Config::TEMPLATE;
    }
}

?>