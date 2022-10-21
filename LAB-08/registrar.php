<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApPaterno"]) || empty($_POST["txtApMaterno"]) || empty($_POST["txtDireccion"]) || empty($_POST["txtDni"])|| empty($_POST["txtFechaNacimiento"]) || empty($_POST["txtCelular"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombres = $_POST["txtNombres"];
$apellido_paterno = $_POST["txtApPaterno"];
$apellido_materno = $_POST["txtApMaterno"];
$direccion = $_POST["txtDireccion"];
$dni = $_POST["txtDni"];
$fec_nacimiento = $_POST["txtFechaNacimiento"];
$celular = $_POST["txtCelular"];

$sentencia = $bd->prepare("INSERT INTO clientes(nombres,apellido_paterno,apellido_materno,direccion,dni,fec_nacimiento,celular) VALUES (?,?,?,?,?,?,?);");
$resultado = $sentencia->execute([$nombres, $apellido_paterno, $apellido_materno, $direccion, $dni, $fec_nacimiento, $celular]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
