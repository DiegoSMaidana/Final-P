<?php include ("../template/cabecera.php");?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtDni=(isset($_POST['txtDni']))?$_POST['txtDni']:"";
$txtDomicilio=(isset($_POST['txtDomicilio']))?$_POST['txtDomicilio']:"";
$txtContacto=(isset($_POST['txtContacto']))?$_POST['txtContacto']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$host="localhost";
$db="ingresantes";
$usuario="root";
$contrasenia="";

try {
    $conexion= new PDO ("mysql:host=$host;dbname=$db",$usuario,$contrasenia);
    if ($conexion){ echo "Conectado...a Sistema";}
} catch (Exception $ex) {
    echo $ex-> getMessage();
}


switch ($accion) {
    case "Agregar":
        $sentenciaSql = $conexion->prepare("INSERT INTO `ingresantes` 
        (`id_ingresante`, `nombre`, `apellido`, `dni`, `domicilio`, `numero_contacto`, `correo`, `FK_id_inscripcion`, `FK_id_curso`) 
        VALUES (:nombre, :apellido, :dni, :domicilio, :contacto, :email, null, null)");

        $sentenciaSql->bindParam(':id', $txtID);
        $sentenciaSql->bindParam(':nombre', $TextNombre);
        $sentenciaSql->bindParam(':apellido', $TextApellido);
        $sentenciaSql->bindParam(':dni', $TextDni);
        $sentenciaSql->bindParam(':domicilio', $TextDomicilio);
        $sentenciaSql->bindParam(':contacto', $TextContacto);
        $sentenciaSql->bindParam(':email', $TextoEmail);

        $sentenciaSql->execute();
        echo "Presionado botón agregar";
        break;
    
}

?>

<div class="col-md-5">
 <div class="card">
    <div class="card-header">
        Datos de Estudiantes 
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" class="form-control" name="TxtID" id="txtID"  placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" class="form-control" name="TxtNombre" id="txtNombre"  placeholder="Nombre">
    </div>

    <div class = "form-group">
    <label for="txtApellido">Apellido:</label>
    <input type="text" class="form-control" name="TxtApellido" id="txtApellido"  placeholder="Apellido">
    </div>

    <div class = "form-group">
    <label for="txtDni">DNI:</label>
    <input type="text" class="form-control" name="TxtDni" id="txtDni"  placeholder="Dni">
    </div>

    <div class = "form-group">
    <label for="txtDomicilio">Domicilio:</label>
    <input type="text" class="form-control" name="TxtDomicilio" id="txtDomicilio"  placeholder="Domicilio">
    </div>

    <div class = "form-group">
    <label for="txtContacto">Contacto:</label>
    <input type="text" class="form-control" name="TxtContacto" id="txtContacto"  placeholder="Contacto">
    </div>

    <div class = "form-group">
    <label for="txtEmail">Email:</label>
    <input type="text" class="form-control" name="TxtEmail" id="txtEmail"  placeholder="Email">
    </div>


    <div class="btn-group" role="group" aria-label="">
        <button type="button" name="Agregar" value="Agregar" class="btn btn-success">Agregar</button>
        <button type="button" name="Modificar" value="Modificar" class="btn btn-warning">Modificar</button>
        <button type="button" name="Cancelar" value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>
    
    
    </form>

    </div>

 </div>

</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dni</th>
                <th>Domicilio</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>3</td>
                <td>Diego</td>
                <td>Maidana</td>
                <td>38102136</td>
                <td>Balbin</td>
                <td>2964497229</td>
                <td>dsmaidana@tdf.edu.ar</td>
                <td>Seleccionar | Borrar</td>
            </tr>
           
        </tbody>
    </table>
</div>


<?php include ("../template/pie.php");?>