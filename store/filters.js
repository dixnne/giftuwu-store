//buttons
$(document).ready(function() {
    $('button[name="filter"]').each(function (i,filtro){
        $(filtro).click(function(event) {
            event.preventDefault();
            console.log(event);
            $.ajax({
                url: 'filterAjaxs.php', // Archivo PHP que actualiza la variable
                type: 'POST',
                data: { filter: event.currentTarget.value }, // Datos a enviar al servidor
                success: function(response) {
                    console.log(response); 
                    convert=JSON.parse(response);
                    $('#conteinercards').empty(); //elimino a totos los hijos de la etiqueta conteinercards
                    convert.forEach(reload);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        })    
    });
});

//creacion de tarjetas segun la categoria seleccionada
function reload(item){
    
    if (item['stock'] == 0) {
        stock = "Producto agotado";
    } else {
        stock = "Disponibles: " + item['stock'];
    }
    endprice=item['price'] - (item['price'] * (item['discount']/100));

    if(item['discount'] > 0 ){
        price = '<span class="text-decoration-line-through">'+item['price']+'</span>';
    }
    //dentro de estas comillas todo es string
    html=`
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div id="id_${item['id']}" class="card bg-color img-container">
                <img src="${item['image']}" class="card-img-top img-effect" alt="..."">
                <div class="card-body">
                    <h5 class="card-title">${item['name']}</h5>
                    <p class="card-text">                            
                    ${item['details']} <br>                            
                    Precio: $${price} |  Descuento: ${item['discount']}% <br>
                    Precio final: $${endprice} <br>
                    ${stock}
                    </p>
                </div>
                <div class="card-footer bg-color2">
                    <div class="row row-cols-2">
                        <div>
                            <small class="text-body-secondary">codigo:'${item['code']}'</small>
                        </div>
                        <div>
                            <form action="./products.php" method="post"><button type="submit" name="submit" value="${item['id']}" class="btn btn-dark">Añadir al Carrito</button></form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    `;
    $('#conteinercards').append(html);
}
