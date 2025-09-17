<?php
header('Content-Type: application/json');

$nombre = $_GET['nombre'];
$url = "https://www.ladespensadedonjuan.com.sv/?s=" . urlencode($nombre);
$html = file_get_contents($url);

// Nombre
preg_match('/<h2 class="woocommerce-loop-product__title">(.*?)<\/h2>/s', $html, $nombreMatch);
$nombre = $nombreMatch[1] ?? 'No encontrado';

// Precio
preg_match('/<span class="woocommerce-Price-amount.*?">(.*?)<\/span>/s', $html, $precioMatch);
$precio = $precioMatch[1] ?? 'No disponible';

// Imagen
preg_match('/<img.*?src="(https:\/\/.*?\.jpg)"/s', $html, $imagenMatch);
$imagen = $imagenMatch[1] ?? '';

echo json_encode([
  'supermercado' => 'Despensa de Don Juan',
  'nombre' => $nombre,
  'precio' => $precio,
  'imagen' => $imagen
]);
?>
