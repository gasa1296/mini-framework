<?php

namespace App\Utility;

use Exception;

/**
 * Funciones de validacion de datos
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
class Validator
{
	/**
	 * Valida archivo
	 * @param array $file
	 * @param array $allowed_types
	 * @param string $path
	 * @return void
	 */
	public static function validateFile(array $file, array $allowed_types = []): void
	{
		if (empty($file['tmp_name'])) {
			throw new Exception('archivo vacio');
		}
		if (!is_uploaded_file($file['tmp_name']))
		{
			throw new Exception('no se subio por http');
		}
		if (!empty($allowed_types))
		{
			if(!in_array($file['type'], $allowed_types))
			{
				throw new Exception('No es un tipo permitido');
			}
		}
		self::validateString($file['name']);
	}

	/**
	 * Valida y sanitiza el valor de una integer
	 * @param int $integer
	 * @return void
	 */
	public static function validateInteger(int $integer): void
	{
		if (!filter_var($integer, FILTER_VALIDATE_INT))
		{
			throw new Exception('no es integer');
		}
	}

	/**
	 * Valida y sanitiza el valor de una email
	 * @param string $email
	 * @return void
	 */
	public static function validateEmail(string $email): void
	{
		if (empty($email))
		{
			throw new Exception('email vacio');
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			throw new Exception('no es un correo valido');
		}
	}

	/**
	 * Valida cadena de caracteres
	 * @param string $string
	 * @return void
	 */
	public static function validateString(string $string): void
	{
		if (empty($string))
		{
			throw new Exception('string vacio');
		}
		if(!filter_var($string, FILTER_VALIDATE_REGEXP, array(
			'options' => array(
				'regexp' => '/^[a-zA-Z0-9 _.-]*$/'
				)
			)
		)) {
			throw new Exception('string invalido');
		}
	}

	/**
	 * Valida cadena de caracteres
	 * @param string $url
	 * @return void
	 */
	public static function validateUrl(string $url): void
	{
		if (empty($url))
		{
			throw new Exception('url vacia');
		}
		if(!filter_var($url, FILTER_VALIDATE_URL))
		{
			throw new Exception('url invalida');
		}
	}
}