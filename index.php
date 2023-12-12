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
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/carousel.css">
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if (isset($_SESSION["username"])) {
                include("./header/header-login-index.php");
            }else{
                include("./header/header-index.html");
            }
        ?>
        <section id="carousel">
        <div id="myCarousel" class="carousel slide mb-6 gradient-background-purple" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item">
                <img src="./images/carousel1.jpg" alt="" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Feliz Navidad!</h1>
                    <p class="opacity-75">Encuentra los mejores regalos para dar en esta época a tus seres queridos.</p>
                    <p><a class="btn btn-lg btn-light" href="#">Comenzar a comprar</a></p>
                </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/carousel2.jpg" alt="" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Dulces deseos!</h1>
                    <p class="opacity-75">Regala algo genial para esos amigos amantes de lo dulce o lo salado!</p>
                    <p><a class="btn btn-lg btn-light" href="#">Ver Comestibles</a></p>
                </div>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="./images/carousel3.jpg" alt="" width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Lindos Detalles!</h1>
                    <p class="opacity-75">Encuentra un detalle perfecto para una persona especial.</p>
                    <p><a class="btn btn-lg btn-light" href="#">Ver Objetos</a></p>
                </div>
                </div>
            </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
        </section>
        <section id="hero" class="gradient-background-purple">
            <div class="px-4 pt-5 text-center border-bottom">
                <h1 class="display-4 fw-normal text-body-emphasis">Gift uwu Store</h1>
                <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Los regalos más uwu a los precios menos unu!</p>
                <?php
                    if (!isset($_SESSION["username"])) {
                        echo '<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <a href="./session/login.php"><button type="button" class="btn btn-dark btn-lg px-4 me-sm-3">Iniciar sesión</button></a>
                        <a href="./session/signup.php"><button type="button" class="btn btn-outline-dark btn-lg px-4">Crear cuenta</button></a>
                        </div>';
                    }
                ?>
                </div>
                <div class="overflow-hidden" style="max-height: 30vh;">
                    <div class="container px-5">
                        <img src="./images/giftuwustore.jpeg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <section class="gradient-background">
            <div class="py-2 bg-color3 text-white text-center font-paytone shadow h4">Productos Destacados</div>
            <div class="container">
                <div class="row py-4 text-center">
                <?php
                        for ($i=1; $i <= 3; $i++) { 
                            $featured = getFeatured($i);
                            $item = getItem($featured["item"]);
                            echo '<div class="col-lg-4">
                                <img class="rounded-circle border-white border-3 shadow" width="140" height="140" src="'.substr($item["image"],1).'" alt="">
                                <h3 class="">'.$item["name"].'</h3>
                                <p>'.$item["details"].'</p>
                                <p><a class="btn btn-light" href="#">Ver más »</a></p>
                            </div>';
                        }
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h3 class="featurette-heading fw-normal lh-1">Haz el regalo tuyo. <span class="color4">Regala experiencias.</span></h3>
                        <p class="lead">Personaliza el regalo con una envolutura y hazlo aún más especial!</p>
                        <a href="#" role="button" class="btn btn-dark btn-lg m-3">Ver Envoluturas »</a>
                    </div>
                    <div class="col-md-5">
                        <img src="./images/envelop-index.jpg" alt="" class="featurette-image img-fluid mx-auto" preserveAspectRatio="xMidYMid slice" focusable="false">
                    </div>
                </div>
            </div>
        </section>
        <section >
        <div class="py-2 bg-color3 text-white text-center font-paytone shadow h4">Ofertas del dia </div>

        <section style="justify-content: space-between; display: flex; padding: 20px;">
        <div class="container justify-content: center;" >
            <div class="container">
            <div class="card" style="width: 18rem;" >
                <div class="card-body">
                    <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descuento del 15%</font></font></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Unico dia</font></font></h6>

        <img src="./images/Cupon_pagina.png" class="card-img-top" alt="...">

        <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Hoy es el día perfecto para consentirte o sorprender a alguien especial. Reclama este cupon y utilizalo al finalizar tu compra.</font></font></p>
        <h5 href="#" role="button" class="btn btn-dark btn-lg m-3"> DESCUENTOS15 </h5>
            </div>
        </div>
        </div>
        <br>
    </div>
<!-- -------------------------------- -->
            <div class="container">
            <div class="card" style="width: 18rem;" >
                <div class="card-body">
                    <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descuento Navideño</font></font></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Valido para tu proxima compra</font></font></h6>

        <img src="./images/Cupon_pagina_n.png" class="card-img-top" alt="...">

        <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Llego la navidad, disfruta de 40% para tu regalo de navidad. Reclama este cupon y utilizalo al finalizar tu compra.
        <a href="#" role="button" class="btn btn-dark btn-lg m-3">NavidadUwu25</a>
            </div>
        </div>
        </div>

        <div class="container">
            <div class="card" style="width: 18rem;" >
                <div class="card-body">
                    <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descuento para nuestro nuevos usuarios</font></font></h5>


        <img src="./images/Cupon_nuevos.png" class="card-img-top" alt="...">

        <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¿No sabes si registrarte? Aprovecha esta oportunidad.  Te damos un descuento del 35% para tu primer compra </font></font></p>
        <a href="#" role="text" class="btn btn-dark btn-lg m-3">NewUser2023</a>
            </div>
        </div>
        </div>
</section>
 <section>

 </section>

        </section>
        <?php
        include("./footer/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="" async defer></script>
    </body>
</html>