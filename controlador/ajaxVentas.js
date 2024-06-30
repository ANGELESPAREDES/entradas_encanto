// Variables globales
let ticketCounter = parseInt(localStorage.getItem('ticketCounter')) || 1;
let carrito = [];
const DOMitems = document.querySelector('#productos');
const DOMcarrito = document.querySelector('#lista');
const DOMbotonImprimir = document.querySelector('#btnImprimir');

const DOMtotal = document.querySelector('#total'); // Elemento donde se muestra el total
const DOMbtnCarrito = document.querySelector('#btnCarrito');
const DOMcontadorCarrito = document.querySelector('#contadorCarrito');


// Función para renderizar los productos desde el backend
function listarEntradas() {
    $.ajax({
        type: "POST",
        url: "./controlador/listarVentas.php",
        success: function(r) {
            $('#productos').html(r);
            // Añadir eventos a los botones de añadir al carrito
            document.querySelectorAll('.btn-success').forEach(button => {
                button.addEventListener('click', (event) => {
                    let productoId = event.target.getAttribute('data-id');
                    obtenerId(productoId);
                });
            });
        }
    });
}



// Función para obtener los detalles del producto
function obtenerId(codigo) {
    $.ajax({
        type: "POST",
        data: { codigo: codigo },
        url: "./controlador/obtenerEntrada.php",
        success: function(r) {
            let datos = jQuery.parseJSON(r);
            agregarAlCarrito(datos);
            console.log(datos); // Imprimir los datos en la consola
        }
    });
}

// Función para agregar un producto al carrito
function agregarAlCarrito(producto) {
    // Verificar si el producto ya está en el carrito
    const productoExistente = carrito.find(item => item.codigo === producto.codigo);

    if (productoExistente) {
        // Incrementar la cantidad si el producto ya existe
        productoExistente.cantidad += 1;
    } else {
        // Agregar nuevo producto con cantidad inicial 1
        producto.cantidad = 1;
        carrito.push(producto);
    }

    renderizarCarrito();
}

// Función para renderizar el carrito
function renderizarCarrito() {
    DOMcarrito.innerHTML = '';
    let total = 0; // Variable para calcular el total
    let cantidadTotal = 0; // Variable para la cantidad total de productos en el carrito

    carrito.forEach((item, index) => {
        // Contenedor principal del item del carrito
        const contenedorItem = document.createElement('div');
        contenedorItem.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2', 'border', 'p-2');
        
        // Contenedor para el nombre y precio
        const nombrePrecio = document.createElement('div');
        nombrePrecio.textContent = `${item.producto} - S/. ${item.precio}`;

        // Contenedor para los botones de cantidad
        const contenedorBotones = document.createElement('div');
        contenedorBotones.classList.add('d-flex', 'align-items-center');

        // Botón de disminuir cantidad
        const botonDisminuir = document.createElement('button');
        botonDisminuir.classList.add('btn', 'btn-secondary', 'mx-1');
        botonDisminuir.textContent = '-';
        botonDisminuir.setAttribute('data-index', index);
        botonDisminuir.addEventListener('click', disminuirCantidad);

        // Cantidad actual del producto
        const cantidadProducto = document.createElement('span');
        cantidadProducto.textContent = item.cantidad;
        cantidadProducto.classList.add('mx-2','align-items-center');

        // Botón de aumentar cantidad
        const botonAumentar = document.createElement('button');
        botonAumentar.classList.add('btn', 'btn-success', 'mx-1');
        botonAumentar.textContent = '+';
        botonAumentar.setAttribute('data-index', index);
        botonAumentar.addEventListener('click', aumentarCantidad);

        // Botón para eliminar producto
        const miBoton = document.createElement('button');
        miBoton.classList.add('btn', 'btn-danger');
        miBoton.textContent = 'X';
        miBoton.setAttribute('data-index', index);
        miBoton.addEventListener('click', borrarItemCarrito);

        // Calcular subtotal del producto (precio * cantidad)
        const subtotalProducto = item.precio * item.cantidad;
        total += subtotalProducto; // Sumar al total
        cantidadTotal += item.cantidad; // Sumar la cantidad total de productos

        // Agregar elementos al contenedor de botones
        contenedorBotones.appendChild(botonDisminuir);
        contenedorBotones.appendChild(cantidadProducto);
        contenedorBotones.appendChild(botonAumentar);
        contenedorBotones.appendChild(miBoton);

        // Agregar nombre y precio al contenedor principal
        contenedorItem.appendChild(nombrePrecio);
        contenedorItem.appendChild(contenedorBotones);

        // Agregar el item al DOM
        DOMcarrito.appendChild(contenedorItem);
    });

    // Mostrar el total en el input correspondiente
    DOMtotal.querySelector('#inputTotal').value = total.toFixed(2); // Ajustar a dos decimales si es necesario

    // Actualizar el contador del carrito
    DOMcontadorCarrito.textContent = cantidadTotal;
}

