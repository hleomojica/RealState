function contar()
{
    var nump = document.getElementsByTagName("p")
    var numdiv = document.getElementsByTagName("div")
    var numa = document.getElementsByTagName("a")
    var numspan = document.getElementsByTagName("span")

    var totalP = nump.length;
    var totaldiv = numdiv.length;
    var totala = numa.length;
    var totalspan = numspan.length;

    alert("Etiquetas <p>" + totalP + "Etiquetas <div>" + totaldiv + "Etiquetas <a>" + totala +
            totalspan
            );

}
function parrafo() {

    var parrafo = document.createElement("p");
    var contenido = document.createTextNode("Texto de prueba");

    parrafo.appendChild(contenido);
    document.body.appendChild(parrafo);

//    return Resultado;
}

function total_A() {
    var nump = document.getElementsByTagName("p");
    var totalA = nump[0].getElementsByTagName('a').length;
    alert(totalA);
}

function limpiar() {
    document.getElementById("areadetexto").value = "";
}

function textaarea() {

    var parrafo = document.createElement("p");
    var texto = document.getElementById('areadetexto').value;
    var contenido = document.createTextNode(texto);
    parrafo.appendChild(contenido);
    document.getElementById("div11").appendChild(parrafo);
    document.getElementById("areadetexto").focus();
}

function insertbefore() {
    var parrafo = document.createElement("P");
    var texto = document.getElementById('areadetexto').value;
    var contenido = document.createTextNode(texto);
    parrafo.appendChild(contenido);
    document.getElementById("div11").appendChild(parrafo);
    var DIV = document.getElementById("div11");
    DIV.insertBefore(parrafo, DIV.childNodes[0]);
    document.getElementById("areadetexto").focus();

}


    