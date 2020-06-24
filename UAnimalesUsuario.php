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
                <input class="textLogin" type="text" name="usuario.txt" placeholder="Usuario" >
                <input class="textLogin" type="text" name="usuario.txt" placeholder="Usuario" >
                <img class="imglogin" src="img/login.png" alt="" width="50px" height="50px">
                <a class="alogin" href="URegistroUsuario.php"> Registrarse</a>
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
                    <div class="Datos-Pag">
                        <div class="AnimalBuscarU">
                            <input class="FormuAnimalesUsuario" type="text" name="" id="">
                            <input class="FormuAnimalesUsuario" type="submit" name="" value="Buscar">
                            <input type="submit" value="Multimedia">
                        </div>
                        
                        <div class="AnimalesUser">

                        </div>
                    </div>
                </div>
            </div>           
        </div>
        <!-- Seccion abajo -->
    </div>
</body>
</html>