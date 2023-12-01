<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <style>
    </style>
    <title>Metodo de pago</title>
</head>
<body>
    <form action="">
    <div class="contenedor-central contenedor-flex row">
        <div class="contenedor-padre ">
            <div class="contenedor-hijo contenedor-flex row">
                    <div class="contenedor-izquierdo col-lg">
                        <h2>Completa el formulario</h2>
                        <hr class="grow">
                        
                            <label for="nom"><i class="fa-solid fa-user"></i> Nombre completo</label><br><br>
                            <input type="text" id="nom" name="nombre" placeholder="Escribe tu nombre aqui" class="inputs" required><br><br>
                            <label for="correo"><i class="fa-solid fa-envelope"></i> Correo electronico</label><br><br>
                            <input type="email" id="correo" name="mail" placeholder="Escribe tu correo aqui" class="inputs" required><br><br>
                            <label for="domicilio"><i class="fa-solid fa-house-user"></i> Domicilio</label><br><br>
                            <input type="text" id="domicilio" name="domicilio" placeholder="Escribe tu domicilio aqui" class="inputs" required><br><br>
                            <label for="ciudad"><i class="fa-solid fa-city"></i> Ciudad</label><br><br>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Escribe tu ciudad aqui" class="inputs" required><br><br>
                            <label for=""><i class="fa-solid fa-globe"></i> Pais</label>
                            <select name="pais" id="pais" class="inputs">
                                <option value="" class="inputs">Argentina</option>
                                <option value="" class="inputs">Brasil</option>
                                <option value="" class="inputs">Chile</option>
                                <option value="" class="inputs">Estados Unidos</option>
                                <option value="" class="inputs">Mexico</option>
                            </select><br><br>
                            <label for="cp"><i class="fa-solid fa-inbox"></i> Codigo postal</label><br><br>
                            <input type="number" id="cp" name="cp" placeholder="Escribe tu codigo postal aqui" class="inputs" required><br><br>
                            <label for="num"><i class="fa-solid fa-phone"></i> Numero de telefono</label><br><br>
                            <input type="number" id="num" name="num_tel" placeholder="Escribe tu numero telefonico aqui" class="inputs" required><br><br>
                    </div>
                    <div class=" col-lg">
                        <div class="contenedor-derecho col-lg">
                            <h2>Como deseas pagar?</h2>
                            <div class="pay-card">
                                <input type="radio" id="visa" name="metodo_pago" value="">
                                <i class="fa-brands fa-cc-visa fa-xl"></i>
                                <label for="visa">VISA</label>
                            </div>
                            <br>
                            <div class="pay-card">
                                <input type="radio" id="mastercard" name="metodo_pago" value="">
                                <i class="fa-brands fa-cc-mastercard fa-xl"></i>
                                <label for="mastercard">MASTERCARD</label>
                            </div>
                            <br>
                            <div class="pay-card">
                                <input type="radio" id="oxxo" name="metodo_pago" value="">
                                <i class="fa-solid fa-shop fa-lg"></i>
                                <label for="oxxo">Pagar en un OXXO</label>
                            </div>
                            <br>
                            <div id="show" class="pay-card">

                            </div>
                        </div>
                    </div>
                <div class="d-grid gap-2 space" >
                        <button class="btn btn-primary" type="submit">CONFIRMAR Y CONTINUAR</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
<script src="https://kit.fontawesome.com/b61e18d0de.js" crossorigin="anonymous"></script>
<script>
const element = document.getElementById("visa");
element.addEventListener("click", function() {
  document.getElementById("show").innerHTML = "<h1>hola</h1> <p>aaa</p>";
});
</script>