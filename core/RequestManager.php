<?php
namespace Core;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

use Symfony\Component\HttpFoundation\Request;

use Core\Routes;

/**
 * Maneja las peticiones del servidor
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
class RequestManager
{
    private static $context;
    private static $parameters;

    /**
     * Crea y retorna instacia RequestContext 
     * @return \Symfony\Component\Routing\RequestContext
     */
    public static function getContext(): \Symfony\Component\Routing\RequestContext
    {

        if (empty(self::$context)) {
            self::$context = new RequestContext();
            self::$context->fromRequest(Request::createFromGlobals());
        }
        return self::$context;
    }

    /**
     * Busca la ruta dentro de la colleccion de routas usando el contexto de la peticion y retorna los parametros de dicha ruta
     * @return array parametros de la routa
     */
    public static function getRequestParameters(): array
    {
        if (empty(self::$parameters)) {
            $matcher = new UrlMatcher(Routes::getRouteCollection(), self::getContext());
            self::$parameters = $matcher->match(self::getContext()->getPathInfo());
        }
        return self::$parameters;
    }
    /**
     * 
     */
    public static function callController(array $parameters)
    {
        $routeController = explode('::', $parameters['_controller']);
        $method = $routeController[1];
        $route = new $routeController[0]();
        $route->$method();
    }
}