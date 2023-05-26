function valor()

{

    var n1 = document.getElementById("n1").value;

    var n2 = document.getElementById("n2").value;

    var n3 = document.getElementById("n3").value;

    var resultado = (parseFloat(n1) + parseFloat(n2) + parseFloat(n3));
    var dd = (document.getElementById("d1").value) / 100;
    var dd2 = (document.getElementById("d2").value) / 100;
    var impuesto = resultado * parseFloat(dd);
    var descuento = resultado * parseFloat(dd2);
    var resultotal = resultado + impuesto - descuento;

    alert("vr impuesto" + impuesto + "\n" +
            "vr descuento " + descuento + "\n" +
            "vr final" + resultotal
            );
}
;
function arrlego() {

    var arreglo = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
    for (var i = 0; i < arreglo.length; i++) {
       var resul = resul + document.write(arreglo[i] + " ");
        
    }
    return resul;
}
function arrlego1() {

    var cars = ["Saab", "Volvo", "BMW"];
    for (var i = 0; i <= cars.length; i++) {
        var resul = cars.toString();

    }
    return (resul);
}




