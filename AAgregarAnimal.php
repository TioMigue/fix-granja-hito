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
    <div id="arribaUsuario" class="contenedor">
        <!-- Seccion arriba -->
        <div class="arriba">
            <div class="login2">
                <form action="AAgregarAnimal.php" method="POST">
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
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
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
                                                        <option value='.$row['idGranja'].'>'.$row['Nombre'].'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Tipo: </label></td>
                                    <td class="tdFormAdmin">
                                        <select name="tipo[]" id="">
                                            <?php
                                                $sql = "SELECT * FROM tipos";
                                                $result = $conn->query($sql);
                                                if($result ->num_rows > 0){
                                                    while($row = $result -> fetch_assoc()){
                                                        echo '
                                                            <option value='.$row['idTipo'].'>'.$row['Tipo'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Nombre: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtNombre">
                                    </td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Edad: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtEdad">
                                    </td>
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Tamaño: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtTamano">
                                    </td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Color: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtColor">
                                    </td>
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Peso: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtPeso">
                                    </td>

                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Precio: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtPrecio">
                                    </td>
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit"
                                            value="Volver" onclick="javascript:history.go(-1)" ></td>
                                    <td class="tdFormAdmin"> </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit"
                                            name="registrarAnimal" value="Registrar"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if(isset($_POST['registrarAnimal'])){
                                $nombre = $_POST['txtNombre'];
                                $edad = $_POST['txtEdad'];
                                $tamano = $_POST['txtTamano'];
                                $color = $_POST['txtColor'];
                                $peso = $_POST['txtPeso'];
                                $precio = $_POST['txtPrecio'];
                                
                                $granja = $_POST['granja'];
                                $tipo = $_POST['tipo'];
                                for ($i=0; $i <count($tipo); $i++) { 
                                    $tipoS = $tipo[$i];
                                }
                                for ($i=0; $i <count($granja); $i++) {  
                                    $granjaS = $granja[$i];
                                }
                                $estado = 'noVendido';
                                $sql = "INSERT INTO animal (Nombre, Edad, Tamanio, Color, Peso, Precio, Estado, Granja_idGranja, idTipo) VALUES ('".$nombre."','".$edad."','".$tamano."','".$color."','".$peso."','".$precio."','".$estado."','".$granjaS."','".$tipoS."')";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<script type="text/javascript">alert("Animal ingresado correctamente")</script>';
                                    mysqli_close($conn);
                                    }else{
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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