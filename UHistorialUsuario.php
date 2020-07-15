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
                <form action="UHistorialUsuario.php" method="POST">
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
                        <input type="submit" class="btn_MenuUsuario" name="btn_Multimedia" value="Multimedia"
                            onclick="">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial"
                            onclick="window.location.href='UHistorialUsuario.php'">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                            onclick="window.location.href='UInformarError.php'">
                    </div>
                    <div class="Datos-Pag1">
                        <form action="">

                        </form>
                        <table class="tablaHistorialCompra">
                            <tr class="trHistorialCompra">
                                <td class="tdHistorialCompra"><strong>Historial Compras</strong></td>
                            </tr>
                            <?php
                                    $idUser = $_SESSION["usuario"];
                                    $idCompra;
                                    //Select compra del historial
                                    $sql = "SELECT * FROM historialusuario WHERE usuario_idUsuario = '".$idUser."'";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){   
                                            echo 
                                            '<tr class="trHistorialCompra">
                                                <td class="tdHistorialCompra">
                                                <strong> id Compra: '.$row["compra_idCompra"].'';
                                            $idCompra = $row["compra_idCompra"];
                                            

                                            //WHERE (idTipo='$tipoS')and(Granja_idGranja='$idGranja')and(Estado='Vendido')"

                                            //select id compra
                                            $sql2 = "SELECT * FROM compra WHERE idCompra = '".$row["compra_idCompra"]."'";
                                            $result2 = $conn->query($sql2);
                                            if($result2 ->num_rows > 0){
                                                while($row = $result2 -> fetch_assoc()){ 
                                                    $idAnimal = $row["Animal_idAnimal"]; 
                                                    $idAlimento = $row["Alimento_idAlimento"];
                                                    //select id animal
                                                    $sql3 = "SELECT * FROM animal WHERE idAnimal = '".$row["Animal_idAnimal"]."'";
                                                    $result3 = $conn->query($sql3);
                                                    if($result3 ->num_rows > 0){
                                                        while($row = $result3 -> fetch_assoc()){  
                                                            echo 
                                                            '   Nombre: '.$row["Nombre"].' / Precio: '.$row["Precio"].'</strong>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    }

                                                    $sql4 = "SELECT * FROM alimento WHERE idAlimento = '".$row["Alimento_idAlimento"]."'";
                                                    $result4 = $conn->query($sql4);
                                                    if($result4 ->num_rows > 0){
                                                        while($row = $result4 -> fetch_assoc()){  
                                                            echo 
                                                            '   Nombre: '.$row["Nombre"].' / Precio: '.$row["Precio"].'</strong>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    }

                                                }   
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




















































































