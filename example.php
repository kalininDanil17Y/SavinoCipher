<?php

require './vendor/autoload.php';

use Danilo9\SavinoCipher;

$server_secret_key = 'Secret key :)';
$user = [
	'id' => 332,
	'access_rights' => 4443,
	'note' => 'Test user data'
];

// Encrypt
$user_token = SavinoCipher::createToken($server_secret_key, $user);
echo sprintf('User token: %s', $user_token) . PHP_EOL;

// Decrypt
try {
	$decryptUserData = SavinoCipher::decryptToken($server_secret_key, $user_token);
	echo 'Decrypt data: ' . PHP_EOL;
	print_r($decryptUserData);
} catch (Exception $e) {
	echo sprintf('Error: %s', $e->getMessage()) . PHP_EOL;
}
