<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <title>Entradas</title>
</head>
<body>
<?php
    require_once ('navbar.php');
?>
<main class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">Productos:</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#modalregistrar">Añadir</button>
                                <button type="button" class="btn btn-outline-danger " id="contador">Resetear Ticket</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row" id="productos" style="margin-left: 5px;">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>  

<!-- modal registrar -->
<div class="modal fade" id="modalregistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="frmregistrar" method="POST" enctype="multipart/form-data" onsubmit="return registrar()">    
                     <div class="col-12">
                            <div class="input-group mb-3">
                            <input type="file" class="form-control" id="imagen" name="imagen">
                            </div>
                        </div>            
                       <div class="col-12">
                       <div class="form-floating ">
                        <input type="text" class="form-control" id="producto" name="producto" >
                        <label for="floatingInput">Productos</label>
                        </div>
                       </div>
                        <br>
                        <div class="col-12">
                        <div class="form-floating ">
                        <input type="text" class="form-control" id="precio" name="precio" required>
                        <label for="floatingInput">Precio:</label>
                        </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ('modalactualizar.php');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="./controlador/ajaxEntradas.js"></script>
<script src="./controlador/ajaxVenta.js"></script>
<script type="text/javascript">
  listarEntradas();
  const DOMresetTicket = document.querySelector('#contador');

  DOMresetTicket.addEventListener('click', resetTicketCounter);
  function resetTicketCounter() {
    ticketCounter = 1; // Establece el contador a 1 en lugar de 0
    localStorage.setItem('ticketCounter', ticketCounter);
    Swal.fire({
        position: "center",
        icon: "success",
        title: `Contador de tickets restablecido a 1.`,
        showConfirmButton: false,
        timer: 1500
    });
}
</script>

</body>
</html>