// Función para disminuir la cantidad de un producto en el carrito
function disminuirCantidad(event) {
    const index = event.target.getAttribute('data-index');
    if (carrito[index].cantidad > 1) {
        carrito[index].cantidad -= 1;
    } else {
        carrito.splice(index, 1);
    }
    renderizarCarrito();
}

// Función para aumentar la cantidad de un producto en el carrito
function aumentarCantidad(event) {
    const index = event.target.getAttribute('data-index');
    carrito[index].cantidad += 1;
    renderizarCarrito();
}

// Función para borrar un producto del carrito
function borrarItemCarrito(event) {
    const index = event.target.getAttribute('data-index');
    carrito.splice(index, 1);
    renderizarCarrito();
}

// Función para vaciar el carrito
function vaciarCarrito() {
    carrito = [];
    renderizarCarrito();
}

// Inicialización
listarEntradas();

function obtenerDatosCarrito() {
    let total = parseFloat(DOMtotal.querySelector('#inputTotal').value);
    let productos = carrito.map(item => ({
        producto: item.producto,
        cantidad: item.cantidad,
        precio: item.precio,
        subtotal: item.precio * item.cantidad,
        codigo: item.codigo 
    }));

    let fechaActual = new Date();
    let formattedDate = fechaActual.getFullYear() + '-' +
        String(fechaActual.getMonth() + 1).padStart(2, '0') + '-' +
        String(fechaActual.getDate()).padStart(2, '0') + ' ' +
        String(fechaActual.getHours()).padStart(2, '0') + ':' +
        String(fechaActual.getMinutes()).padStart(2, '0') + ':' +
        String(fechaActual.getSeconds()).padStart(2, '0');

    return {
        total: total,
        productos: productos,
        fecha: formattedDate
    };
}


DOMbotonImprimir.addEventListener('click', () => {
    const datosCarrito = obtenerDatosCarrito();
    if (carrito.length > 0) {
        enviarDatosCarrito(datosCarrito);
        imprimirBoleta(datosCarrito, ticketCounter);
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Boleta impresa correctamente.",
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "No se puede imprimir la boleta. Verifica que haya productos en el carrito y se haya seleccionado una venta válida.",
            showConfirmButton: false,
            timer: 1500
        });
    }
});



function enviarDatosCarrito(datosCarrito) {
    // Objeto con los datos a enviar
    let datos = {
        total: datosCarrito.total,
        productos: JSON.stringify(datosCarrito.productos),
        fecha: datosCarrito.fecha
    };

    // Enviar datos mediante AJAX
    $.ajax({
        type: 'POST',
        url: './controlador/recibir.php',
        data: datos, // Envía el objeto completo
        dataType: 'json', // Espera recibir JSON como respuesta
        success: function(response) {
            console.log('Respuesta del servidor:', response);

            // Verificar la respuesta del servidor
            if (response.status === 'success') {
                // Vaciar el carrito después de almacenar los datos
                vaciarCarrito();

                alert('Venta y detalles almacenados correctamente.');
            } else {
                alert('Error en la solicitud AJAX: ' + response.mensaje);
            }
        }
    });
}



