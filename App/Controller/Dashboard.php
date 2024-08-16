<?php

namespace App\Controller;

use App\Views\Render;

class Dashboard  extends \App\Controller
{
    protected function before()
    {
        $this->model = new App\Model\Crud();
    }

    public function indexAction()
    {
        $renderer = new \App\Views\Render();
        $renderer->render('Dashboard/index');
        unset($renderer);
    }

    protected function after()
    {

    }   

    protected $model;
}

?>