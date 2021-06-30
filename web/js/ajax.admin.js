

carrusel_promptEditarFoto = function(msg,title,id)
{
    var now = $.now();
   
    var prompt = $('<div id="dialog-confirm'+now+'" title="'+title+'">\
    <p>'+msg+'</p>\
    <div><textarea name="input_descripcion_foto" rows="2" cols="15">'+$(".label_url_foto_"+id).text()+'</textarea></div>\
    </div>');

    $(function() {
        $( prompt ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                Guardar: function() {
                    
                    var txt = prompt.children("div").children("textarea").val();
                    carrusel_editarFoto(id,txt);
                    $(".label_descripcion_foto_"+id).html(txt)
                     $( this ).dialog( "close" );
                },
                Cancelar: function() {
                   
                     $( this ).dialog( "close" );
                } 
            }
        });
    });
}

function carrusel_setOrdenFoto(album,orden)
{
    var var_query = {
          "function": "carrusel_setOrdenFoto",
          "vars_ajax":[album,orden]
        };
    
    pasarelaAjax('GET', var_query, "carrusel_setOrdenHTML", '');
}


function carrusel_setOrdenHTML(response)
{
    var respuesta = null;
    if (response != "null")
    {
        respuesta = JSON.parse(response);
       
    }

    return true;
}





function carrusel_ShowFotos(album)
{
     var var_query = {
          function: "carrusel_ShowFotos",vars_ajax:[album]
        };
    
    pasarelaAjax('GET', var_query, "carrusel_ShowFotosHTML", '');
    
}

function carrusel_ShowFotosHTML(response)
{
    var respuesta = null;
    
    if(response != "null")
    {
       
        respuesta = JSON.parse(response);
        $("#cont_fotos").html(respuesta["html"]);
        $(".no_hay_datos").hide();
        
    }

} 






function carrusel_editarFoto(id,txt)
{
    var var_query = {
          "function": "carrusel_editarFoto",
          "vars_ajax":[id,txt]
        };
    var var_function = [id];
    
    pasarelaAjax('POST', var_query, "carrusel_editarFotoHTML",var_function);
    
    
}

function carrusel_editarFotoHTML(response,id)
{
    var respuesta = null;
    
    if(response != "null")
    {
        respuesta = JSON.parse(response);
        
        if(respuesta[0]["message"] == "success")
        {
 
        }
        else
        {
             _alert(respuesta[0]["message"],"Error")
        }
        
    }
} 




function carrusel_eliminarFoto(id)
{
    EliminarRegistro("carrusel_eliminarFoto",id,0,'¿Realmente quiere eliminar esta foto?',"carrusel_eliminarFotoHTML"); 

    
}

function carrusel_eliminarFotoHTML(response,id)
{
    var respuesta = null;
    
    if(response != "null")
    {
        respuesta = JSON.parse(response);
        
        if(respuesta[0]["message"] == "success")
        {
         
            $(".foto_"+id).fadeOut(500,function(){
                $(".foto_"+id).remove();
            });
        }
        else
        {
             _alert(respuesta[0]["message"],"Error")
        }
        
    }
} 

