function showAlert() {
    if ($("#myAlert").find("div#myAlert2").length === 0) {
        $("#myAlert").append("<div class='alert alert-success alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Pedido Cadastrado Com Sucesso!!!</div>");
    }
    $("#myAlert").css("display", "");
}
function verifica() {

    var x1 = document.getElementById("codigo").value !== "";
    var x2 = document.getElementById("descricao").value !== "";
    var x3 = document.getElementById("marca").value !== "";
    var x4 = document.getElementById("quantidade").value !== "";
    var result = x1 && x2 && x3 && x4;
    if (result) {
        showAlert();
    }
}
function clica(){
$('#button').click(function(){
    var textAdd = $('#').val();
    $('#inpudAdd').val('').focus();
    $('.boxLista').append('<div class="item">' + textAdd + '</div>');
});}
function verifica() {

    var x1 = document.getElementById("codigo").value !== "";
    var x2 = document.getElementById("descricao").value !== "";
    var x3 = document.getElementById("marca").value !== "";
    var x4 = document.getElementById("quantidade").value !== "";
    var result = x1 && x2 && x3 && x4;
    if (result) {
        showAlert();
    }
}

function  naoexiste(){
    alert("Este usuario não existe!!!");
}
