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
    <div id="arribaUsuario"  class="contenedor">
        <!-- Seccion arriba -->
        <div class="arriba">
            <div class="login2">
            <form action="index.php" method="POST">
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
                        <form class="formAdmin" action="" method="POST">
                            <table class="tablaAdmin">
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Nombre: </label></td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtNombre" ></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Comida Para: </label>  </td>
                                    <td class="tdFormAdmin"><select name="tipo[]" id="">
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
                                    </select></td>
                                    
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin"> <label class="labelFormAdmin" for="">Precio: </label>  </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin" type="text" name="txtPrecio" ></td>
                                    <td class="tdFormAdmin"> <label class="labelForm" for="">Peso: </label> </td>
                                    <td class="tdFormAdmin"> <input class="inputFormAdmin"  type="text" name="txtPeso" ></td>
                                    
                                </tr>
                                <tr class="trFormularioAdmin">
                                    <td class="tdFormAdmin">  </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit" value="Volver"></td>
                                    <td class="tdFormAdmin">  </td>
                                    <td class="tdFormAdmin"> <input class="btnAccionesAdmin" type="submit" name="registrarAlimento" value="Registrar"></td>                              
                                </tr>
                            </table>
                        </form>  
                        <?php
                            if(isset($_POST['registrarAlimento'])){
                                $nombre = $_POST['txtNombre'];
                                $precio = $_POST['txtPrecio'];
                                $peso = $_POST['txtPeso'];
                                
                                $tipo = $_POST['tipo'];

                                for ($i=0; $i <count($tipo); $i++) { 
                                    $tipoS = $tipo[$i];
                                }

                                $sql = "INSERT INTO alimento (Nombre, idTipo, Precio, Peso) VALUES ('".$nombre."','".$tipoS."','".$precio."','".$peso."')";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<script type="text/javascript">alert("Alimento ingresado correctamente")</script>';
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