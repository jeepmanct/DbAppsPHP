<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=misc', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
