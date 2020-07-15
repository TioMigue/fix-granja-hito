
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
        <div class="login">
                <form action="UComprarAlimento.php" method="POST">
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
                                $idUser = $row["idUsuario"];
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
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
                <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
            </div>
            <div class="anunciosI">
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
                <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
            </div>
            <div class="contenedor-medio-usuario">
                <div class="contenido">
                <div class="Menu-Medio">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Home" value="Home"
                                onclick="window.location.href='index.php'">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Catalogo" value="Catalogo"
                                onclick="window.location.href='UCatalogo.php'">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Animales" value="Animales"
                                onclick="window.location.href='UAnimalesUsuario.php'">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Multimedia" value="Multimedia">
                            <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial"
                                onclick="window.location.href='UHistorialUsuario.php'">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                                onclick="window.location.href='UInformarError.php'">   
                        </div>                 
                    <div class="Datos-Pag2">
                        <form action="" method="POST">
                            <table class="tablaComprar">
                            <tr class="trComprar">
                                <td class="tdImgComprar"><img class="testImg" src="img/pedigree.jpg" alt=""></td>
                                        <td class="tdDatosComprar">
                                            <table class="tablaDatos">
                                                <tr class="trComprar">
                                                    <td class="tdTipoComprar">
                                                        <?php
                                                             $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                                             $result = $conn->query($sql);
                                                             if($result ->num_rows > 0){
                                                                 while($row = $result -> fetch_assoc()){

                                                                    $sql2 = "SELECT * FROM alimento WHERE idTipo ='".$row["idTipo"]."'";
                                                                     $result1 = $conn-> query($sql2);
                                                                     if($result1 -> num_rows > 0)
                                                                     {
                                                                         while($row = $result1 -> fetch_assoc())
                                                                         {
                                                                            echo '<input  type="hidden" name="idalimento" value="'.$row["idAlimento"].'"></input>';
                                                                            echo "<input type='hidden' name='money' value'".$row["Precio"]."' value=".$row["Precio"]."></input>";
                                                                            echo '<label name="nombreali">  '.$row['Nombre'].'  </label';

                                                                            $sql3 = "SELECT * FROM tipos WHERE idTipo ='".$row["idTipo"]."'";
                                                                            $result2 = $conn-> query($sql3);
                                                                            if($result2 -> num_rows > 0)
                                                                            {
                                                                                while($row = $result2 -> fetch_assoc())
                                                                                {
                                                                                    echo '<label> / '.$row['Tipo'].'  </label';
                                                                                }
                                                                            }
                                                                         }
                                                                     }
      
                                                                 }
                                                             }

                                                        
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr class="trComprar">
                                                    <td class="tdPrecioComprar">
                                                             <?php
                                                                $sql = "SELECT * FROM animal WHERE idAnimal ='".$_GET["animal"]."'";
                                                                $result = $conn->query($sql);
                                                                if($result ->num_rows > 0){
                                                                    while($row = $result -> fetch_assoc()){
                                                                        echo '<input  type="hidden" name="idanimal" value="'.$row["idAnimal"].'"></input>';
                                                                        $sql2 = "SELECT * FROM alimento WHERE idTipo ='".$row["idTipo"]."'";
                                                                        $result1 = $conn-> query($sql2);
                                                                        if($result1 -> num_rows > 0)
                                                                        {
                                                                            while($row = $result1 -> fetch_assoc())
                                                                            {
                                                                                echo '<label name="precio"> Precio:'.$row["Precio"].'</label';
                                                                               
                                                                            }
                                                                        }
        
                                                                    }
                                                                }
                                                             ?>
                                                    </td>
                                                </tr>
                                                <tr class="trComprar">
                                                    <td class="tdPagoComprar">
                                                        <strong>Metodo de pago</strong>
                                                        <select class="selectComprar" name="metodo" id="metodo">
                                                            <?php
                                                        $sql = "SELECT * FROM metodopago";
                                                        $result = $conn->query($sql);
                                                        if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo "<option value=".$row['idMetodoPago'].">".$row['Tipo']."</option>";                                                   
                                                            }
                                                            } 
                                                        ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table></td>

                                    </tr>
                                    <tr class="trComprar">
                                        <td class="tdDescripcionComprar"><strong></strong></td>
                                        <td class="tdBotonesComprar"><input class="btn_Comprar" type="submit" value="Volver"> 
                                        <input class="btn_Comprar" type="submit" value="Comprar" name="Comprar"></td>
                                    </tr>                                    
                            </table>    
                        </form>
                            <?php
                                if(isset($_POST["Comprar"])){
                                    $monto = $_POST["money"];
                                    $animal = $_POST["idanimal"];
                                    $idUser =$_SESSION["usuario"];
                                    $idmetodo = $_POST["metodo"];
                                    $idalim = $_POST["idalimento"];
                                    $prec = $_POST["Precio"];
                                    $idCompra;
                                    if($_SESSION["usuario"] == null){
                                        echo "<script>window.location = 'index.php'</script>";
                                    }else{
                                        
                                        $sql = "INSERT INTO compra (Monto, MetodoPago_idMetodoPago, Usuario_idUsuario, Alimento_idAlimento) VALUES ('".$monto."','".$idmetodo."','".$idUser."','".$idalim."')";
                                        if (mysqli_query($conn, $sql)) {
                                            
                                            }else{
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                            }
                                            
                                        $sql2 = "UPDATE animal SET estadoAlimento ='Excelente' WHERE idAnimal = '".$animal."'";
                                        if (mysqli_query($conn, $sql2)) {
                                            echo '<script type="text/javascript">alert("Alimento Comprado exitosamente")</script>';
                                            //mysqli_close($conn);
                                            }else{
                                            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                                        }
                                        $sql4 = "SELECT * FROM compra WHERE Usuario_idUsuario ='".$idUser."'";
                                        $result = $conn->query($sql4);
                                        if($result ->num_rows > 0)
                                        {
                                            while($row = $result -> fetch_assoc()){
                                                $idCompra = $row["idCompra"];
                                            }
                                        }    
                                        //Insertar compra en el historial del usuario
                                        $sql3 = "INSERT INTO historialusuario (usuario_idusuario, compra_idCompra) VALUES ('".$idUser."','".$idCompra."')";
                                        if (mysqli_query($conn, $sql3)) {
                                        mysqli_close($conn);
                                        }else{
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }        
                                        
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