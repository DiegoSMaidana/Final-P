<?php include ("../template/cabecera.php");?>

<?php
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : null;
$txtApellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : null;
$txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : null;
$txtDomicilio = isset($_POST['txtDomicilio']) ? $_POST['txtDomicilio'] : null;
$accion = isset($_POST['accion']) ? $_POST['accion'] : null;

include("../config/db.php");

switch($accion){

    case "Agregar":
    //INSERT INTO `alumno` (`id_alumno`, `apellido`, `nombre`, `domicilio`) VALUES (NULL, 'Martinez', 'Carla', 'Balbin');
    $sentenciaSQL=$conexion->prepare
    ("INSERT INTO `alumno` (`apellido`, `nombre`, `domicilio`)
     VALUES (:apellido, :nombre, :domicilio);");

        $sentenciaSQL->bindParam(':apellido', $txtApellido);
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':domicilio', $txtDomicilio);
        $sentenciaSQL->execute();
    break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE  alumno SET apellido=:apellido, nombre=:nombre, domicilio=:domicilio WHERE id_alumno=:id_alumno");
        $sentenciaSQL->bindParam(':apellido', $txtApellido);
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':domicilio', $txtDomicilio);
        $sentenciaSQL->bindParam(':id_alumno', $txtID);
        $sentenciaSQL->execute();
    break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM alumno WHERE id_alumno=:id_alumno");
        $sentenciaSQL->bindParam(':id_alumno',$txtID);
        $sentenciaSQL->execute();
        $listaAlumnos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID=$listaAlumnos['id_alumno'];
        $txtApellido=$listaAlumnos['apellido'];
        $txtNombre=$listaAlumnos['nombre'];
        $txtDomicilio=$listaAlumnos['domicilio'];

    
    break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM alumno WHERE id_alumno=:id_alumno");
        $sentenciaSQL->bindParam(':id_alumno',$txtID);
        $sentenciaSQL->execute();

    break;

}

   $sentenciaSQL=$conexion->prepare("SELECT * FROM alumno");
   $sentenciaSQL-> execute();
   $listaAlumnos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>  


<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Datos de Alumnos:
    </div>

    <div class="card-body">
    <form method="POST" action="estudiantes.php">
    <div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
     </div>

    <div class = "form-group">
    <label for="txtApellido">Apellido:</label>
    <input type="text" class="form-control" value="<?php echo $txtApellido;?>"  name="txtApellido" id="txtApellido" placeholder="Apellido">
     </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
     </div>

    <div class = "form-group">
    <label for="txtDomicilio">Domicilio:</label>
    <input type="text" class="form-control" value="<?php echo $txtDomicilio;?>" name="txtDomicilio" id="txtDomicilio" placeholder="Domicilio">
     </div>


    <div class="btn-group" role="group" aria-label="">
        <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
        <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
        <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>
    
    
    </form>
    

    </div>

</div>
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Domicilio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($listaAlumnos as $alumno) { ?>
            <tr>
                <td><?php echo $alumno['id_alumno'];?></td>
                <td><?php echo $alumno['apellido'];?></td>
                <td><?php echo $alumno['nombre'];?></td>
                <td><?php echo $alumno['domicilio'];?></td>

                <td>
                <form method="post">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $alumno['id_alumno'];?>">
                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                </form>   
                    
                    
                
                </td>



            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include ("../template/pie.php");?>