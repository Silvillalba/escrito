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
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

$productos = $_SESSION['productos'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $valor = $_POST['valor'] ?? '';
    $modelo = $_POST['modelo'] ?? ''; 
    switch ($accion) {
        case 'agregar':
            $usuarios = agregarProducto($productos, $nombre, $cantidad, $valor, $modelo);
            $resultado = "Usuario agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarUsuarioPorNombre($productos, $nombre);
            break;
            $resultado = buscarUsuarioPorCantida($productos, $cantidad);
            break;
            $resultado = buscarUsuarioPorValor($productos, $valor,);
            break;
            $resultado = buscarUsuarioPorModelo($productos, $modelo);
            break;

        
        case 'mostrar':
            $resultado = mostrarProductos($productos);
            break;
        
        case 'actualizar':
            $productos = actualizarUsuario($productos, $nombre, $cantidad, $valor, $modelo);
            $resultado = "Usuario actualizado correctamente.<br>";
            break;

       

// Mostrar los productos utilizando la función mostrarProductos
$productosHTML = mostrarProductos($productos);
echo $productosHTML;

// Calcular y mostrar el resultado
$productosHTML = calcularProductos($productos);
echo $productosHTML;

// Filtrar productos por valor mayor que 300
$productosFiltrados = filtrarProductoPorValorMayor($productos, 300);
echo "Productos con valor mayor a 300:<br>";
echo mostrarProductos($productosFiltrados);

// Listar modelos disponibles
$modelosDisponibles = listarModelosDisponibles($productos);
echo "Modelos disponibles:<br>";
print_r($modelosDisponibles);

// Calcular valor promedio
$valorPromedio = calcularValorPromedio($productos);
echo " <br> Valor promedio: $ " . $valorPromedio;

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
