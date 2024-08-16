<?php

namespace App\Controller;

use App\Views\Render;

class Home  extends \App\Controller
{
    protected function before()
    {
       
    }

    public function indexAction()
    {
        $renderer = new \App\Views\Render();
        $renderer->render('Home/index');
        unset($renderer);
    }

    protected function after()
    {

    }

    protected $model;
}

?>