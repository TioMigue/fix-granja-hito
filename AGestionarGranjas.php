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
    <div class="contenedor">
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
                            <input type="submit" class="btn_MenuAdmin" name="btn_Home" value="Home">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Catalogo" value="Catalogo">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Animales" value="Animales">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Multimedia" value="Multimedia">
                            <input type="submit" class="btn_MenuAdmin" name="btn_Historial" value="Historial">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error">
                        </div>
                    </form>
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
                                    <td class="tdGestionGranjasDesc"><strong>Descripcion</strong>
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
                                <td class="tdBtnsGestionGranjas"><input type="submit" value="Volver" class="btn_AccionesGestion">
                                                            <input type="submit" value="Ver granjas" class="btn_AccionesGestion" onclick="window.location.href='AVerGranjas.php'">
                                                            <input type="submit" value="Ingresar" class="btn_AccionesGestion">
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
