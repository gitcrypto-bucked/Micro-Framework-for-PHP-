<?php
session_start();

require_once('vendor/autoload.php');

new \Cfg\Config(\Cfg\Config::NORMAL);

$router = new \Router\Router();
$handler = new \Router\Requisition();



$router->before('GET', '/', function() use ($handler)
{
    if (session_status() == PHP_SESSION_NONE) 
    {
        $handler->handle($handler::CALLABLE,  "App\Controller\Home@indexAction" ,'Home/index');
    }
    elseif(session_status() != PHP_SESSION_NONE && !empty($_SESSION) && isset($_SESSION['name']))
    {
        header('Location: ./dashboard');
    }
});

$router->before('POST', '/.*', function() use ($handler)
{
    if (!isset($_POST['signature']) | @$_POST['signature']=='') {
      
        $handler->handle($handler::CALLABLE,  "App\Views\Render@render" ,'401/index'); exit;
    }
});

$router->get('/', function() use ($handler)
{   
    $handler->handle($handler::CALLABLE,  "App\Controller\Home@indexAction" ,'Home/index');
});

$router->get('/index', function() use ($handler)
{   
    $handler->handle($handler::CALLABLE,  "App\Controller\Home@indexAction" ,'Home/index');
});

$router->get('/login', function() use ($handler)
{ 
   #$handler->handle($handler::CALLABLE,  "App\Controller\Account@LoginIndex" ,'Login/index');
   if (!isset($_SESSION['name']) || !isset($_SESSION['ativa'])) 
   {
       $handler->handle($handler::CALLABLE,  "App\Controller\Account@LoginIndex" ,'Login/index');
   }
   elseif(session_status() != PHP_SESSION_NONE && 
          isset($_SESSION['name']) && $_SESSION['ativa']=='true')
   {
        header('Location: ./dashboard');
   }
});

$router->post('/login', function() use ($handler)
{ 
    $handler->handle($handler::CALLABLE,  "App\Controller\Account@LoginAction" ,$_REQUEST);
});

$router->get("/logout", function() use ($handler)
{
    $handler->handle($handler::CALLABLE,  "App\Controller\Account@logoutAction" ,$_SESSION);
});

$router->get('/dashboard', function() use ($handler)
{  
    if(!isset($_SESSION['uuid']) || $_SESSION['uuid']=='' && !isset($_SESSION['ativa']))
    {
        header('Location: ./');
    }
    if(isset($_SESSION['uuid']) && $_SESSION['uuid']!='' && isset($_SESSION['ativa']))
    {
        $handler->handle($handler::CALLABLE,  "App\Controller\Dashboard@indexAction" ,'Dashboard/index');
    }
});

$router->set404(function() use($handler)
{
    $handler->handle($handler::CALLABLE,  "App\Controller\E404@indexAction" ,"404/index");
});

/** 
 * @ add routes above here
 */

 try
 {
     $router->run();
 }
 catch(Exception $e)
 {	
    throw new InvalidArgumentException( $e->getMessage());
    echo $e->getMessage();
 }
 

?>