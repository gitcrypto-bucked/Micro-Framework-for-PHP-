<?php

namespace App\Controller;

use App\Views\Render;
use App\Controller\Sessoes;

class Account extends \App\Controller
{
    protected function before()
    {
        $this->model = new \App\Model\Crud();
    }

    public function LoginIndex()
    {
        $renderer = new Render();
        $renderer->render('Login/index');
        unset($renderer);
    }

    public function loginAction()
    {
        \App\Validate::doPost();
        \App\Validate::blockMethods(['GET','PUT','DELETE']);
        $renderer = new \App\Views\Render();
        $this->before();
        $user = $this->model->getWhere(' * ', 'usuarios', "email='".($_REQUEST['username'])."' OR username='".($_REQUEST['username'])."'  AND ativo='1'");
        if(empty($user))
        {
            $renderer->render('Login/index',[],'Usuario não cadastrado');
            unset($renderer);
        }
        else
        {
            $password = $user[0]['senha'];
            $valid = \App\OAuth\Encrypt::verify($_REQUEST['password'], @$password);
            if($valid)
            {
                $flags = $this->model->getWhere(" * ", 'usuarios_x_permissoes', 'userUID="'.$user[0]['uid'].'"');
                $sessao = new Sessoes();
                $sesUID = $sessao->createSession($user,  $flags);
                $renderer->redirect('dashboard', $flaskMessage="", $sesUID, 0);
            }
            else
            {
                $renderer->render('Login/index',[],'Usuario/senha invalidos!');
                unset($renderer);
                exit;
            }
        }
    }

    public function logoutAction()
    {
        \App\Validate::doGet();
        $this->before();
        $renderer = new \App\Views\Render();
        $sessao = new Sessoes();
        if($sessao->destroySession(@$_SESSION['uuid']))
        {
            $renderer->render('Login/index',[],'Logout realizado com sucesso');
            unset($renderer);
            exit;
        }
    }

    protected function after()
    {
    }

    protected $model;
}

?>