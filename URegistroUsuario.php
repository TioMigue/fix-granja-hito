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
    <div id="arribaUsuario"  class="contenedor">
        <!-- Seccion arriba -->
        <div class="arriba">
        <div class="login">
                <form action="URegistroUsuario.php" method="POST">
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
                <div class="anuncioD"></div>
                <div class="anuncioD"></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"></div>
                <div class="anuncioI"></div>
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
                    <div class="Datos-Pag">   
                        <form action="URegistroUsuario.php" method="POST">
                            <table class="tabla">
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Nombre: </label></td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtNombre" require></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Apellido: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtApellido" require></td>
                                    
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Rut: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtRut" require></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Edad: </label> </td>
                                    <td class="tdForm"> <input class="inputForm"  type="text" name="txtEdad" require></td>
                                    
                                </tr>
                                <tr class="trFormulario"> 
                                    <td class="tdForm"> <label class="labelForm" for="">Telefono: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtTelefono" require ></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Correo: </label> </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtCorreo" require ></td>
                                
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Contraseña: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="password" name="txtContrasena" require></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Repetir Contraseña: </label> </td>
                                    <td class="tdForm"> <input class="inputForm" type="password" name="txtRContrasena" require ></td>
                                
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm">  </td>
                                    <td class="tdForm"> <input class="btnAcciones" type="button" value="Volver"></td>
                                    <td class="tdForm">  </td>
                                    <td class="tdForm"> <input class="btnAcciones" type="submit" name="btnRegistrar" value="Registrar"></td>                              
                                </tr>
                            </table>
                            <?php
                            if(isset($_POST['btnRegistrar'])){
                                $nombre = $_POST['txtNombre'];
                                $apellido = $_POST['txtApellido'];
                                $edad = $_POST['txtEdad'];
                                $rut = $_POST['txtRut'];
                                $correo = $_POST['txtCorreo'];
                                $telefono = $_POST['txtTelefono'];
                                $contrasena = $_POST['txtContrasena'];
                                $Rcontrasena = $_POST['txtRContrasena'];
                                if($contrasena == $Rcontrasena){
                                    $sql = "INSERT INTO usuario (Nombre, Apellido, Rut, Edad, Telefono, Correo, Contrasena) VALUES ('".$nombre."','".$apellido."','".$rut."','".$edad."','".$telefono."','".$correo."','".$contrasena."')";
                                    if (mysqli_query($conn, $sql)) {
                                      echo '<script type="text/javascript">alert("Usuario registrado correctamente")</script>';
                                      mysqli_close($conn);
                                      }else{
                                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                      }
                                    }else{
                                      echo '<script type="text/javascript">alert("Las contraseñas no coinciden")</script>';
                                      mysqli_close($conn);
                                    }
                            }
                        ?> 
                        </form>    
                                       
                    </div>
                </div>
            </div>           
        </div>
        <!-- Seccion abajo -->
    </div>
</body>
</html>