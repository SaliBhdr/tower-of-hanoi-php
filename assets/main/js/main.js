function up(){
    var x = document.getElementById("quantity").value;
    if(parseInt(x) >= 1){
        document.getElementById("quantity").value = parseInt(x) +1;
    }
}
function down(){
    var x = document.getElementById("quantity").value;
    if(parseInt(x) > 1){
        document.getElementById("quantity").value = parseInt(x) -1;
    }
}