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
            <div class="login3">
                <form action="vCatalogo.php" method="POST">
                    <table>
                        <?php
                        if(isset($_SESSION["veterinario"])){
                            echo
                            '<tr>
                                <td><label>'.$_SESSION["veterinario"].'</label></td>
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
                        $idVeterinario;
                        $sql = "SELECT * FROM veterinario WHERE Nombre = '".$usuario."'";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result -> fetch_assoc()){
                                $contrasenaB = $row["clave"];
                                $usuarioB = $row["Nombre"];
                                $idVeterinario = $row["idVeterinario"];
                            }
                            mysqli_close($conn);
                        }        
                        if($usuario == $usuarioB && $contrasena == $contrasenaB){
                            $_SESSION["veterinario"] = $idVeterinario;
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

    </div>
    <!-- Seccion media -->
    <div class="medio-granja">
    <div class="anunciosD">
            <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio3.jpg" alt=""></div>
            <div class="anuncioD"><img class="imgAnuncios"src="img/anuncio4.jpg" alt=""></div>
        </div>
        <div class="anunciosI">
            <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio2.png" alt=""></div>
            <div class="anuncioI"><img class="imgAnuncios"src="img/anuncio1.png" alt=""></div>
        </div>
        <div class="contenedor-medio-vete">
            <div class="contenido">
                <div class="Menu-Medio-granja">
                    <input type="submit" class="btn_MenuVete" name="btn_Animales" value="Chequear Animales"
                        onclick="window.location.href='VCatalogo.php'" style=" width: 200px; ">
                    <input type="submit" class="btn_MenuVete" name="btn_Checar" value="Informar"
                        onclick="window.location.href='VInformarError.php'">
                    <input type="submit" class="btn_Report" name="btn_Error" value="Error"
                        onclick="window.location.href='VInformarError.php'">
                </div>
                <div class="Datos-Pag3">
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
                                    
                                    $idVeterinario = $_SESSION["veterinario"];
                                    $idGranja;
                                    $sql = "SELECT * FROM veterinario WHERE idVeterinario = '".$idVeterinario."'";
                                    $result = $conn->query($sql);

                                    if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            
                                            $idGranja = $row["Granja_idGranja"];
                                        }
                                    } 
                                    $sql = "SELECT * FROM animal WHERE (Granja_idGranja='$idGranja')and(Estado='Vendido')";
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

                                    $idVeterinario = $_SESSION["veterinario"];
                                    $idGranja;
                                    $sql = "SELECT * FROM veterinario WHERE idVeterinario = '".$idVeterinario."'";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            
                                            $idGranja = $row["Granja_idGranja"];
                                        }
                                    } 

                                    $tipo = $_POST['tipo'];
                                    for ($i=0; $i <count($tipo); $i++) { 
                                        $tipoS = $tipo[$i];
                                    }

                                    if($tipoS == 'todo'){
                                        $sql = "SELECT * FROM animal WHERE (idTipo='$tipoS')and(Granja_idGranja='$idGranja')and(Estado='Vendido')";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['idAnimal']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";       
                                                                                     
                                        }
                                    }
                                    }else{
                                        $sql = "SELECT * FROM animal WHERE (idTipo='$tipoS')and(Granja_idGranja='$idGranja')and(Estado='Vendido')";
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
                                    $_SESSION["animal"] = $animal;
                                    echo "<script> window.location = 'VIngresarChequeo.php?animal=".$animal."'</script>";
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