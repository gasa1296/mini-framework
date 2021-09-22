<?php
include_once __DIR__ . '/../vendor/autoload.php';

use Core\RequestManager;
/**
 * @todo integrar twig o smarty
 * @todo adaptar infraestructura para implementar modelos
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
