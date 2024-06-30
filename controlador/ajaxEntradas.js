function listarEntradas() {
    $.ajax({
        type: "POST",
        url: "./controlador/listarEntradas.php",
        success: function(r) {
            $('#productos').html(r);
        }
    });
}

function listardetalle() {
    $.ajax({
        type: "POST",
        url: "./controlador/listardetalle.php",
        success: function(r) {
            $('#productosdetalle').html(r); 
        }
    });
}



function registrar(){
    let form = new FormData($('#frmregistrar')[0]);
    $.ajax({
        type: "POST",
        url: "./controlador/registar.php",
        data: form,
        cache: false,
        processData: false,
        contentType: false,
        success: function(r) {
            $('#frmregistrar')[0].reset();
            listarEntradas();
            Swal.fire({
                title: "Registrado",
                text: "El Producto ha sido registrado exitosamente.",
                icon: "success",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector('b');
                    setInterval(() => {
                        timer.textContent = Swal.getTimerLeft();
                    }, 100);
                }
            }).then(() => {
                location.reload(); // Recargar la página después de mostrar el mensaje
            });
        }
    });
    return false;
}



function actualizar(){
    let form = new FormData($('#frmactualizar')[0]);
    $.ajax({
        type: "POST",
        url: "./controlador/actualizar.php",
        data: form,
        cache: false,
        processData: false,
        contentType: false,
        success: function(r) {
            if (r == 1) {
                $('#frmactualizar')[0].reset();
                listarEntradas();
                Swal.fire({
                    title: "Registro Actualizado",
                    icon: "success",
                    timer: 1500
                }).then(() => {
                    location.reload(); // Recargar la página después de actualizar
                });
            } else {
                Swal.fire({
                    title: "Error al actualizar",
                    icon: "error",
                    timer: 1000
                });
            }
        }
    });
}


function obtenerId(codigo){
    $.ajax({
        type:"POST",
        data:"codigo="+codigo,
        url:"./controlador/obtenerEntrada.php",
        success:function(r){
            let datos=jQuery.parseJSON(r);
            $('#codigoa').val(datos['codigo']);
            $('#productoa').val(datos['producto']);
            $('#precioa').val(datos['precio']);
        }
    });
    

}


function eliminar(codigo) {
    Swal.fire({
        title: "Eliminar Producto",
        text: "¿Estás seguro de eliminar este Producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: { codigo: codigo },
                url: "./controlador/eliminar.php",
                success: function(r) {
                    listarEntradas();
                    Swal.fire({
                        title: "Mensaje",
                        text: "El registro ha sido eliminado",
                        icon: "success"
                    }).then(() => {
                        location.reload(); // Recargar la página después de eliminar
                    });
                }
            });
        }
    });
}


