<?php
    session_start();
    require("./database/db-setup.php");
    require("./database/db-handle.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gift uwu Store</title>
        <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/images.css">
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if (isset($_SESSION["username"])) {
                include("./header/header-login-index.php");
            }else{
                include("./header/header-index.html");
            }
        ?>
        <section class="gradient-background py-5">
            <div class="container">
                <h1 class="mb-3 text-center text-white font-paytone">Preguntas Frecuentes</h1>
                <p class="lead text-center text-white mb-4">Si tienes una duda que no está aquí, puedes enviarla en la sección de contacto.</p>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cómo realizo un pedido en Gift uwu Store?</p>
                            <p>Es fácil y divertido. Solo navega por nuestra tienda en línea, selecciona tus artículos favoritos y agrégales al carrito. Luego, sigue los simples pasos de pago y ¡listo!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Puedo personalizar mis regalos?</p>
                            <p>¡Por supuesto! Algunos de nuestros productos permiten personalización. Busca la opción de personalización en la página del producto y crea un regalo verdaderamente único.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cómo puedo rastrear mi pedido?</p>
                            <p>Una vez que tu pedido sea enviado, recibirás un correo electrónico con un enlace de seguimiento. Haz clic en el enlace para conocer la ubicación en tiempo real de tu paquete.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cuáles son las opciones de pago disponibles?</p>
                            <p>Aceptamos varias opciones de pago, incluyendo tarjetas de crédito, PayPal y otros métodos seguros. Puedes seleccionar tu opción preferida durante el proceso de pago.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Se pueden hacer devoluciones?</p>
                            <p>Sí, entendemos que a veces las cosas no salen como se planean. Consulta nuestra política de devoluciones para obtener información detallada sobre cómo proceder.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Ofrecen envíos internacionales?</p>
                            <p>¡Claro! Enviamos a muchos países alrededor del mundo. Al realizar el pedido, simplemente elige tu ubicación y te proporcionaremos las opciones de envío disponibles.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cuánto tiempo tardará en llegar mi pedido?</p>
                            <p>Los tiempos de envío varían según la ubicación. Puedes revisar los tiempos estimados de entrega en la página de cada producto y en la confirmación de tu pedido.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cómo puedo contactar al servicio al cliente?</p>
                            <p> Puedes comunicarte con nuestro amigable equipo de servicio al cliente a través de nuestro formulario de contacto en la sección "Ayuda" o enviándonos un correo electrónico a giftuwustore@gmail.com.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Hay descuentos o promociones disponibles?</p>
                            <p>Sí, ofrecemos promociones especiales y descuentos periódicos. Mantente atento a nuestras redes sociales y boletines para enterarte de las últimas ofertas.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 p-3 h-100">
                        <div class="rounded-3 bg-light h-100 p-3">
                            <p class="lead">¿Cómo sé si mi información personal está segura?</p>
                            <p>La seguridad de tu información es una prioridad. Gift uwu Store utiliza medidas de seguridad avanzadas para proteger tus datos. Consulta nuestra política de privacidad para obtener más detalles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include("./footer/footer-index.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="" async defer></script>
    </body>
</html>