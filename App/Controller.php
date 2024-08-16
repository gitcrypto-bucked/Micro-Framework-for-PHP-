<?php

namespace App;

abstract class Controller
{
	protected $route_params = [];

	public function __construct($route_params)
	{
		$this->route_params = $route_params;
	}

	/**
	 * Magic method called when a non-existent or inaccessible method is
	 * called on an object of this class. Used to execute before and after
	 * filter methods on action methods. Action methods need to be named
	 * with an "Action" suffix, e.g. indexAction, showAction etc.
	 *
	 * @param string $name  Method name
	 * @param array $args Arguments passed to the method
	 *
	 * @return void
	 */
	public function __call(string $name, array $args): void
	{
		\App\Validate::blockMethods(['put','delete']);
		
		if(strpos($name,'Action')!=false)
		{
			$method = $name;
		}
		else $method = $name . 'Action';
		
		if (method_exists($this, $method))
		{
			if ($this->before() !== false)
			{
				call_user_func_array([$this, $method], $args);
				$this->after();
			}
		}
		else 
		{
			if (\Cfg\Config::DEBUG)
				throw new \Exception("Método {$name} não encontrado.");
			else
				throw new \Exception("", 204);
			exit;
		}
	}

	/**
	 * Before filter - called before an action method.
	 * @return void
	 */
	abstract protected function before();

	/**
	 * After filter - called after an action method.
	 * @return void
	 */
	abstract protected function after();
}
