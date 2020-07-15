<?php
require 'conexion.php';
session_start();
?>
<script>
function login() {
    window.location = "";
}
function refresh() {
    window.location = "VCatalogo.php";
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
        <div class="login3">
                <form action="VInformarError.php" method="POST">
                    <table>
                        <?php
                        if(isset($_SESSION["veterinario"])){
                            echo
                            '<tr>
                                <td><label>'.$_SESSION["veterinario"].'</label></td>
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
                        $idVeterinario;
                        $sql = "SELECT * FROM veterinario WHERE Nombre = '".$usuario."'";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $contrasenaB = $row["clave"];
                                $usuarioB = $row["Nombre"];
                                $idVeterinario = $row["idVeterinario"];
                            }
                            mysqli_close($conn);
                        }        
                        if($usuario == $usuarioB && $contrasena == $contrasenaB){
                            $_SESSION["veterinario"] = $idVeterinario;
                            echo '<script>login()</script>';
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
        <div class="medio">
            <div class="anunciosD">
                <div class="anuncioD"></div>
                <div class="anuncioD"></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"></div>
                <div class="anuncioI"></div>
            </div>
            <div class="contenedor-medio-vete">
                <div class="contenido">
                <div class="Menu-Medio">
                        <input type="submit" class="btn_MenuVete" name="btn_Animales" value="Chequear Animales"
                            onclick="window.location.href='VCatalogo.php'" style=" width: 200px; ">
                        <input type="submit" class="btn_MenuVete" name="btn_Checar" value="Informar"
                            onclick="window.location.href='VInformarError.php'">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                            onclick="window.location.href='VInformarError.php'">
                    </div>
                    <div class="Datos-Pag2">
                        <form action="" method="POST">
                            <table class="tablaChequeo">
                                <tr class="trChequeo">
                                    <?php
                                        $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                            while($row = $result -> fetch_assoc()){
                                                echo "<td class='tdImgComprar'><img class='testImg' src='img/".$row['Nombre'].".jpg' alt=''></td>";                                             
                                            }
                                        }    
                                    ?>
                                    <td class="tdDatosChequeo">
                                        <table class="tablaDatosC">
                                            <tr class="trComprarC">
                                                <td class="tdTipoComprarC">
                                                    <?php
                                                        $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                                        $result = $conn->query($sql);
                                                        if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo '<input type="hidden" name="animal" value="'.$row['idAnimal'].'"/>';
                                                                echo "<label value='".$row['Nombre']."'>Nombre: ".$row['Nombre']." / </label>";
                                                                echo "<label value='".$row['Edad']."'>Edad: ".$row['Edad']." / </label>";
                                                                echo "<label value='".$row['Tamanio']."'>Tamaño: ".$row['Tamanio']."/ </label>";
                                                                echo "<label value='".$row['Peso']."'>Peso: ".$row['Peso']."</label>";                                                     
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr class="trComprarC">
                                                <td class="tdPrecioComprarC">
                                                    <strong>Asunto : </strong> <input type="text" name="asunto" class="txtAsunto">
                                                </td>
                                            </tr>
                                            <tr class="trComprarC">
                                                <td class="tdPagoComprarC">
                                                    <label class="Comentario">Comentario</label>
                                                    <textarea name="Comentario"  cols="40" rows="10" class="taComentario"></textarea>
                                                </td>
                                                
                                            </tr>
                                            
                                        </table>
                                    </td>

                                </tr>
                                <tr class="trComprar">
                                    <td class="tdDescripcionComprar"><strong>Descripcion del animal</strong></td>
                                    <td class="tdBotonesComprar"><input class="btn_ComprarC" type="submit"
                                            value="Volver"> <input class="btn_ComprarC" type="submit" name="Ingresar" value="Ingresar">
                                    </td>
                                </tr>
                        </form>
                            <?php
                                if(isset($_POST["Ingresar"])){
                                    $idAnimal = $_POST["animal"];
                                    $idVeterinario = $_SESSION["veterinario"];
                                    $asunto = $_POST["asunto"];
                                    $comentario = $_POST["Comentario"];

                                    if($_SESSION["veterinario"] == null){
                                        echo "<script>window.location = 'VIngresarChequeo.php'</script>";
                                    }else{

                                        $sql="INSERT INTO historialmedico (Asunto, Comentario, animal_idAnimal, veterinario_idVeterinario) VALUES ('".$asunto."','".$comentario."','".$idAnimal."','".$idVeterinario."') ";
                                        if (mysqli_query($conn, $sql)) {
                                            echo "<script> alert('Se Ingreso Correctamente') </script>";
                                            mysqli_close($conn);
                                        }else{
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }
                                        

                                        
                                    }
                                    
                                }
                            ?>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion abajo -->
    </div>
</body>

</html>