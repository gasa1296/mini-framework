<?php
namespace Config;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

/**
 * Contiene la colleccion de rutas
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
Class Routes
{
    private static $routeCollection;

    /**
     * Crea y retorna instacia de RoutesCollection con todas sus rutas agregadas
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public static function getRouteCollection(): \Symfony\Component\Routing\RouteCollection
    {
        if (empty(self::$routeCollection)) {
            $fileLocator = new FileLocator(array(__DIR__));
            $loader = new YamlFileLoader($fileLocator);
            self::$routeCollection = $loader->load('routes.yaml');
        }
        return self::$routeCollection;
    }
}
