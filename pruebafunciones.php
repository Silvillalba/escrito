<?php
session_start();

// Agregar funciones
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

function actualizarProducto( &$productos, $nombre, $cantidad, $valor, $modelo) {
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








// Agregar algunos productos de ejemplo
$productos = agregarProducto("Laptop", 1, 500, "X123");
$productos = agregarProducto("Celular", 2, 200, "Y987");
$productos = agregarProducto("Tablet", 1, 350, "Z345");

// Mostrar los productos agregados
echo "<pre>";
print_r($productos);
echo "</pre>";


// Buscar un producto por modelo específico
$modeloABuscar = "X123";
$productoEncontrado = buscarProductoPorModelo($productos, $modeloABuscar);

// Mostrar el resultado de la búsqueda
echo $productoEncontrado;


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

// Limpiar resultados
limpiarResultados();
echo "<br>Resultados limpiados.";
