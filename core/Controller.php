<?php
namespace Core;

use Config\Routes;
use Core\Security;
use Core\RequestManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * Plantilla para controladores
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
abstract class Controller
{
	protected $request;
	protected $parameters;

	/**
	 * @param array $parameters parametros de la ruta
	 * @return void
	 */
	public function __construct()
	{
		$this->parameters = RequestManager::getRequestParameters();
		$this->request = Request::createFromGlobals();
	}
	/**
	 * Genera url
	 * @param string $route nombre de la ruta
	 * @param array $parameters parametros de la ruta
	 * @return string url generada
	 */
	protected function generateRoute($route, $parameters = array()): string
	{
		$generator = new UrlGenerator(Routes::getRouteCollection(), RequestManager::getContext());
		return $generator->generate($route, $parameters);
	}
	/**
	 * Reridige a la ruta especificada
	 * @param string $route nombre de ruta
	 * @param array $parameters parametros de la ruta
	 * @return void
	 */
	protected function redirect($route, $parameters = array()): void
	{
		header('location: '  . $this->generateRoute($route, $parameters));
		die();
	}
	/**
	 * 
	 */
	protected function render(string $view, array $data = [])
	{
		require __DIR__ . '/../src/View/' . $view . '.php';
	}
	/**
	 * 
	 */
	protected function getAssets(string $assets)
	{
		return '/assets' . $assets;
	}
}
