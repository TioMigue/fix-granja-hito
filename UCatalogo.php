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
                        $sql = "SELECT * FROM usuario";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $contrasenaB = $row["Contrasena"];
                                $usuarioB = $row["Nombre"];
                            }
                            mysqli_close($conn);
                        }        
                        if($usuario == $usuarioB && $contrasena == $contrasenaB){
                            $_SESSION["usuario"] = $usuario;
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
                    <div class="Menu-Medio">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Home" value="Home"
                            onclick="window.location.href='index.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Catalogo" value="Catalogo"
                            onclick="window.location.href='UCatalogo.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Animales" value="Animales"
                            onclick="window.location.href='UAnimalesUsuario.php'">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Multimedia" value="Multimedia"
                            onclick="">
                        <input type="submit" class="btn_MenuUsuario" name="btn_Historial" value="Historial">
                        <input type="submit" class="btn_Report" name="btn_Error" value="Error">
                    </div>
                    <div class="Datos-Pag1">
                        <form action="" method="POST">
                            <table class="Animales">
                                <tr class="trAnimales">
                                    <td class="filtrarTipo"><strong>Tipo de animal</strong>
                                        <select name="tipo[]" id="">
                                            <option value="nada">Seleciona tipo</option>
                                            <?php
                                            $sql = "SELECT * FROM tipos";
                                            $result = $conn->query($sql);
                                            if($result ->num_rows > 0){
                                                while($row = $result -> fetch_assoc()){
                                                    //echo "<strong> Animal: ".$row['nombre']."</strong>";
                                                    echo "<option value=".$row['idTipo'].">".$row['Tipo']."</option>";
                                                }
                                            }
                                        ?>
                                        </select>
                                        <input type="submit" name="filtrarTipos" value="Filtrar">
                                    </td>
                                </tr>
                                <tr class="trAnimales">
                                    <?php
                                if(!isset($_POST['filtrarTipos'])){
                                    $sql = "SELECT * FROM animal WHERE Estado = 'noVendido'";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['idAnimal']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";                                                                                        
                                        }
                                    }

                                    /*
                                    if(!isset($_POST['filtrarTipos'])){
                                    $sql = "SELECT * FROM animal";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        //echo "<strong> Animal: ".$row['nombre']."</strong>";
                                        echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['Nombre']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";
                                    }
                                    } 
                                    */ 
                                }if(isset($_POST['filtrarTipos'])){

                                    $tipo = $_POST['tipo'];
                                    for ($i=0; $i <count($tipo); $i++) { 
                                        $tipoS = $tipo[$i];
                                    }

                                    if($tipoS == 'todo'){
                                        $sql = "SELECT * FROM animal WHERE Estado = 'noVendido'";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['idAnimal']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";       
                                                                                     
                                        }
                                    }
                                    }else{
                                        $sql = "SELECT * FROM animal WHERE idTipo ='".$tipoS."'";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['idAnimal']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";      
                                                                                 
                                        }
                                    }
                                    }
                                    
                                }

                                
                                ?>
                                </tr>
                            </table>
                        </form>
                        <?php
                                if(isset($_POST["animal"])){
                                    $animal = $_POST["animal"];
                                echo "<script type='text/javascript'> window.location = 'UComprarAnimal.php?animal=".$animal."'</script>";
                                }
                            ?>
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