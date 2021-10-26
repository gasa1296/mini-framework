<?php
namespace Core;

use Core\Routes;
use Core\Security;
use Core\RequestManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Clase Abstracta para controladores
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
abstract class Controller
{
	protected $request;
	protected $parameters;
	protected $loader;
	protected $twig;

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
	 * Setea Twig para su uso
	 */
	private function setTwig()
	{
		//configurar twig
		$this->loader = new FilesystemLoader(__DIR__ . '/../src/View/');
		$this->twig = new Environment($this->loader, [
			'cache' => __DIR__ . '/../.cache'
		]);
		$getUrl = new \Twig\TwigFunction('getUrl', function (string $route, $parameters = array()) {
			return $this->generateRoute($route, $parameters = array());
		});
		$getAsset = new \Twig\TwigFunction('getAsset', function (string $assets) {
			return $this->getAssets($assets);
		});

		$this->twig->addGlobal('csrfToken', Security::getCSRF());
		$this->twig->addFunction($getUrl);
		$this->twig->addFunction($getAsset);
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
	 * Carga vista hecha en Twig, el archivo debe tener terminacion ".twig"
	 * @param string $view nombre de la vista
	 * @param array $context datos a utilizar en la vista
	 */
	protected function render(string $view, array $context = [])
	{
		$this->setTwig();
		$template = $this->twig->load($view . '.twig');
		echo $template->render($context);
	}
	/**
	 * Obtiene cadena con la ubicacion del asset pasado como parametro
	 * @param string $asset Archivo a concatenar en la carpeta asset
	 * @return string Ubicacion del asset pasado como parametro
	 */
	protected function getAssets(string $asset): string
	{
		return '/assets' . $asset;
	}
}
