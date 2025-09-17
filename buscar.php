<?php
header('Content-Type: application/json; charset=utf-8');
include "conexion";

$q = isset($_GET['q']) ? $mysqli->real_escape_string($_GET['q']) : '';

$sql = "SELECT p.id, p.nombre, p.descripcion, p.codigo_barras, p.imagen_url,
               s.nombre AS supermercado, pr.precio
        FROM productos p
        JOIN precios pr ON p.id = pr.producto_id
        JOIN supermercados s ON pr.supermercado_id = s.id
        WHERE p.nombre LIKE '%$q%'
        ORDER BY p.id, pr.precio ASC";

$result = $mysqli->query($sql);

$productos = [];
while($row = $result->fetch_assoc()){
    $id = $row['id'];
    if(!isset($productos[$id])){
        $productos[$id] = [
            "nombre" => $row['nombre'],
            "descripcion" => $row['descripcion'],
            "codigo_barras" => $row['codigo_barras'],
            "imagen_url" => $row['imagen_url'],
            "opciones" => []
        ];
    }
    $productos[$id]["opciones"][] = [
        "supermercado" => $row['supermercado'],
        "precio" => $row['precio']
    ];
}

echo json_encode(array_values($productos), JSON_UNESCAPED_UNICODE);
?>
