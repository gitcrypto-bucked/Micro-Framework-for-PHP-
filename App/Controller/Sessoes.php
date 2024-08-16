<?php

namespace App\Controller;


class Sessoes extends \App\Controller
{
    public function __construct()
    {
        $this->before();
    }


    protected function before()
    {
        $this->model = new \App\Model\Crud();
    }

    protected function after()
    {
        unset($this->model);
    }

    public function createSession(array $user, array $flags)
    {
        $cookie_name = "user";
        $cookie_value = $user[0]['nome'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $_SESSION['uid'] = session_id();
        $_SESSION['uuid'] = $user[0]['uid'];
        $_SESSION['password'] = $user[0]['senha'];
        $_SESSION['email']=  $user[0]['email'];
        $_SESSION['name'] =  $user[0]['nome'];
        $_SESSION['inicio'] = date('H:i')   ;
        $_SESSION['ativa'] = 'true';
        $_SESSION['data'] = date('Y-m-d');
        $_SESSION['flags'] = serialize($flags[0]);
        $time = \Cfg\Config::SESSION;
		$end = date('H:i', strtotime($_SESSION['inicio'] .'+'.$time.' hour'));
        $_SESSION['fim'] = $end ;

        $i = $this-> model->insert('sessoes', "(sessaoUID , sessao_inicio , sessao_fim, sessao_flags, ativo )", " (? , ? , ? , ? , ? )", 
                                            [ $_SESSION['uid'] , $_SESSION['inicio'] , $_SESSION['fim'],$_SESSION['flags'],  boolval($_SESSION['ativa'])]  );
        if($i==true)
        {
           return $_SESSION['uid'];
        }
        else
        {
            throw new Exception('Erro ao salvar sessão'); exit;
        }
    }

    public function getSession($uid)
    {
        
    }

    public function destroySession($uid)
    {
        unset($_SESSION['uuid']);
        unset($_SESSION["password"]);
        unset($_SESSION["email"]);
        unset($_SESSION["name"]);
        unset($_SESSION['inicio']);
        unset($_SESSION['fim']);
        unset($_SESSION['ativa']);
        unset($_SESSION['flags']);
        session_destroy();
        return $this->model->update('sessoes', 'ativo=?', 'sessaoUID=?', ['0',$uid]);
    }

    public function validaSessao()
    {
        if(!isset($_SESSION['uid']) | $_SESSION['uid']=='')
        {
            header("Location: ".\Cfg\Config::SERVER.'admin/login'); exit;
        }
        if(!isset($_SESSION['ativa']) || $_SESSION['ativa']=='' | $_SESSION['ativa']==0)
        {#
            header("Location: ".\Cfg\Config::SERVER.'admin/login'); exit;
        }
        if(!isset($_SESSION['data']) | @$_SESSION['data']=='' )
        {
        session_destroy();
        session_gc();
        header("Location: ".\Cfg\Config::SERVER.'admin/login');
        } 
        else if(strtotime(date('Y-m-d'))>strtotime($_SESSION['data']))
        {
            $_SESSION['flask_message'] = "Sessão expirada por favor faça novamente o login".
            $sess = $this->getAdminLogout($_SESSION['uid']);
            unset($_SESSION['uid']);
            session_destroy();
            session_gc();
            header("Refresh: 10; url=".\Cfg\Config::SERVER."admin/login"); exit;
        }
    }

    protected $model;

}
?>