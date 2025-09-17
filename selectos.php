<?php
header('Content-Type: application/json');

$barcode = $_GET['barcode'];
$url = "https://www.superselectos.com/product-search?q=$barcode";

// Obtener HTML
$html = file_get_contents($url);

// Buscar nombre del producto
preg_match('/<h3 class="product-title.*?">(.*?)<\/h3>/s', $html, $nombreMatch);
$nombre = $nombreMatch[1] ?? 'No encontrado';

// Buscar precio
preg_match('/<span class="price.*?">(.*?)<\/span>/s', $html, $precioMatch);
$precio = $precioMatch[1] ?? 'No disponible';

// Buscar imagen
preg_match('/<img.*?src="(https:\/\/.*?\.jpg)"/s', $html, $imagenMatch);
$imagen = $imagenMatch[1] ?? '';

// Devolver JSON
echo json_encode([
  'supermercado' => 'Súper Selectos',
  'nombre' => $nombre,
  'precio' => $precio,
  'imagen' => $imagen
]);
?>
