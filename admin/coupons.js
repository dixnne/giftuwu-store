var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
};

$("#preview-btn").click(function(){
    $("#name").text($("#coupon-name").val());
    $("#code").text($("#coupon-code").val());
    $("#details").text($("#coupon-details").val());
    $("#discount").text($("#coupon-discount").val());
    if ($("#coupon-apply").is(':checked')) {
        $("#item").text($("#coupon-item").val());
    }else{
        $("#item").text("No se aplica a un artículo en específico.");
    }
});

