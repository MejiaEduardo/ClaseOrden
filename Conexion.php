<?php
class Connection {
    private $pdo;

    public function __construct() {
        $dbname = "Archivoshtml";  // Cambia esto por el nombre de tu base de datos
        $host = "localhost";  // Cambia esto si tu base de datos no está en el mismo servidor
        $username = "postgres";  // Cambia esto por tu nombre de usuario de PostgreSQL
        $password = "1234";  // Cambia esto por tu contraseña de PostgreSQL

        $dsn = "pgsql:host=$host;dbname=$dbname";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}
$pdo = new Connection();