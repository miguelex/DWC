<?php 
use Dotenv\Dotenv;

function conectarDB() : mysqli {

    $dotenv = Dotenv::createImmutable('../');
    $dotenv->load();

    $db = new mysqli($_ENV['HOST'], $_ENV['USER'], $_ENV['DB_PASSWORD'], $_ENV['DATABASE']);

    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
    
} 