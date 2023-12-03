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

 function reload(item, i, items){

    pricefinal=item['price'] - (item['price'] * (item['discount']/100));
    //dentro de estas comilla todo es string
    html=`
        ${i== 0 || i % 4 == 0? '<div class="card-group col contenedor-flex">' : '' /* condicion ternaria  */} 

    <div class="card space bg-color">
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
            <small class="text-body-secondary">codigo:'${item['code']}'</small>
        </div>
    </div>
        ${i % 4 == 3 || items.length== i+1 ? '</div"> <br>' : '' /* condicion ternaria  */} 

    `;
    $('#bodyproducts').append(html);
   
                
            
        
    
}
