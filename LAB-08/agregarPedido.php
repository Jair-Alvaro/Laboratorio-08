<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from clientes where id_cliente = ?;");
$sentencia->execute([$codigo]);
$cliente = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_pedido = $bd->prepare("select * from pedido where id_pedido = ?;");
$sentencia_pedido->execute([$codigo]);
$pedido = $sentencia_pedido->fetchAll(PDO::FETCH_OBJ); 
//print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class=" carta card-header">
                    Ingresar  : <br><?php echo $cliente->nombres.' '.$cliente->apellido_paterno.' '.$cliente->apellido_materno; ?>
                </div>
                <form class="p-4" method="POST" action="registrarPedido.php">
                    <div class="mb-3">
                        <label class="form-label">Arreglo: </label>
                        <input type="text" class="form-control" name="txtArreglo" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad: </label>
                        <input type="number" class="form-control" name="txtCantidad" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Money: </label>
                        <input type="number" class="form-control" name="txtMoney" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha del pedido: </label>
                        <input type="date" class="form-control" name="txtFpedido" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de entrega: </label>
                        <input type="date" class="form-control" name="txtFentrega" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $cliente->id_cliente; ?>"><P></P>
                        <input class="submit" type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
                <br>
                <br>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="carta card-header">
                    Lista de Pedidos
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead class="contenedor_datos">
                            <tr class="contenedor_datos">
                                <th scope="col">#</th>
                                <th scope="col">Arreglo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Money</th>
                                <th scope="col">F-Pedido</th>
                                <th scope="col">F-Entrega</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pedido as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id_pedido; ?></td>
                                    <td><?php echo $dato->nom_arreglo; ?></td>
                                    <td><?php echo $dato->cantidad; ?></td>
                                    <td><?php echo $dato->precio; ?></td>
                                    <td><?php echo $dato->fec_pedido; ?></td>
                                    <td><?php echo $dato->fec_entrega ; ?></td>
                                    <td><a class="text-success" href="editarPedido.php?codigo=<?php echo $dato->id_pedido; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminarPedido.php?codigo=<?php echo $dato->id_pedido; ?>"><i class="bi bi-trash"></i></a></td>
                                    <td><a class="text-primary" href="enviarComprobante.php?codigo=<?php echo $dato->id_pedido; ?>"><i class="bi bi-cursor"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            