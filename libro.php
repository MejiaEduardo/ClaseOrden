<?php
class Libro {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertarLibro($tipoLibro, $paginas, $autor, $editor, $enlace, $portada, $tamanio, $peso) {
        try {
            $sql = "INSERT INTO libros (tipolibro, paginas, autor, editor, enlace, portada, tamaño, peso)
                    VALUES (:tipolibro, :paginas, :autor, :editor, :enlace, :portada, :tamanio, :peso)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipolibro', $tipoLibro);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':editor', $editor);
            $stmt->bindParam(':enlace', $enlace);
            $stmt->bindParam(':portada', $portada);
            $stmt->bindParam(':tamanio', $tamanio);
            $stmt->bindParam(':peso', $peso);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar el libro: " . $e->getMessage();
            return false;
        }
    }

    public function leerUltimoLibroInsertado() {
        try {
            $sql = "SELECT * FROM libros limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($resultado) {

                return json_encode($resultado);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al leer el último libro insertado: " . $e->getMessage();
            return false;
        }
    }
    
}
    

