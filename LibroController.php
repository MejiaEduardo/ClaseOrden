<?php

require_once 'Libro.php';
require_once 'Conexion.php';  // Asumiendo que tienes una clase Conexion para manejar la conexión a la base de datos

class LibroController {

    private $libroModel;

    public function __construct() {
        $conexion = new Connection();  // Crea una nueva conexión a la base de datos
        $this->libroModel = new Libro($conexion->getConexion());
    }

    public function insertarLibro() {
        $tipoLibro = $_POST['tipolibro'] ?? '';
        $paginas = $_POST['paginas'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $editor = $_POST['editor'] ?? '';
        $enlace = $_POST['enlace'] ?? '';
        $portada = $_POST['portada'] ?? '';
        $tamanio = $_POST['tamanio'] ?? '';
        $peso = $_POST['peso'] ?? '';

        if ($this->libroModel->insertarLibro($tipoLibro, $paginas, $autor, $editor, $enlace, $portada, $tamanio, $peso)) {
            echo json_encode(['success' => 'Libro insertado correctamente']);
        } else {
            echo json_encode(['error' => 'Error al insertar el libro']);
        }
    }

    public function getUltimoLibro() {
        $ultimoLibro = $this->libroModel->leerUltimoLibroInsertado();
        
        if ($ultimoLibro) {
            echo json_encode(['success' => 'Último libro recuperado', 'data' => $ultimoLibro]);
        } else {
            echo json_encode(['error' => 'No se encontró ningún libro']);
        }
    }
}

// Instancia el controlador y llama al método apropiado según el método de solicitud
$controller = new LibroController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->insertarLibro();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->getUltimoLibro();
}



