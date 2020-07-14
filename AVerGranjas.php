<?php
    require 'conexion.php';
?>
<script>
    function verGranja(){
        window.location = "ADatosGranja.php";
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
                                <td class="tdGestionGranjas"><strong>Granjas</strong></td>
                                <td class="tdGestionGranjas"><strong>Filtrar Granja</strong>
                                <select name="granja[]" id="">
                                    <option value="todo">Selecionar granja</option>
                                    <?php
                                    $sql = "SELECT * FROM granja";
                                    $result = $conn->query($sql);
                                    if($result ->num_rows > 0){
                                    while($row = $result -> fetch_assoc()){
                                        echo "<option value=".$row['idGranja'].">".$row['Nombre']."</option>";                                                     
                                        }
                                    }
                                    ?>
                                </select>
                                </td>

                                <td class="tdGestionGranjas"><input class="inputDatosGranjas" name="verGranja" value="Filtrar"type="submit"></td>
                                </form>
                                <?php
                                   if(isset($_POST['verGranja'])){
                                        $granja = $_POST['granja'];
                                        for ($i=0; $i <count($granja); $i++) { 
                                            $granjaS = $granja[$i];
                                        }
                                   }
                                ?>
                            </tr>
                            <tr class="trTablaGestionGranjas">
                                <td class="tdTablaGestionGranjas">
                                    <table class="tablaEmpleadosGranja">
                                        <tr class="trEmpleadosGranja">
                                            <form action="" method="POST">
                                                <td class="tdEmpleadosGranja">
                                                <?php
                                                    if(!isset($_POST['verGranja'])){
                                                        $sql = "SELECT * FROM granja";
                                                        $result = $conn->query($sql);
                                                        if($result ->num_rows > 0){
                                                        while($row = $result -> fetch_assoc()){
                                                            echo "<label name='".$row['Nombre']."'> Nombre: ".$row['Nombre']." ---- </label>";
                                                            echo "<label name='".$row['Direccion']."'> Direccion: ".$row['Direccion']." ---- </label>";
                                                            echo "<label name='".$row['RUN']."'> RUN: ".$row['RUN']." ---- </label>";
                                                            echo "<label name='".$row['Descripcion']."'> Descripcion: ".$row['Descripcion']."</label>"; 
                                                            echo "<input type='submit' name='irGranja' value='Ver granja' style='margin-left: 150px;'>";                                                
                                                            }
                                                        }
                                                        
                                                    }if(isset($_POST['verGranja'])){
                                                        if($granjaS == 'todo'){
                                                            $sql = "SELECT * FROM granja";
                                                            $result = $conn->query($sql);
                                                            if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo "<strong>Nombre: ".$row['Nombre']." -- Direccion: ".$row['Direccion']." -- RUN: ".$row['RUN']." -- Descripcion: ".$row['Descripcion']."</strong> <br>";                                                     
                                                            }
                                                        }
                                                        }else{
                                                            $sql = "SELECT * FROM granja WHERE idGranja ='".$granjaS."'";
                                                            $result = $conn->query($sql);
                                                            if($result ->num_rows > 0){
                                                            while($row = $result -> fetch_assoc()){
                                                                echo "<strong>Nombre: ".$row['Nombre']." -- Direccion: ".$row['Direccion']." -- RUN: ".$row['RUN']." -- Descripcion: ".$row['Descripcion']."</strong>";                                                  
                                                            }
                                                        }
                                                        }
                                                        
                                                    }
                                                ?>
                                                <?php
                                                    if(isset($_POST['irGranja'])){
                                                        echo "<script>verGranja()</script>";
                                                    }
                                                ?>
                                                </td>
                                            </form>
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

