<?php

use Protobuf\User;

include_once '../../vendor/autoload.php';
include_once './GPBMetadata/User.php';
include_once './Protobuf/User.php';

$user = new User();
$user->setId(12);
$user->setUsername('Maksimk99');
$user->setRoles(['USER', 'ADMIN']);
$user->setPassword('UserPassword');

file_put_contents('user.txt', $user->serializeToString());

$user_str = file_get_contents('./user.txt');

$user_updated = new User();

try {
    $user_updated->mergeFromString($user_str);
} catch (Exception $e) {
    echo 'ERROR!';
}

$user_updated->setUsername('Kolya2001');
$user_updated->setPassword($user_updated->getPassword().'Changed');

echo $user_updated->serializeToJsonString();

file_put_contents('user.txt', $user_updated->serializeToString());