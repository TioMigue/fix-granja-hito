

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