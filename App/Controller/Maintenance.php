<?php

namespace App\Controller;

use App\Views\Render;

class Maintenance  extends \App\Controller
{

    public function __construct()
    {
        $this->indexAction();
    }

    public function __invoke()
    {
        $this->indexAction();
    }

    protected function before()
    {
       
    }

    protected function after()
    {

    }


    protected function indexAction()
    {
        $renderer = new Render();
        $renderer->render('Maintenance/index');
        unset($renderer);
        die();
    }

}