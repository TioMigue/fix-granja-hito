<?php
    require 'conexion.php';
    session_start();
?>
<script>
  function login(){
    window.location = "";
  }
  function error(){
    alert("Correo o contraseña incorrecta");
    window.location = "index.php";
  }

  function comprarAnimal(){
    window.location = "ComprarAnimal.php";
  }
  function refresh(){
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
                                    
                                    <td><input class="inputLogin"  type="text" name="Usuario" placeholder="Usuario"></td>
                                </tr>

                                <tr>
                                    <td><input class="inputLogin"  type="text" name="Contrasena" placeholder="Contraseña"></td>
                                    <td><input type="submit" value="login" name="btnLogin"></td>
                                </tr>
                                <tr>
                                    <td> Registrarse Aqui</td>                         
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
                        <input type="submit" id="1" class="btn_MenuUsuario" name="btn_Menu" value="Home" onclick="redireccionar();">
                        <input type="submit" id="2" class="btn_MenuUsuario" name="btn_Menu" value="Catalogo" onclick="redireccionar();">
                        <input type="submit" id="3" class="btn_MenuUsuario" name="btn_Menu" value="Animales" onclick="redireccionar();">
                        <input type="submit" id="4" class="btn_MenuUsuario" name="btn_Menu" value="Multimedia" onclick="redireccionar();">
                        <input type="submit" id="5" class="btn_MenuUsuario" name="btn_Menu" value="Historial" onclick="redireccionar();">
                        <input type="submit" id="6" class="btn_Report" name="btn_Menu" value="Error">        
                    </div>                
                    <div class="Datos-Pag">
                        
                    </div>
                </div>
            </div>           
        </div>
        <!-- Seccion abajo -->
    </div>
</body>
</html>
