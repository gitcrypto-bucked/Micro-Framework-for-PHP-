<?php

namespace App\Controller;

use App\Views\Render;

class E404  extends \App\Controller
{
    protected function before()
    {
       
    }

    public function indexAction()
    {
        $renderer = new \App\Views\Render();
        $renderer->render('404/index');
        unset($renderer);
    }

    protected function after()
    {

    }

    protected $model;
}

?>