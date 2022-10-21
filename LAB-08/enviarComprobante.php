<?php
if (!isset($_GET['codigo'])) {
    header('Location: agregarPedido.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT com.reseña, com.imagen, com.total , com.id_cliente, cli.nombres , cli.apellido_paterno ,cli.apellido_materno,cli.direccion , cli.dni , cli.fec_nacimiento, cli.celular
  FROM comprobante com 
  INNER JOIN clientes cli ON cli.id_cliente = com.id_cliente 
  WHERE com.id = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://whapi.io/api/send';
    $data = [
        "app" => [
            "id" => '51963768928',
            "time" => '1654728819',
            "data" => [
                "recipient" => [
                    "id" => '51'.$cliente->celular
                ],
                "message" => [[
                    "time" => '1654728819',
                    "type" => 'text',
                    "value" => 'Estimado(a) *'.strtoupper($cliente->nombres).' '.strtoupper($cliente->apellido_paterno).' '.strtoupper($cliente->apellido_materno).'------> *'.strtoupper($cliente->reseña).'*'
                ]]
            ]
        ]
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPedido.php?codigo='.$clientes->id_cliente);
?>