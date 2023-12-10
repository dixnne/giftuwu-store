var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
};

$("#preview-btn").click(function(){
    $("#name").text($("#item-name").val());
    $("#code").text($("#item-code").val());
    $("#details").text($("#item-details").val());
    $("#category").text($("#item-category").val());
    $("#price").text($("#item-price").val());
    $("#stock").text($("#item-stock").val());
    if ($("#item-discount").is(':checked')) {
        $("#discount").text($("#item-per").val());
    }else{
        $("#discount").text("No tiene.");
    }
});

