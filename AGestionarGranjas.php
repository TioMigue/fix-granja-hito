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
                        <form action="">

                        </form>
                        <table class="tablaGestionGranjas">
                            <tr class="trGestionGranjas">
                                <form action="" method="POST">
                                <td class="tdGestionGranjas"><strong>Nombre</strong><input class="inputDatosGranjas" name="txtNombre" type="text"></td>
                                <td class="tdGestionGranjas"><strong>Direccion</strong><input class="inputDatosGranjas" name="txtDireccion" type="text"></td>
                                <td class="tdGestionGranjas"><strong>RUN</strong><input class="inputDatosGranjas" name="txtRUN" type="text"></td>
                                <td class="tdGestionGranjas"><strong>Descripcion</strong><input class="inputDatosGranjas" name="txtDescripcion" type="text"></td>
                                <td class="tdGestionGranjas"><input class="inputDatosGranjas" name="AgregarGranja" type="submit"></td>
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
                                            <form action="" method="POST">
                                                <td class="tdEmpleadosGranja"><strong>Granjero</strong><input type="submit" name="agregarGranjero"class="btnAgregar"></td>
                                                <td class="tdEmpleadosGranja"><strong>Veterinario</strong><input type="submit" name="agregarVeterinario" class="btnAgregar"></td>
                                            </form>
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
                                            </select></td>
                                            <td class="tdEmpleadosGranja"><strong>Veterinario: </strong>
                                                <select name="" id="">
                                                <option value="">Veterinario 1</option>
                                            </select></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trGestionGranjas">
                                <td class="tdBtnsGestionGranjas"><input type="submit" value="Volver" class="btn_AccionesGestion">
                                                            <input type="submit" value="Ver granjas" class="btn_AccionesGestion">
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
