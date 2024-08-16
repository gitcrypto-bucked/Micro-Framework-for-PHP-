<?php 
namespace Router;

use \App\Views\Render;

class Requisition
{
    public function __construct()
    {

    }


    const CALLABLE  = 1;
    const INVOKE = 2;


    public function handle($type, $fn, $params)
    {
        list($controller, $method) = explode('@', $fn);
        switch($type)
        {
            case self::CALLABLE :
                $controller = new $controller($params);
                $className = get_class($controller);
                $methodVariable = array($controller,  $method);

                if(is_callable($methodVariable, true, $callable_name)==true){
                  
                    $value1 = call_user_func($methodVariable, $params);exit;
                }
                else  $this->handle( self::INVOKE,$fn, $params);
                break;
            case self::INVOKE :
                $reflectedMethod = new \ReflectionMethod($controller, $method);
                if (class_exists($controller) & ($reflectedMethod->isStatic()==false) )
                {
                    $controller = new $controller($params);
                    $reflectionClass = new \ReflectionClass(get_class($controller));
                    $reflectionMethod = $reflectionClass->getMethod(strval($method));
                    $reflectionMethod->setAccessible(true); 
                    $reflectionMethod->invoke(new $controller($params)); 
                }
                break;
        }
    }
}
