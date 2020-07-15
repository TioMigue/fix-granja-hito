<?php
    require 'conexion.php';
    session_start();
?>
<script>
function login() {
    window.location = "";
}
function refresh() {
    window.location = "";
}
</script>
<script>
function verGranja() {
    window.location = "ADatosGranja.php";
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>

<body>
    <div class="contenedor">
        <!-- Seccion arriba -->
        <div class="arriba">
            <div class="login2">
                <form action="AVerGranjas.php" method="POST">
                    <table>
                        <?php
                        if(isset($_SESSION["admini"])){
                            echo
                            '<tr>
                                <td><label>'.$_SESSION["admini"].'</label></td>
                                <td><input type="submit" value="Cerrar Sesion" name="btnCerrarSesion"></td>
                            </tr>';
                        }else{
                            echo '
                                <tr>
                                    
                                    <td><input class="inputLogin"  type="text" name="Usuario" placeholder="Usuario" required></td>
                                </tr>

                                <tr>
                                    <td><input class="inputLogin"  type="text" name="Contrasena" placeholder="Contraseña" required></td>
                                    <td><input class="btnLogin"type="submit" value="Login" name="btnLogin"></td>
                                </tr>
                                <tr>
                                    <td><a href="URegistroUsuario.php">Registrate Aqui</a></td>                         
                                </tr>
                            ';
                        }
                    ?>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btnLogin'])){
                        $usuario = $_POST['Usuario'];
                        $contrasena = $_POST['Contrasena'];
                        $idAdmin;
                        $sql = "SELECT * FROM administrador";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $contrasenaB = $row["clave"];
                                $usuarioB = $row["user"];
                                $idAdmin = $row["idAdmin"];
                            }
                            mysqli_close($conn);
                        }         
                        if($usuario == $usuarioB && $contrasena == $contrasenaB){
                            $_SESSION["admini"] = $idAdmin;
                            echo '<script>window.location = "#" </script>';
                        }else{
                            echo '<script>alert("Usuario o contraseña incorrectos")</script>';
                        }
                    }
                    if(isset($_POST['btnCerrarSesion'])){
                        session_destroy();
                        echo '<script>refresh()</script>';          
                    }
                ?>
            </div>

            <div class="contenedor-arriba">

            </div>
        </div>
        <!-- Seccion media -->
        <div class="medio-admin">
            <div class="anunciosD">
                <div class="anuncioD"></div>
                <div class="anuncioD"></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"></div>
                <div class="anuncioI"></div>
            </div>
            <div class="contenedor-medio-administrador">
                <div class="contenido">
                <div class="Menu-Medio-Admin">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Animales" value="Ingresar Animales" 
                                onclick="window.location.href='AAgregarAnimal.php'">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Alimento" value="Ingresar Alimento"
                            onclick="window.location.href='AAgregarAlimento.php'">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Historial" value="Gestionar Granjas"
                            onclick="window.location.href='AGestionarGranjas.php'">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                                onclick="window.location.href='UInformarError.php'">   
                        </div>
                    <div class="Datos-Pag2">
                        <form action="">

                        </form>
                        <table class="tablaGestionGranjas">
                            <tr class="trEmpleadosGranjas">
                                <form action="" method="POST">
                                    <td class="tdGestionGranjas"><strong>Granjas</strong></td>
                                    <td class="tdGestionGranjas"><strong>Filtrar Granja</strong>
                                        <select name="granja[]" id="">
                                            <option value="todo">Selecionar granja</option>
                                            <?php
                                    $sql = "SELECT * FROM granja";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        echo "<option value=".$row['idGranja'].">".$row['Nombre']."</option>";                                                     
                                        }
                                    }
                                    ?>
                                        </select>
                                    </td>

                                    <td class="tdGestionGranjas"><input class="inputDatosGranjas" name="verGranja"
                                            value="Filtrar" type="submit"></td>
                                </form>
                                <?php
                                   if(isset($_POST['verGranja'])){
                                        $granja = $_POST['granja'];
                                        for ($i=0; $i <count($granja); $i++) { 
                                            $granjaS = $granja[$i];
                                        }
                                   }
                                ?>
                            </tr>
                            <tr class="trTablaGestionGranjas">
                                <td class="tdTablaGestionGranjas">
                                    <table class="tablaEmpleadosGranja">
                                        <tr class="trEmpleadosGranja">
                                            <form action="" method="POST">
                                                <td class="tdEmpleadosGranjaCont">
                                                    <?php
                                                    if(!isset($_POST['verGranja'])){
                                                        $sql = "SELECT * FROM granja";
                                                        $result = $conn->query($sql);
                                                        if($result ->num_rows > 0){
                                                        while($row = $result -> fetch_assoc()){
                                                            echo "<label name='".$row['Nombre']."'> Nombre: ".$row['Nombre']." ---- </label>";
                                                            echo "<label name='".$row['Direccion']."'> Direccion: ".$row['Direccion']." ---- </label>";
                                                            echo "<label name='".$row['RUN']."'> RUN: ".$row['RUN']." ---- </label>";
                                                            echo "<label name='".$row['Descripcion']."'> Descripcion: ".$row['Descripcion']."</label>"; 
                                                            echo "<input type='submit' name='irGranja' value='Ver granja' style='margin-left: 20px;' onclick='window.location.href='ADatosGranja.php?granja=".$row['RUN']."''>"; 
                                                            echo "<br>";                                               
                                                            }
                                                        }   
                                                    }if(isset($_POST['verGranja'])){
                                                        if($granjaS == 'todo'){
                                                            $sql = "SELECT * FROM granja";
                                                            $result = $conn->query($sql);
                                                            if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo "<label name='".$row['Nombre']."'> Nombre: ".$row['Nombre']." ---- </label>";
                                                            echo "<label name='".$row['Direccion']."'> Direccion: ".$row['Direccion']." ---- </label>";
                                                            echo "<label name='".$row['RUN']."'> RUN: ".$row['RUN']." ---- </label>";
                                                            echo "<label name='".$row['Descripcion']."'> Descripcion: ".$row['Descripcion']."</label>"; 
                                                            echo "<input type='submit' name='irGranja' value='Ver granja' style='margin-left: 20px;' onclick='window.location.href='ADatosGranja.php?granja=".$row['RUN']."''>"; 
                                                            echo "<br>";                                                     
                                                            }
                                                        }
                                                        }else{
                                                            $sql = "SELECT * FROM granja WHERE idGranja ='".$granjaS."'";
                                                            $result = $conn->query($sql);
                                                            if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo "<label name='".$row['Nombre']."'> Nombre: ".$row['Nombre']." ---- </label>";
                                                                echo "<label name='".$row['Direccion']."'> Direccion: ".$row['Direccion']." ---- </label>";
                                                                echo "<label name='".$row['RUN']."'> RUN: ".$row['RUN']." ---- </label>";
                                                                echo "<label name='".$row['Descripcion']."'> Descripcion: ".$row['Descripcion']."</label>"; 
                                                                echo "<input type='submit' name='irGranja' value='Ver granja' style='margin-left: 20px;' onclick='window.location.href='ADatosGranja.php?granja=".$row['RUN']."''>"; 
                                                                echo "<br>";                                                   
                                                            }
                                                        }
                                                        }
                                                        
                                                    }
                                                ?>
                                                </td>
                                            </form>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trGestionGranjas">
                                <td class="tdBtnsGestionGranjas"><input type="submit" value="Volver"
                                        class="btn_AccionesGestion">
                                    <input type="submit" value="Ver granjas" class="btn_AccionesGestion">
                                    <input type="submit" value="Ingresar" class="btn_AccionesGestion">
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion abajo -->
    </div>
</body>

</html>