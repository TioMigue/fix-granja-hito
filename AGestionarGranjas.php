<?php
    require 'conexion.php';
    session_start();
?>
<script>
/**
 * login
 *
 * @return void
 */
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
            <div class="login2">
            <form action="AGestionarGranjas.php" method="POST">
                    <table>
                        <?php
                        if(isset($_SESSION["admini"])){
                            echo
                            '<tr>
                                <td><label>Bienvenido Admin : '.$_SESSION["admini"].'</label></td>
                                <td><input type="submit" value="Cerrar Sesion" name="btnCerrarSesion"></td>
                            </tr>';
                        }else{
                            echo '
                                <tr>
                                    
                                    <td><input class="inputLogin"  type="text" name="Usuario" placeholder="Usuario" required></td>
                                </tr>

                                <tr>
                                    <td><input class="inputLogin"  type="password" name="Contrasena" placeholder="Contraseña" required></td>
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
                            echo '<script>refresh()</script>';  
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
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
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
                            <tr class="trGestionGranjas">
                                <form action="" method="POST">
                                <td class="tdGestionGranjas"><strong>Nombre</strong><input class="inputDatosGranjas" name="txtNombre" type="text" required></td>
                                <td class="tdGestionGranjas"><strong>Direccion</strong><input class="inputDatosGranjas" name="txtDireccion" type="text" required></td>
                                <td class="tdGestionGranjas"><strong>RUN</strong><input class="inputDatosGranjas" name="txtRUN" type="text" required></td>
                                <td class="tdGestionGranjas"><input class="inputDatosGranjas" name="AgregarGranja" value="Agregar" type="submit" style="background-color: lightblue; border: 1px; width: 150px;  height: 30px; margin-top: 15px;"></td>
                                <tr class="trGestionGranjasDesc">
                                    <td class="tdGestionGranjasDesc" style="margin-left:230px;"><strong>Descripcion</strong>
                                    <textarea class="inputDatosGranjasDesc" name="txtDescripcion" cols="45" rows="3" required></textarea>
                                    <!--<input class="inputDatosGranjasDesc" name="txtDescripcion" type="text" required></td>-->
                                </tr>
                                
                                </form>
                                <?php
                                    if(isset($_POST['AgregarGranja'])){
                                        $nombre = $_POST['txtNombre'];
                                        $direccion = $_POST['txtDireccion'];
                                        $RUN = $_POST['txtRUN'];
                                        $descripcion = $_POST['txtDescripcion'];

                                        $sql = "INSERT INTO granja (Nombre, Direccion, RUN, Descripcion) VALUES ('".$nombre."','".$direccion."','".$RUN."','".$descripcion."')";
                                        if (mysqli_query($conn, $sql)){
                                            echo '<script type="text/javascript">alert("Granja registrada correctamente")</script>';
                                            echo '<script>refresh()</script>';  
                                            mysqli_close($conn);
                                            }else{
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                            }
                                    }
                                ?>
                            </tr>
                            <tr class="trTablaGestionGranjas">
                                <td class="tdTablaGestionGranjas">
                                    <table class="tablaEmpleadosGranja">
                                        <tr class="trEmpleadosGranja">
                                                <td class="tdEmpleadosGranja"><strong>Granjero</strong><input type="submit" name="agregarGranjero"class="btnAgregar" value="Agregar Granjero" onclick="window.location.href='ARegistroGranjero.php'"></td>
                                                <td class="tdEmpleadosGranja"><strong>Veterinario</strong><input type="submit" name="agregarVeterinario" class="btnAgregar" value="Agregar Veterinario" onclick="window.location.href='ARegistroVeterinario.php'"></td>
                                            <?php
                                                if(isset($_POST['agregarGranjero'])){
                                                    echo '<script>alert("btn granjero")</script>';
                                                }else if(isset($_POST['agregarVeterinario'])){
                                                    echo '<script>alert("btn veterinario")</script>';
                                                }
                                            ?>
                                        </tr>
                                        <tr class="trEmpleadosGranja">
                                            <td class="tdEmpleadosGranja"><strong>Granjero: </strong>
                                                <select name="" id="">
                                                <option value="">Granjero 1 </option>
                                                <?php
                                                    $sql = "SELECT * FROM granjero WHERE Granja_idGranja = 1";
                                                    $result = $conn->query($sql);
                                                    if($result ->num_rows > 0){
                                                        while($row = $result -> fetch_assoc()){
                                                            echo "<option value=''>".$row['Nombre']." </option>";                                                     
                                                        }
                                                    }
                                                ?>
                                                </select></td>
                                                
                                            <td class="tdEmpleadosGranja"><strong>Veterinario: </strong>
                                                <select name="" id="">
                                                <option value="">Veterinario 1</option>
                                                <?php
                                                    $sql = "SELECT * FROM veterinario WHERE Granja_idGranja = 1";
                                                    $result = $conn->query($sql);
                                                    if($result ->num_rows > 0){
                                                        while($row = $result -> fetch_assoc()){
                                                            echo "<option value=''>".$row['Nombre']." </option>";                                                     
                                                        }
                                                    }
                                                ?>
                                                </select></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trGestionGranjas">
                                <td class="tdBtnsGestionGranjas"><input type="submit" value="Volver" class="btn_AccionesGestion" onclick="javascript:history.go(-1)">
                                                            <input type="submit" value="Ver granjas" class="btn_AccionesGestion" onclick="window.location.href='AVerGranjas.php'">
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
