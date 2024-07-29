


<?php
require '../../models/mascota.php';

header('Content-Type: application/json; charset=UTF-8');

$_POST['mas_fecha_nacimiento'] = str_replace('T',' ', $_POST['mas_fecha_nacimineto']);

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

// echo json_encode($_GET);
// exit;
try {
    switch ($metodo) {
        case 'POST':
            $mascota = new mascota($_POST);
            switch ($tipo) {
                case '1':


                    $ejecucion = $mascota->guardar();
                    $mensaje = "Guardado correctamente";
                    break;
                case '2':
                    $ejecucion = $mascota->modificar();
                    $mensaje = "Modificado correctamente";
                    $codigo = 2;
                    break;
                case '3':
                    $ejecucion = $mascota->eliminar();
                    if ($ejecucion) {
                        $mensaje = "Eliminado correctamente";
                        $codigo = 3;
                    } else {
                        throw new Exception("Error al eliminar cliente");
                    }
                    break;
                default:
                    throw new Exception("Tipo de acción no válido");
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => 1,
            ]);
            break;
        case 'GET':
            http_response_code(200);
            $mascota = new mascota($_GET);
            $mascotas = $mascota->buscar();
            echo json_encode($mascotas);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;
