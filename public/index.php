<?php
include_once __DIR__ . '/../vendor/autoload.php';

use Core\RequestManager;
/**
 * @todo Adaptar infraestructura para implementar modelos
 * @todo Cambiar a doctrine ORM para conectar con la BBDD
 * @todo Integrar DI
 */
try
{
    RequestManager::callController(RequestManager::getRequestParameters());
}
catch (\Throwable $e)
{
	print_r($e);
}
