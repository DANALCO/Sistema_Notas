<<<<<<< HEAD
<<<<<<< HEAD
<?php

$host = 'localhost';
$user = 'root';
$db = 'SecundariaAftons';
$pass = '';

    try {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        'error: '.$e->getMessage();
=======
<?php

$host = 'localhost';
$user = 'root';
$db = 'SecundariaAftons';
$pass = '';

    try {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        'error: '.$e->getMessage();
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php

$host = 'localhost';
$user = 'root';
$db = 'SecundariaAftons';
$pass = '';

    try {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        'error: '.$e->getMessage();
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
    }