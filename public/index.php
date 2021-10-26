<?php
include_once __DIR__ . '/../vendor/autoload.php';

use Core\RequestManager;
/**
 * @todo adaptar infraestructura para implementar modelos, Cambiar a doctrine ORM para conectar con la BBDD
 * @todo integrar DI
 */
try
{
    RequestManager::callController(RequestManager::getRequestParameters());
}
catch (\Throwable $e)
{
	print_r($e);
}
