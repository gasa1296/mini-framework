<?php
namespace Config;

/**
 * Contiene la conexion a la base de datos y sus parametros
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
class DB
{
    private static $host = 'localhost';
    private static $user = 'root';
    private static $password = '';
    private static $port = '3306';
    private static $name = 'test';
    private static $connection; 

    /**
     * Crea y retorna una instancia \mysqli
     * @return \mysqli Instancia existente o nueva instancia
     */
    public static function getMysqli(): \mysqli 
    {
        if (empty(self::$connection)) {
            self::$connection = new \mysqli(self::$host, self::$user, self::$password, self::$name, self::$port);
        }
        return self::$connection;
    }
}
