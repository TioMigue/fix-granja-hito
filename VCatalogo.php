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
            <div class="contenedor-medio-vete">
                <div class="contenido">
                    <form action="" method="POST">
                        <div class="Menu-Medio">
                            <input type="submit" class="btn_MenuVete" name="btn_Home" value="Home">
                            <input type="submit" class="btn_MenuVete" name="btn_Catalogo" value="Catalogo">
                            <input type="submit" class="btn_MenuVete" name="btn_Animales" value="Animales">
                            <input type="submit" class="btn_MenuVete" name="btn_Checar" value="Chequear Animales">
                            <input type="submit" class="btn_Report" name="btn_Error" value="Error">  
                        </div>
                    </form>                  
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
                                    $sql = "SELECT * FROM animal";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['Nombre']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";     
                                                                                        
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
                                        $sql = "SELECT * FROM animal";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['Nombre']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";       
                                                                                     
                                        }
                                    }
                                    }else{
                                        $sql = "SELECT * FROM animal WHERE idTipo ='".$tipoS."'";
                                        $result = $conn->query($sql);
                                        if($result ->num_rows > 0){
                                        while($row = $result -> fetch_assoc()){
                                            echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['Nombre']."' style='background: url(img/".$row['Nombre'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";      
                                                                                 
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
                                echo "<script type='text/javascript'> window.location = 'UComprarAnimal.php '</script>";

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