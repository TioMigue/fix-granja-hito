

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
                <form action="index.php" method="POST">
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
                                $idUser = $row["idUsuario"]
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
                            <table class="tablaComprar">
                            <tr class="trComprar">
                                <td class="tdImgComprar"><img class="testImg" src="img/pedigree.jpg" alt=""></td>
                                        <td class="tdDatosComprar">
                                            <table class="tablaDatos">
                                                <tr class="trComprar">
                                                    <td class="tdTipoComprar">
                                                        <strong>Tipo/</strong>
                                                        <strong>Nombre/</strong>
                                                        <strong>Peso</strong>
                                                    </td>
                                                </tr>
                                                <tr class="trComprar">
                                                    <td class="tdPrecioComprar">
                                                        <strong>Precio/</strong>
                                                        <strong>Añadido</strong>
                                                    </td>
                                                </tr>
                                                <tr class="trComprar">
                                                    <td class="tdPagoComprar">
                                                        <strong>Metodo de pago</strong>
                                                        <select class="selectComprar"name="" id="">
                                                            <option value="">Efectivo</option>
                                                            <option value="">WebPay</option>
                                                            <option value="">PayPal</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table></td>

                                    </tr>
                                    <tr class="trComprar">
                                        <td class="tdDescripcionComprar"><strong>Descripcion del animal</strong></td>
                                        <td class="tdBotonesComprar"><input class="btn_Comprar" type="submit" value="Volver"> <input class="btn_Comprar" type="submit" value="Comprar"></td>
                                    </tr>                                    
                            </table>    
                        </form>
                    </div>
                </div>
            </div>           
        </div>
        <!-- Seccion abajo -->
    </div>
</body>
</html>