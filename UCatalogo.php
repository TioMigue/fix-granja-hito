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
                    <div class="Datos-Pag1">
                        <table class="Animales">
                            <tr class="trAnimales">
                            <?php
                            $sql = "SELECT * FROM animal";
                            $result = $conn->query($sql);
                            if($result ->num_rows > 0){
                                while($row = $result -> fetch_assoc()){
                                    //echo "<strong> Animal: ".$row['nombre']."</strong>";
                                    echo "<td class='tdAnimales'><input type='submit' name='animal' value='".$row['idImg']."' style='background: url(img/".$row['idImg'].".jpg); background-size: 100% 100%; background-repeat: no-repeat;  width: 200px; height: 100px;color: rgba(0,0,0,0)'></td>";
                                }
                            }  
                            ?>
                            </tr>
                            </table>
                            <?php
                                if(isset($_POST["animal"])){
                                $animal = $_POST["animal"];
                                $_SESSION["animal"] = $animal;
                                echo "<script type='text/javascript'> window.location = 'ComprarAnimal.php '</script>";

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