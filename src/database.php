<?php

function getDBConnection(): PDO {
    try {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        if (!$host || !$dbname || !$user) {
            throw new Exception("Les variables d'environnement de la base de données sont incomplètes.");
        }

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (Exception $e) {
        // Journalisation de l'erreur technique dans les logs Docker/PHP sans l'exposer à l'écran
        error_log("Erreur de connexion : " . $e->getMessage());
        die("Une erreur est survenue lors de la connexion à la base de données.");
    }
}