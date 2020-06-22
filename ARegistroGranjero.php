<?php
    require 'conexion.php';
?>

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
                <table>
                    <tr>
                        
                        <td><input class="inputLogin"  type="text" name="Usuario" placeholder="Usuario"></td>
                    </tr>

                    <tr>
                        <td><input class="inputLogin"  type="text" name="Contraseña" placeholder="Contraseña"></td>
                    </tr>
                    <tr>
                        <td> Registrarse Aqui</td>
                        
                    </tr>
                </table>
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
            <div class="contenedor-medio-administrador">
                <div class="contenido">
                    <form action="" method="POST">
                        <div class="Menu-Medio">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Home" value="Home">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Catalogo" value="Catalogo">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Animales" value="Animales">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Multimedia" value="Multimedia">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error">   
                        </div>
                        
                    </form>                  
                    <div class="Datos-Pag2">   
                        <form action="" method="POST">
                            <table class="tabla">
                                <tr class="trFormulario">
                                    <td class="tdForm">
                                        <select name="granja[]" id="">
                                        <?php
                                            $sql = "SELECT * FROM granja";
                                            $result = $conn->query($sql);
                                            if($result ->num_rows > 0){
                                                while($row = $result -> fetch_assoc()){
                                                    echo '<strong>'.$row['Nombre'].'</strong>';
                                                    echo '
                                                        <option value='.$row['Nombre'].'>'.$row['Nombre'].'</option>
                                                        <option value="granja2">granja2</option>
                                                    </select>';
                                                }
                                            }
                                        ?>    
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Nombre: </label></td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtNombre" ></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Apellido: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtApellido" ></td>
                                    
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Rut: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtRut" ></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Edad: </label> </td>
                                    <td class="tdForm"> <input class="inputForm"  type="text" name="txtEdad" ></td>
                                    
                                </tr>
                                <tr class="trFormulario"> 
                                    <td class="tdForm"> <label class="labelForm" for="">Telefono: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtTelefono" ></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Correo: </label> </td>
                                    <td class="tdForm"> <input class="inputForm" type="text" name="txtCorreo" ></td>
                                
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm"> <label class="labelForm" for="">Contraseña: </label>  </td>
                                    <td class="tdForm"> <input class="inputForm" type="password" name="txtContrasena" ></td>
                                    <td class="tdForm"> <label class="labelForm" for="">Repetir Contraseña: </label> </td>
                                    <td class="tdForm"> <input class="inputForm" type="password" name="txtContrasena" ></td>
                                
                                </tr>
                                <tr class="trFormulario">
                                    <td class="tdForm">  </td>
                                    <td class="tdForm"> <input class="btnAcciones" type="submit" value="Volver"></td>
                                    <td class="tdForm">  </td>
                                    <td class="tdForm"> <input class="btnAcciones" type="submit" name="registrarGranjero" value="Registrar"></td>                              
                                </tr>
                            </table>
                        </form>  
                        <?php
                            if(isset($_POST['registrarGranjero'])){
                                $nombre = $_POST['txtNombre'];
                                $apellido = $_POST['txtApellido'];
                                $rut = $_POST['txtRut'];
                                $edad = $_POST['txtEdad'];
                                $telefono = $_POST['txtTelefono'];
                                $correo = $_POST['txtCorreo'];
                                
                                $granja = $_POST['granja'];

                                for ($i=0; $i <count($granja); $i++) { 
                                    echo "<br> Granja" . $i . ": ". $granja[$i];
                                }
                                //$sql = "INSERT INTO granja (Nombre, Direccion, RUN, Descripcion) VALUES ('".$nombre."','".$direccion."','".$RUN."','".$descripcion."')";
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