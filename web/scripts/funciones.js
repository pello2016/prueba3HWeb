/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Metodo para agregar "ingredientes" a las recetas, de forma dinamica
function addIngredientes() {
    // numero de ingredientes que se agregaran
    var number = document.getElementById("cantIngredientes").value;
    // Container <div> donde se agregaran los ingredientes de forma dinamica
    var container = document.getElementById("container-recetas");

    //clonar elemento
    var lista = document.getElementById("lista");

    var listaClone = lista.cloneNode(true);

    //Codigo elimina todos los elementos dentro del contenedor de ingredientes
    // Clear previous contents of the container
    //while (container.hasChildNodes()) {
    //    container.removeChild(container.lastChild);
    //}
    for (i = 0; i < number; i++) {
        var data = "";
        
        
        
        //se crea un div que contenga a un ingrediente
        data ="<div class='form-group' id='ing"+i+"'>";
        container.innerHTML += data;
        
        var container2 = document.getElementById("ing"+i);
        
        

        //agrega un separador superior solo en la primera iteracion.
        if (i == 0) {
            data = "<hr size='30'>";
            container2.innerHTML += data;
        }
        //se le cambie el "id" a la lista clonada
        listaClone.id = "lista"+i;
        
        
        //copia la lista para elegir ingredientes
        container2.appendChild(listaClone);
        
        
        
        
        //genera el elemento para ingresar la cantidad
        data = "<div class='form-group'>";
        data += "<div class='row'>";       
        data += "<label class='control-label col-md-2'>Cantidad " + (i + 1) + "</label>";
        data += "<div class='col-xs-7'><input type='text' name='cantidad[]' id='cantidad'></div>";
        data += "</div>";
        data += "</div>";
        container2.innerHTML += data;
         
        //genera el elemento para ingresar la unidad de medida
        data = "<div class='form-group'>";
        data += "<div class='row'>";
        data += "<label class='control-label col-md-2'>Unidad " + (i + 1) + "</label>";   
        data += "<div class='col-xs-7'><input type='text' name='unidad[]' id='unidad'></div>";      
        data += "</div>";
        data += "</div>";
        container2.innerHTML += data;
        
        
        
        var idd = 'ing'+i;
        //boton eliminar ingrediente
        data = "<div class='form-group'>";
        data += "<div class='row'>";
        data += "<div class='col-md-10'>";
        data += "<input type='button' value='Quitar' class='btn btn-default' onclick='eliminaIngrediente("+idd+") ;'>"; 
        data += "</div>";
        data += "</div>";
        data += "</div>";
        container2.innerHTML += data;
        
        
        
        
        //agrega un espacio y un separador 
        data = "<hr size='30'>";
        container2.innerHTML += data;
       
       //cierra el contenedor de un ingrediente
        data ="</div>";
        container.innerHTML += data;
        
    }
    
    
}

function eliminaIngrediente(idIng) {
    $(idIng).remove();
    }
