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
            <div class="login">
                <form action="UVerAnimal.php" method="POST">
                    <table>
                        <?php
                        if(isset($_SESSION["usuario"])){
                            echo
                            '<tr>
                                <td><label>'.$_SESSION["usuario"].'</label></td>
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
                        $idUser;
                        $sql = "SELECT * FROM usuario WHERE Nombre = '".$usuario."'";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $contrasenaB = $row["Contrasena"];
                                $usuarioB = $row["Nombre"];
                                $idUser = $row["idUsuario"];
                            }
                            mysqli_close($conn);
                        }        
                        
                        
                        if($usuario == $usuarioB && $contrasena == $contrasenaB){
                            $_SESSION["usuario"] = $idUser;
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
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
            </div>
            <div class="contenedor-medio-usuario">
                <div class="contenido">
                    <div class="Menu-Medio">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Home" value="Home"
                            onclick="window.location.href='index.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Catalogo" value="Catalogo"
                            onclick="window.location.href='UCatalogo.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Animales" value="Animales"
                            onclick="window.location.href='UAnimalesUsuario.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Multimedia" value="Multimedia">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial"
                            onclick="window.location.href='UHistorialUsuario.php'">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                            onclick="window.location.href='UInformarError.php'">
                    </div>
                    <div class="Datos-Pag2">
                        <form action="" method="POST">
                            <table class="tablaComprar">
                                <tr class="trComprar">
                                    <?php
                                        $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                            while($row = $result -> fetch_assoc()){
                                                echo "<td class='tdImgComprar'><img class='testImg' src='img/".$row['Nombre'].".jpg' alt=''></td>";                                             
                                            }
                                        }    
                                    ?>
                                    <td class="tdDatosComprar">
                                        <table class="tablaDatos">
                                            <tr class="trComprar">
                                                <td class="tdTipoComprarVer">
                                                    <?php
                                                        $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                                        $result = $conn->query($sql);
                                                        if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo '<input type="hidden" name="animal" value="'.$row['idAnimal'].'"/>';
                                                                echo "<label class='lblver' value='".$row['Nombre']."'>Nombre: ".$row['Nombre']." / </label>";
                                                                echo "<label class='lblver' value='".$row['Edad']."'>Edad: ".$row['Edad']." / </label>";
                                                                echo "<label class='lblver' value='".$row['Tamanio']."'>Tamaño: ".$row['Tamanio']."/ </label>";
                                                                echo "<label class='lblver' value='".$row['Peso']."'>Peso: ".$row['Peso']."</label>";                                                     
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr class="trComprar">
                                                <td class="tdPagoComprar">
                                                   <input class="btn_ComprarVer" type="submit" name="Chequeo" value="Ver Chequeo Medico">
                                                   <input class="btn_ComprarVer" type="submit" name="Comprar" value="Comprar alimento">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr class="trComprar">
                                    <td class="tdDescripcionComprar"><strong></strong></td>
                                    <td class="tdBotonesComprar"><input class="btn_Comprar" type="submit"
                                            value="Volver" onclick="javascript:history.go(-1)"> 
                                    </td>
                                </tr>
                        </form>
                            <?php
                                if(isset($_POST["Comprar"])){
                                    $animal = $_POST["animal"];
                                    if($_SESSION["usuario"] == null){
                                        echo "<script>window.location = 'index.php'</script>";
                                    }else{
                                        echo "<script>window.location = 'UComprarAlimento.php?animal=".$animal."'</script>";
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