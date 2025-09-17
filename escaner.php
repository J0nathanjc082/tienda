<?php
header('Content-Type: application/json; charset=utf-8');
include "conexion.php";

$codigo = isset($_GET['codigo']) ? $mysqli->real_escape_string($_GET['codigo']) : '';

$sql = "SELECT p.id, p.nombre, p.descripcion, p.codigo_barras, p.imagen_url,
               s.nombre AS supermercado, pr.precio
        FROM productos p
        JOIN precios pr ON p.id = pr.producto_id
        JOIN supermercados s ON pr.supermercado_id = s.id
        WHERE p.codigo_barras='$codigo'
        ORDER BY pr.precio ASC
        LIMIT 3";

$result = $mysqli->query($sql);

$producto = [];
while($row = $result->fetch_assoc()){
    if(empty($producto)){
        $producto = [
            "nombre" => $row['nombre'],
            "descripcion" => $row['descripcion'],
            "codigo_barras" => $row['codigo_barras'],
            "imagen_url" => $row['imagen_url'],
            "opciones" => []
        ];
    }
    $producto["opciones"][] = [
        "supermercado" => $row['supermercado'],
        "precio" => $row['precio']
    ];
}

echo json_encode($producto, JSON_UNESCAPED_UNICODE);
?>
