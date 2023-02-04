<?php

namespace Danilo9;

use Exception;

class SavinoCipher
{
	/**
	 * @param string           $secretKey
	 * @param string|array|int $data
	 *
	 * @return string
	 */
	public static function createToken(string $secretKey, string|array|int $data): string
	{
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
		$encrypted_data = openssl_encrypt(json_encode($data), 'AES-256-CBC', $secretKey, 0, $iv);
		return base64_encode($iv . '_' . $encrypted_data);
	}

	/**
	 * @param string $secretKey
	 * @param string $token
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public static function decryptToken(string $secretKey, string $token): mixed
	{
		$base64String = base64_decode($token);
		if ($base64String === false) {
			throw new Exception('Error: Failed to decode token');
		}

		[$vi, $data] = explode('_', $base64String);

		$decrypted_data = openssl_decrypt($data, 'AES-256-CBC', $secretKey, 0, $vi);
		if ($decrypted_data === false) {
			throw new Exception('Error: Failed to decrypt data');
		}

		$data = json_decode($decrypted_data, true);
		if ($data === null) {
			throw new Exception('Error: Failed to parse data');
		}

		return $data;
	}
}
