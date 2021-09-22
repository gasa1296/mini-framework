<?php
namespace Core;

use Exception;

/**
 * Contiene configuracion de seguridad y funciones que las usen
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
class Security
{
    /**
     * Crea y retorna el token CSRF
     * @return string token csrf creado o existente
     */
    public static function getCSRF(): string
    {
	session_start();
	if (empty($_SESSION['csrf_token']))
    {
        $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(64));
	}
        return $_SESSION['csrf_token'];
    }
    /**
     * Verifica la existencia del token csrf en la peticion y valida la igualdad con el token de la session
     * @return void
     */
    public static function verifyCSRF(): void
    {
        //csrf_token vacio?
        if (empty($_POST['csrf_token']))
        {
            throw new Exception('csrf token vacio');
        }
        //csrf_token diferente?
        if (!hash_equals(self::getCSRF(), $_POST['csrf_token']))
        {
            throw new Exception('csrf token no coincide');
        }
    }
}
