<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, icarnetial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>
<body>
    
    <?php
   
    

    $pdp_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
    $conexion =new PDO('mysql:host=localhost;dbname=final_0907232720', 'root', '', $pdp_options);

    

    if(isset($_POST["Accion"])){
        
        if ($_POST["Accion"] == "Crear"){
            $insert = $conexion->prepare("INSERT INTO alumno (carnet, nombre, grado, telefono) VALUES
            (:carnet, :nombre, :grado, :telefono)");
            $insert->bindValue('carnet', $_POST['carnet']);
            $insert->bindValue('nombre', $_POST['nombre']);
            $insert->bindValue('grado', $_POST['grado']);
            $insert->bindValue('telefono', $_POST['telefono']);
            $insert->execute();
        }
    }

    
    $select = $conexion->query("SELECT carnet, nombre, grado, telefono FROM alumno");
    
    ?>

    <form method="POST">
        <input type="text" name="carnet" placeholder="Ingrese el carnet"/>
        <input type="text" name="nombre" placeholder="Ingrese el nombre"/>
        <input type="text" name="grado" placeholder="Ingrese el grado"/>
        <input type="text" name="telefono" placeholder="Ingrese el telefono"/>
        <input type="hidden" name="Accion" value="Crear"/>
        <button type="submit">Crear</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>carnet</th>
                <th>nombre</th>
                <th>grado</th>
                <th>telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($select->fetchAll() as $alumno){ ?>
                <tr>
                    <td><?php echo $alumno["carnet"] ?></td>
                    <td><?php echo $alumno["nombre"] ?></td>
                    <td><?php echo $alumno["grado"] ?></td>
                    <td><?php echo $alumno["telefono"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
   
</body>
</html>


