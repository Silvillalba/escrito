<?php
session_start();

// Definir las funciones
function agregarProducto($nombre, $cantidad, $valor, $modelo) {
    $producto[] = [
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'valor' => $valor,
        'modelo' => $modelo
    ];
    return $producto;
}

function buscarProductoPorModelo($productos, $modelo) {
    foreach ($productos as $producto) {
        if ($producto['modelo'] == $modelo) {
            return "Nombre: " . $producto['modelo'] . "<br>";
        }
    }
    return "Producto no encontrado.<br>";
}

function mostrarProductos($productos) {
    $result = '';
    foreach ($productos as $producto) {
        $result .= "Nombre: " . $producto['nombre'] . 
        ", cantidad: " . $producto['cantidad'] . 
        ", valor: " . $producto['valor'] .
        ", modelo: " . $producto['modelo'] 
    ."<br>";
        
   
    }
    return $result;
}

function actualizarProducto( $productos, $nombre, $cantidad, $valor, $modelo) {
    foreach ($productos as &$producto) {
        if ($producto['nombre'] == $nombre) {
            $producto['cantidad'] = $cantidad;
            $producto['valor'] = (float)$valor;
            $producto['modelo'] = $modelo;
          
            break;
        }
    }
    return $productos;
}

function calcularProductos($productos) {
    $result = '';
    foreach ($productos as $producto) {
        $result .= 
        "valor: " . $producto['valor'] .
    "<br>";
        
   
    }
    return $result;
}


function filtrarProductoPorValorMayor($productos, $valorMinimo) {
    $productosFiltrados = [];
    foreach ($productos as $producto) {
      if ($producto['valor'] > $valorMinimo) {
        $productosFiltrados[] = $producto;
      }
    }
    return $productosFiltrados;
  }
  
  function listarModelosDisponibles($productos) {
    $modelosDisponibles = [];
    foreach ($productos as $producto) {
      if (!in_array($producto['modelo'], $modelosDisponibles)) {
        $modelosDisponibles[] = $producto['modelo'];
      }
    }
    return $modelosDisponibles;
  }
  
  function calcularValorPromedio($productos) {
    $totalValor = 0;
    $cantidadProductos = count($productos);
    if ($cantidadProductos > 0) {
      foreach ($productos as $producto) {
        $totalValor += $producto['valor'];
      }
      return $totalValor / $cantidadProductos;
    } else {
      return 0; 
    }
  }
  
function limpiarResultados() {
  global $productos; 
  $productos = []; 
}

// Inicializar el array de usuarios en la sesión
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}

$usuarios = $_SESSION['usuarios'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $email = $_POST['email'] ?? '';

    switch ($accion) {
        case 'agregar':
            $usuarios = agregarUsuario($usuarios, $nombre, $edad, $email);
            $resultado = "Usuario agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarUsuarioPorEmail($usuarios, $email);
            break;
        
        case 'mostrar':
            $resultado = mostrarUsuarios($usuarios);
            break;
        
        case 'actualizar':
            $usuarios = actualizarUsuario($usuarios, $email, $nombre, $edad);
            $resultado = "Usuario actualizado correctamente.<br>";
            break;

        case 'limpiar':
            $_SESSION['usuarios'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['usuarios'] = $usuarios;
    $_SESSION['resultado'] = $resultado;
}

// Redirigir de vuelta a index.php
header("Location: formulario.php");
exit();
?>
