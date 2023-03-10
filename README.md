# SavinoCipher

Encryption of data into a token by key, with the possibility of decryption

### Usage example

```php

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
```

### Code output

```plaintext
User token: 7pCn7lQfp1BRhjdB1Zfiy19HeUg5TTdEc1BkQ3g3NjF0cEtmdW5IbFpEbGVZQitXeU04VTRUTmtsdnZmdlZMN1pjTSt1MGxGS056WUgxTEExeHhaRWdmbS9wK0d6Y3FQbFZ3UGNsdz09
Decrypt data:
Array
(
    [id] => 332
    [access_rights] => 4443
    [note] => Test user data
)

```
