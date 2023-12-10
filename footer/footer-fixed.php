<footer class="fixed-bottom">
    <div class="pt-3 bg-color3"></div><section class="bg-color2">
        <div class="container">
            <form class="row py-4">
                <div class="col-12 col-md-6">
                    <h5>Suscríbete a Gift uwu Store</h5>
                    <p>Recibe las actualizaciones y ofertas antes que todos, y obtén un cupón exclusivo.</p>
                </div>
                <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                    <input id="subscribe" type="text" class="form-control w-75" placeholder="Email address">
                    <button class="btn btn-light mx-2" type="button">Subscribe</button>
                </div>
            </form>
        </div>
    </section></div>
    <section class="bg-dark pb-4">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <p class="col-md-5 mb-0 text-white"><?php   
                    // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
                    date_default_timezone_set('America/Mexico_City');
                
                    // Crear una matriz de meses en español
                    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                
                    // Obtener el día, mes y año actual
                    $dia = date('d');
                    $mes = $meses[date('n')-1];
                    $ano = date('Y');
                
                    // Imprime algo como: 06/Diciembre/2023
                    echo $dia . '/' . $mes . '/' . $ano;
                ?>  © Gift uwu Store, Inc. Todos los derechos reservados.</p>
                <a href="#" class="col-md-2 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-gift-fill color3 mx-3" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07M9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zm6 4v7.5a1.5 1.5 0 0 1-1.5 1.5H9V7zM2.5 16A1.5 1.5 0 0 1 1 14.5V7h6v9z"/>
                    </svg>
                    <p>PROYECTO ACADEMICO</p>
                </a>
                <ul class="nav col-md-5 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Tienda</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Nosotros</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Contáctanos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Ayuda</a></li>
                </ul>
            </div>
        </div>
    </section>
</footer>