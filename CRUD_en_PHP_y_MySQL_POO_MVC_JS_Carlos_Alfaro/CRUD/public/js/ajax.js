console.log("incicializado ajax.js");
/* Enviar formularios via AJAX */
const formularios_ajax=document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => { //recorremos todos los formularios

    formularios.addEventListener("submit",function(e){ //ponemos a escuchar el evento submit de cada formulario
        
        e.preventDefault(); //evitamos el envio del formulario

        Swal.fire({
          // Configuracion de sweetalert
            title: '¿Estás seguro?',
            text: "Quieres realizar la acción solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed){

                // Datos para configurar el envio
                let data = new FormData(this);
                let method=this.getAttribute("method");
                let action=this.getAttribute("action");

                let encabezados= new Headers();

                let config={
                    method: method,
                    headers: encabezados,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action,config) //enviamos el formulario
                .then(respuesta => respuesta.json())
                .then(respuesta =>{ 
                    return alertas_ajax(respuesta); //llamamos a la función que gestiona las respuestas
                });
            }
        });

    });

});