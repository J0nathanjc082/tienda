<?php
header('Content-Type: application/json');

$nombre = $_GET['nombre'];
$url = "https://www.walmart.com.sv/search/?query=" . urlencode($nombre);
$html = file_get_contents($url);

// Nombre
preg_match('/<h2 class="product-title.*?">(.*?)<\/h2>/s', $html, $nombreMatch);
$nombre = $nombreMatch[1] ?? 'No encontrado';

// Precio
preg_match('/<span class="price.*?">(.*?)<\/span>/s', $html, $precioMatch);
$precio = $precioMatch[1] ?? 'No disponible';

// Imagen
preg_match('/<img.*?src="(https:\/\/.*?\.jpg)"/s', $html, $imagenMatch);
$imagen = $imagenMatch[1] ?? '';

echo json_encode([
  'supermercado' => 'Walmart El Salvador',
  'nombre' => $nombre,
  'precio' => $precio,
  'imagen' => $imagen
]);
?>
