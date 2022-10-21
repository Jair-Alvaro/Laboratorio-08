<?php include 'template/header.php' ?>3

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from clientes");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center" >
        <div class="col-md-7">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
            <div class="contenedor_datos card md-6" style="width: 50rem;">
                <div class="carta card-header" >
                    Clientes 
                </div>
                <div class="contenedor_datos md-4 p-4">
                    <table class="contenedor_datos table align-middle">
                        <thead class="contenedor_datos">
                            <tr class="contenedor_datos">
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">DNI</th>
                                <th scope="col">F.Nacimiento</th>
                                <th scope="col">Celular</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($clientes as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id_cliente; ?></td>
                                <td><?php echo $dato->nombres; ?></td>
                                <td><?php echo $dato->apellido_paterno; ?></td>
                                <td><?php echo $dato->apellido_materno; ?></td>
                                <td><?php echo $dato->direccion; ?></td>
                                <td><?php echo $dato->dni; ?></td>
                                <td><?php echo $dato->fec_nacimiento; ?></td>
                                <td><?php echo $dato->celular; ?></td>
                                <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->id_cliente; ?>"><i class="bi bi-pencil"></i></a></td>
                                <td><a class="text-warning" href="agregarPedido.php?codigo=<?php echo $dato->id_cliente; ?>"><i class="bi bi-bag-plus"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id_cliente; ?>"><i class="bi bi-trash2-fill"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="margin-top:0 ;float:right;width:23em;">
                <div class="carta card-header">
                    Ingresar datos del Cliente:
                </div>
                <form class="p-5" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="txtNombres" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido Paterno: </label>
                        <input type="text" class="form-control" name="txtApPaterno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido Materno: </label>
                        <input type="text" class="form-control" name="txtApMaterno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección: </label>
                        <input type="text" class="form-control" name="txtDireccion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DNI: </label>
                        <input type="number" class="form-control" name="txtDni" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento: </label>
                        <input type="date" class="form-control" name="txtFechaNacimiento" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular: </label>
                        <input type="number" class="form-control" name="txtCelular" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input class="submit" type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
<br>
<br>
<?php include 'template/footer.php' ?>