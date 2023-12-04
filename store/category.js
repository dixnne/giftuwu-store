//Comestibles
$(document).ready(function() {
    $('#actualizar').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '1' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//Vestimenta
$(document).ready(function() {
    $('#vestimenta').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '2' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//Objetos
$(document).ready(function() {
    $('#objetos').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '3' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//Videojuegos
$(document).ready(function() {
    $('#videojuegos').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '4' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//Envolturas
$(document).ready(function() {
    $('#envolturas').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '5' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//tarjetasderegalo
$(document).ready(function() {
    $('#tarjetasderegalo').click(function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'back.php', // Archivo PHP que actualiza la variable
        type: 'POST',
        data: { nueva_variable: '6' }, // Datos a enviar al servidor
        success: function(response) {
            console.log(response); 
            convert=JSON.parse(response);
            $('#bodyproducts').empty(); //elimino a totos los hijos de la etiqueta
            convert.forEach(reload);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});
});

//creacion de tarjetas segun la categoria seleccionada
function reload(item){

    pricefinal=item['price'] - (item['price'] * (item['discount']/100));

    //dentro de estas comillas todo es string
    html=`
    '<div class="col">'

    <div id="id_'${item['id']}'" class="card bg-color">
        <img src='${item['image']}' class="card-img-top" alt="..."">
        <div class="card-body">
            <h5 class="card-title">'${item['name']}'</h5>
            <p class="card-text">
            '${item['details']}' <br>                            
            Precio: '${item['price']}' |  Descuento: '${item['discount']}' <br>
            Precio final: '${pricefinal}' <br>
            Existencias: '${item['stock']}'</p>
        </div>
        <div class="card-footer bg-color2">
            <div class="row row-cols-2">
                <div>
                    <small class="text-body-secondary">codigo:'${item['code']}'</small>
                </div>
                <div>
                    <a href="#"><button type="button" class="btn btn-outline-light btnb">Add</button></a>
                </div>
            </div>    
        </div>
    </div>
    '</div"> <br>' 

    `;

    $('#bodyproducts').append(html);
}
