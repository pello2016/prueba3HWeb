/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Metodo para agregar "ingredientes" a las recetas, de forma dinamica
function addIngredientes() {
    // Number of inputs to create
    var number = document.getElementById("cantIngredientes").value;
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("container-recetas");

    //clonar elemento
    var lista = document.getElementById("lista");

    var listaClone = lista.cloneNode(true);


    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    for (i = 0; i < number; i++) {
        var data = "";

        //agrega un separador superior solo en la primera iteracion.
        if (i == 0) {
            data = "<hr size='30'>";
            container.innerHTML += data;
        }

        //copia la lista para elegir ingredientes
        container.appendChild(listaClone);

        //genera el elemento para ingresar la cantidad
        data = "<div class='form-group'>";
        data += "<div class='row'>";       
        data += "<label class='control-label col-md-2'>Cantidad " + (i + 1) + "</label>";
        data += "<div class='col-xs-7'><input type='text' name='cantidad[]' id='cantidad'></div>";
        data += "</div>";
        data += "</div>";
        container.innerHTML += data;
         
        //genera el elemento para ingresar la unidad de medida
        data = "<div class='form-group'>";
        data += "<div class='row'>";
        data += "<label class='control-label col-md-2'>Unidad " + (i + 1) + "</label>";   
        data += "<div class='col-xs-7'><input type='text' name='unidad[]' id='unidad'></div>";      
        data += "</div>"
        data += "</div>"
        container.innerHTML += data;

        //agrega un espacio y un separador
        //container.appendChild(document.createElement("br"));
        data = "<hr size='30'>";
        container.innerHTML += data;
    }
}

