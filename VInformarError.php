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
        <div class="medi-granja">
            <div class="anunciosD">
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
            </div>
            <div class="contenedor-medio-vete">
                <div class="contenido">
                    <div class="Menu-Medio-granja">
                        <input type="submit" class="btn_MenuVete" name="btn_Animales" value="Chequear Animales"
                            onclick="window.location.href='VCatalogo.php'" style=" width: 200px; ">
                        <input type="submit" class="btn_MenuVete" name="btn_Checar" value="Informar"
                            onclick="window.location.href='VInformarError.php'">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                            onclick="window.location.href='VInformarError.php'">
                    </div>
                    <div class="Datos-Pag3">
                    <form action="" method="POST">
                    <table class="tablaErroresVete">
                    
                        <tr class="trTablaErroresVete">
                        
                            <td class="tdTablaErroresVete"><label class="labelErrores">Tipo de error : </label><Select name="tipoError" id="error" required>
                                    <option value="Error 1">Error 1</option>
                                    <option value="Error 2">Error 2</option>
                                    <option value="Error 3">Error 3</option>
                                    <option value="Error 4">Error 4</option>
                                    <option value="Error 5">Error 5</option>
                                    <option value="Error 6">Error 6</option>

                                </Select></td>
                            
                            <td class="tdTablaErroresVete"><label class="labelErrores">Asunto :</label><input type="text" name="asunto" required></td>

                        </tr>
                        <tr class="trTablaErroresVete">
                        
                            <td class="tdTablaErroresVete"><label class="labelErrores">Descripcion : </label></td>

                        </tr > 
                        <tr class="trTablaErroresVete">
                        
                            <td class="tdTablaErroresVete"><textarea class="areaErrores" name="Desc" id="" cols="60" rows="15" required></textarea></td>   

                        </tr>
                        <tr class="trTablaErroresVete">
                        
                            <td class="tdTablaErroresVete"><input class="btn_Errores" type="submit" name="Volver" value="Volver" onclick="javascript:history.go(-1)"> <input class="btn_Errores" type="submit" name="Enviar" value="Enviar"></td>
                        
                        </tr>
                    </table>
                    </form> 
                    <?php
                        if(isset($_POST['Enviar']))
                        {
                            $idVeterinario = $_SESSION["veterinario"];
                            
                                
                                
                            $tipo = $_POST['tipoError'];
                            $asunto = $_POST['asunto'];
                            $desc = $_POST['Desc'];

                            $sql2 = "INSERT INTO reporteerrores (tipoError,asunto,descripcionError,veterinario_idVeterinario) VALUES ('".$tipo."','".$asunto."','".$desc."','".$idVeterinario."')";
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
