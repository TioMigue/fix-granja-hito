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
            <form action="UInformarError.php" method="POST">
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
                                onclick="window.location.href='UHistorialUsuario.php'">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial"
                                onclick="window.location.href='UHistorialUsuario.php'">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                                onclick="window.location.href='UInformarError.php'">
                        </div>
                    <div class="Datos-Pag2">
                    <form action="" method="POST">
                    <table class="tablaErrores">
                    
                        <tr class="trTablaErrores">
                        
                            <td class="tdTablaErrores"><label class="labelErrores">Tipo de error : </label><Select name="tipoError" id="error" required>
                                    <option value="Error 1">Error 1</option>
                                    <option value="Error 2">Error 2</option>
                                    <option value="Error 3">Error 3</option>
                                    <option value="Error 4">Error 4</option>
                                    <option value="Error 5">Error 5</option>
                                    <option value="Error 6">Error 6</option>

                                </Select></td>
                            
                            <td class="tdTablaErrores"><label class="labelErrores">Asunto :</label><input type="text" name="asunto" required></td>

                        </tr>
                        <tr class="trTablaErrores">
                        
                            <td class="tdTablaErrores"><label class="labelErrores">Descripcion : </label></td>

                        </tr > 
                        <tr class="trTablaErrores">
                        
                            <td class="tdTablaErrores"><textarea class="areaErrores" name="Desc" id="" cols="60" rows="15" required></textarea></td>   

                        </tr>
                        <tr class="trTablaErrores">
                        
                            <td class="tdTablaErrores"><input class="btn_Errores" type="submit" name="Volver" value="Volver" onclick="javascript:history.go(-1)"> <input class="btn_Errores" type="submit" name="Enviar" value="Enviar"></td>
                        
                        </tr>
                    </table>
                    </form> 
                    <?php
                        if(isset($_POST['Enviar']))
                        {
                            $idUser = $_SESSION["usuario"];
                            /*$idUsuario;
                            $sql = "SELECT * FROM usuario WHERE Nombre ='".$_SESSION["usuario"]."'";
                            $result = $conn->query($sql);
                            if($result ->num_rows > 0){
                                while($row = $result -> fetch_assoc()){
                                    $idUsuario = $row["idUsuario"];
                                }
                            }*/    
                                
                            $tipo = $_POST['tipoError'];
                            $asunto = $_POST['asunto'];
                            $desc = $_POST['Desc'];

                            $sql2 = "INSERT INTO reporteerrores (tipoError,asunto,descripcionError,usuario_idUsuario) VALUES ('".$tipo."','".$asunto."','".$desc."','".$idUser."')";
                            if (mysqli_query($conn, $sql2)) {
                                echo '<script type="text/javascript">alert("Error registrado")</script>';
                                mysqli_close($conn);
                                }else{
                                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                                }
                        }
                    ?>                    
                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion abajo -->
    </div>
</body>
</html>
