/**
* Encripta la informacion con el algoritmo 'AES246'
* @param string $data
* @return string|false Valor encriptado o false
*/
public static function encrypt($data)
{
return empty($data) ? false : base64_encode(openssl_encrypt($data, "AES-256-CBC", self::$secret_key, 0, self::$secret_iv));
}

/**
* Desencipta la informacion con el algoritmo 'AES246'
* @param string $data
* @return string|false Valor desencriptado o false
*/
public static function decrypt($data)
{
return empty($data) ? false : openssl_decrypt(base64_decode($data), "AES-256-CBC", self::$secret_key, 0, self::$secret_iv);
}