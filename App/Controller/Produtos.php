<?php

namespace App\Controller;

use App\Model\Crud;
use App\Views\Render;
use \Cfg\Config;

class Produtos extends \App\Controller
{
    
    protected function before()
    {
        $this->model = new Crud();
    }

    public function indexAction()
    {
        $renderer = new \App\Views\Render();
        $renderer->render('Produtos/index');
        unset($renderer);
    }

    public function getProdutos($categoria, $page=0)
    {
        $this->before();
        $this->results_per_page= (int)\Cfg\Config::RESULTS_PER_PAGE;
        switch($categoria)
        {
            case null; case '': case \Cfg\Config::ALLPRODUCTS:
                //traz todos
                //aquery($SQL)
            break;
            default:
                //aquery($SQL)
            break;
        }
       
    }

    public function getTotal($categoria='')
    {
        $this->before();
        $SQL ="SELECT COUNT(p.uid) AS qtde FROM produtos AS p
        JOIN categorias AS c ON p.categoria=c.uid
        WHERE c.categoria ='".$categoria."'";
        return $this->model->aquery($SQL);
    }

    public function getCategorias()
    {
        $this->before();
        $res = $this->model->get("categorias","uid, categoria","ativo='1'");
        return $res;
    }


    protected function after()
    {

    }

    protected $model;
    protected $results_per_page;
}

?>