function imprimirBoleta(datosCarrito,ticketNumber) {
    
    const esc = '\x1B';
    const negritaOn = esc + '\x45\x01'; // Negrita On
    const negritaOff = esc + '\x45\x00'; // Negrita Off
    const espaciadoLinea = esc + '\x32'; // Comando ESC 2 para seleccionar espaciado de línea de 1/6 pulgadas
    const estiloTitulo = esc + '\x21\x21'; // Comando ESC ! n para negrita y doble anchura
    const resetEstilo = esc + '\x21\x00'; // Reset estilo
    const fuentePequena = esc + '\x4D\x01'; // Comando para tamaño de fuente pequeña
    const fuenteNormal = esc + '\x4D\x00'; // Comando para tamaño de fuente normal

    let contenidoBoleta = `${espaciadoLinea}${fuenteNormal}RECREO, RESTAURANT Y ALOJAMIENTO\n`;
        contenidoBoleta +=`${espaciadoLinea}${fuenteNormal}     ENCANTO DE LAGUNA EIRL\n`;
        contenidoBoleta +=`${espaciadoLinea}${fuenteNormal}    CAR. IQUITOS NAUTA K 21.6\n`;
        contenidoBoleta +=`${espaciadoLinea}${fuenteNormal}         RUC: 20608740717\n`;
        contenidoBoleta +=`-------------------------------\n`;    
        contenidoBoleta +=`${espaciadoLinea}${fuenteNormal}       TICKET DE ENTRADA\n`;
        contenidoBoleta += `-------------------------------\n`;
        contenidoBoleta += `FECHA: ${datosCarrito.fecha}\n`;
        contenidoBoleta += `TICKET: TIC-${ticketNumber.toString().padStart(4, '0')} \n`;
        contenidoBoleta += `-------------------------------\n`;
        contenidoBoleta += `${negritaOn}PRODUCTO CANT. PRECIO  SUBTOTAL ${negritaOff}\n`;

    datosCarrito.productos.forEach(producto => {
        contenidoBoleta += `${fuentePequena} ${producto.producto.padEnd(12)} ${producto.cantidad.toString().padEnd(7)} ${parseFloat(producto.precio).toFixed(2).padEnd(9)} ${parseFloat(producto.subtotal).toFixed(2)}\n`;
    });

    contenidoBoleta += `${fuenteNormal}-------------------------------\n`;
    contenidoBoleta += ` ${negritaOn}       Total: S/. ${datosCarrito.total.toFixed(2)}${negritaOff} \n`;
    contenidoBoleta += `-------------------------------\n`;
    contenidoBoleta += `${espaciadoLinea}${fuenteNormal}APERSONARSE A CAJA CON EL TICKET\n`;
    contenidoBoleta += `${espaciadoLinea}${fuenteNormal} SI DESEA UNA FACTURA O BOLETA\n`;
    contenidoBoleta += `${espaciadoLinea}${fuenteNormal} PARA QUE LE HAGAN SU CAMBIO\n`;
    contenidoBoleta += `-------------------------------\n`;
    contenidoBoleta += `     Gracias por su visita:)`;

    BtPrint(contenidoBoleta);
    ticketCounter++; 
    localStorage.setItem('ticketCounter', ticketCounter);
}


function BtPrint(prn) {
    var S = "#Intent;scheme=rawbt;";
    var P = "package=ru.a402d.rawbtprinter;end;";
    var textEncoded = encodeURIComponent(prn);
    window.location.href = "intent:" + textEncoded + S + P;
}

document.getElementById('btnImprimir').addEventListener('click', () => {
    const datosCarrito = obtenerDatosCarrito();
    if (datosCarrito.productos.length > 0) {
        enviarDatosCarrito(datosCarrito);
        imprimirBoleta(datosCarrito);
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Boleta impresa correctamente.",
            showConfirmButton: false,
        });
    } else {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "No se puede imprimir la boleta. Verifica que haya productos en el carrito y se haya seleccionado una venta válida.",
            showConfirmButton: false,
            timer: 1500
        });
    }
});

    

   
    





