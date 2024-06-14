<?php
session_start();

// Definir las funciones
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
        "valor: " . $producto['valor'] .
        "modelo: " . $producto['modelo'] 
    ."<br>";
        
   
    }
    return $result;
}

function actualizarProducto($productos, $cantidad, $valor, $modelo) {
    foreach ($productos as &$producto) {
        if ($producto['nombre'] == $nombre;){
            $producto['cantidad'] = $cantidad;
            $producto['valor'] = $valor;
            $producto['modelo'] = $modelo
          
            break;
        }
    }
    return $usuarios;
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


?>