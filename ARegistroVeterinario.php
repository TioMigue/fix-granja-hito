
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
        <div class="login2">
            <form action="ARegistroVeterinario.php" method="POST">
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
                <div class="contenidoAdmin">
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
                        <form class="formAdmin" action="" method="POST">
                            <table class="tablaAdmin">
                                <tr class="trFormularioAdmin">
                                <td class="tdFormAdmin"> <label class="labelForm" for="">Granja: </label></td>
                                    <td class="tdFormAdmin">
                                        <select name="granja[]" id="">
                                        <?php
                                            $sql = "SELECT * FROM granja";
                                            $result = $conn->query($sql);
                                            if($result ->num_rows > 0){
                                                while($row = $result -> fetch_assoc()){
                                                    echo '
                                                        <option value='.$row['idGranja'].'>'.$row['Nombre'].'</option>
                                                    ';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Nombre: </label></td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtNombre" required></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Apellido: </label>  </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtApellido" required></td>
                                    
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Rut: </label>  </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtRut" required></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Edad: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin"  type="text" name="txtEdad" required></td>
                                    
                                </tr>
                                <tr class="trFormularioAdmin"> 
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Telefono: </label>  </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtTelefono" required></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Direccion: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtDireccion" required></td>
                                
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Contraseña: </label>  </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="password" name="txtContrasena" required></td>
                                
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin">  </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit" value="Volver" onclick="window.location.href='AGestionarGranjas.php'"></td>
                                    <td class="tdFormAdmin">  </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit" name="registrarVeterinario" value="Registrar"></td>                              
                                </tr>
                            </table>
                        </form>  
                        <?php
                            if(isset($_POST['registrarVeterinario'])){
                                $nombre = $_POST['txtNombre'];
                                $apellido = $_POST['txtApellido'];
                                $rut = $_POST['txtRut'];
                                $edad = $_POST['txtEdad'];
                                $direccion = $_POST['txtDireccion'];
                                $telefono = $_POST['txtTelefono'];
                                $clave = $_POST['txtContrasena'];
                                
                                $granja = $_POST['granja'];

                                for ($i=0; $i <count($granja); $i++) { 
                                   
                                    $granjaS = $granja[$i];
                                }

                                $sql = "INSERT INTO veterinario (Nombre, Apellido, Rut, Edad, Direccion, Telefono, Granja_idGranja, clave) VALUES ('".$nombre."','".$apellido."','".$rut."','".$edad."','".$direccion."','".$telefono."','".$granjaS."','".$clave."')";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<script type="text/javascript">alert("Granjero ingresado correctamente")</script>';
                                    mysqli_close($conn);
                                    }else{
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                echo "granja: ".$granjaS;
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