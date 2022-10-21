<?php
//print_r($_POST);
if (empty($_POST["txtArreglo"]) || empty($_POST["txtCantidad"])|| empty($_POST["txtMoney"])|| empty($_POST["txtFpedido"])|| empty($_POST["txtFentrega"])) {
    header('Location: index.php');
    exit();
}


include_once 'model/conexion.php';
$codigo = $_POST["codigo"];
$nom_arreglo = $_POST["txtArreglo"];
$cantidad = $_POST["txtCantidad"];
$precio = $_POST["txtMoney"];
$fec_pedido = $_POST["txtFpedido"];
$fec_entrega = $_POST["txtFentrega"];



$sentencia = $bd->prepare("INSERT INTO pedido(id_cliente,nom_arreglo,cantidad,precio,fec_pedido,fec_entrega) VALUES (?,?,?,?,?,?);");
$resultado = $sentencia->execute([$codigo,$nom_arreglo,$cantidad,$precio,$fec_pedido,$fec_entrega ]);

if ($resultado === TRUE) {
    header('Location: agregarPedido.php?codigo='.$codigo);
} 