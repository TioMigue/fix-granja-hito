<?php
    require 'conexion.php';
    session_start();
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
    <div id="arribaUsuario" class="contenedor">
        <!-- Seccion arriba -->
        <div class="arriba">
            <div class="login">
                <table>
                    <tr>

                        <td><input class="inputLogin" type="text" name="Usuario" placeholder="Usuario"></td>
                    </tr>

                    <tr>
                        <td><input class="inputLogin" type="text" name="Contraseña" placeholder="Contraseña"></td>
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
                <div class="contenidoAdmin">
                    <div class="Menu-Medio">
                        <input type="submit" class="btn_MenuAdmin" name="btn_Home" value="Home" onclick="window.location.href='index.php'">
                        <input type="submit" class="btn_MenuAdmin" name="btn_Catalogo" value="Catalogo" onclick="window.location.href='UCatalogo.php'">
                        <input type="submit" class="btn_MenuAdmin" name="btn_Animales" value="Animales" onclick="window.location.href='UAnimalesUsuario.php'">
                        <input type="submit" class="btn_MenuAdmin" name="btn_Multimedia" value="Multimedia" onclick="window.location.href=''">
                        <input type="submit" class="btn_MenuAdmin" name="btn_Historial" value="Historial" onclick="window.location.href=''">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error" onclick="window.location.href=''">
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
                                                        <option value='.$row['idGranja'].'>'.$row['Nombre'].'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Nombre: </label></td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtNombre" required>
                                    </td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Apellido: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text"
                                            name="txtApellido" required></td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Rut: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtRut" required>
                                    </td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Edad: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtEdad" required>
                                    </td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Telefono: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text"
                                            name="txtTelefono" required></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Direccion: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text"
                                            name="txtDireccion" required></td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Contraseña: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="password"
                                            name="txtContrasena" required></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Repetir Contraseña:
                                        </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="password"
                                            name="txtContrasena" required></td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit"
                                            value="Volver" onclick="window.location.href='AGestionarGranjas.php'"></td>
                                    <td class="tdFormAdmin"> </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit"
                                            name="registrarGranjero" value="Registrar"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if(isset($_POST['registrarGranjero'])){
                                $nombre = $_POST['txtNombre'];
                                $apellido = $_POST['txtApellido'];
                                $rut = $_POST['txtRut'];
                                $edad = $_POST['txtEdad'];
                                $direccion = $_POST['txtDireccion'];
                                $telefono = $_POST['txtTelefono'];
                                
                                $granja = $_POST['granja'];

                                for ($i=0; $i <count($granja); $i++) { 
                                    echo "<br> Granja" . $i . ": ". $granja[$i];
                                    $granjaS = $granja[$i];
                                }

                                $sql = "INSERT INTO granjero (Nombre, Apellido, Rut, Edad, Direccion, Telefono, Granja_idGranja) VALUES ('".$nombre."','".$apellido."','".$rut."','".$edad."','".$direccion."','".$telefono."','".$granjaS."')";
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