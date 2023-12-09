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
        <section id="" class="gradient-background py-5">
            <div class="container fw-bold text-center">
                <p class="lead">
                    ¡Bienvenidos a Gift uwu Store, tu destino online para regalos llenos de alegría y sorpresas encantadoras! 
                    En nuestra tienda, nos especializamos en hacer de cada ocasión un momento especial y memorable. Aquí no encontrarás 
                    regalos aburridos, ¡solo pura diversión y emoción!
                </p>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                        <div class="shadow-img card work-desk rounded border-0 shadow-lg overflow-hidden">
                                            <img src="./images/couple.jpeg" class="img-fluid" alt="Image" />
                                            <div class="img-overlay bg-dark"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-4 pt-2 text-right">
                                            <a href="" class="btn btn-dark">Ir a Comprar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="shadow-img card work-desk rounded border-0 shadow-lg overflow-hidden">
                                            <img src="./images/dogs.jpeg" class="img-fluid" alt="Image" />
                                            <div class="img-overlay bg-dark"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                        <div class="shadow-img card work-desk rounded border-0 shadow-lg overflow-hidden">
                                            <img src="./images/friends.jpeg" class="img-fluid" alt="Image" />
                                            <div class="img-overlay bg-dark"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
                        <div class="section-title ml-lg-5">
                            <h5 class="text-custom font-weight-normal mb-3">Sobre Nosotros</h5>
                            <h4 class="title mb-4">
                                En Gift uwu Store <br />
                                no creemos en regalos comunes.
                            </h4>
                            <p class="text-muted mb-0">
                                Nos apasiona ofrecerte una selección única de productos que harán brillar los ojos de quienes amas. 
                                Ya sea que estés buscando un regalo para un cumpleaños, aniversario o simplemente para alegrar el día 
                                de alguien, ¡estás en el lugar correcto! Navega por nuestro sitio y descubre un mundo de regalos originales 
                                y adorables que te harán decir "uwu".
                            </p>
            
                            <div class="row">
                                <div class="col-lg-6 mt-4 pt-2">
                                    <div class="bg-color1 align-items-center rounded shadow p-3">
                                        Creatividad Divertida
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-4 pt-2">
                                    <div class="bg-color2 align-items-center rounded shadow p-3">
                                        Calidad con Amor
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-4 pt-2">
                                    <div class="bg-color3 align-items-center rounded shadow p-3">
                                        Atención Personalizada
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-4 pt-2">
                                    <div class="bg-color4 align-items-center rounded shadow p-3">
                                        Regalos Emocionantes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-color4 shadow py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 p-3">
                        <h4 class="h4 text-white border-bottom">
                            Misión
                        </h4>
                        <p class="text-white">
                            Nuestra misión es simple pero poderosa: queremos hacer que regalar sea tan divertido como recibir. 
                            Nos esforzamos por ser la opción número uno cuando se trata de encontrar regalos que transmitan amor, 
                            alegría y esa chispa especial. Creemos en la magia de los pequeños detalles y en la importancia de hacer 
                            que cada regalo cuente.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 p-3">
                        <h4 class="h4 text-white border-bottom">
                            Visión
                        </h4>
                        <p class="text-white">
                            En Gift uwu Store, visualizamos un mundo donde cada regalo es una experiencia única y llena de emoción. 
                            Queremos ser reconocidos como el lugar al que acudes cuando buscas algo más que un simple obsequio; deseamos 
                            ser parte de tus momentos especiales, compartiendo risas y felicidad a través de nuestros regalos creativos y 
                            encantadores.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 p-3">
                        <h4 class="h4 text-white border-bottom">
                            Objetivo
                        </h4>
                        <p class="text-white">
                            Nuestro principal objetivo es convertir cada ocasión en un evento memorable. Nos esforzamos por 
                            proporcionar una experiencia de compra en línea única y emocionante, donde nuestros clientes no solo adquieran 
                            regalos, sino que también encuentren inspiración y alegría en cada producto que ofrecemos. ¡Únete a nosotros y 
                            haz que cada ocasión sea inolvidable!
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color4">Diana Narváez</h4>
                        <img src="./images/diana.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color3">Flavio Salgado</h4>
                        <img src="./images/flavio.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color2">Monts Martínez</h4>
                        <img src="./images/tania.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color1">Alejandro Cedeño</h4>
                        <img src="./images/ale.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color4">Diana Dávila</h4>
                        <img src="./images/ddav.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                    <div class="col-12 col-sm-2 p-2 rotate">
                        <h4 class="text-center color3">Noe Román</h4>
                        <img src="./images/noe.jpeg" class="rounded-circle img-fluid" alt="">
                    </div>
                </div>

            </div>
        </section>
        <?php
        include("./footer/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="" async defer></script>
    </body>
</html>