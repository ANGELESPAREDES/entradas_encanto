<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/venta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/">
    <title>Entradas</title>
</head>
<style>
    .navbar {
      background-color: #C8D2C2 !important; /* Cambia el color de fondo */
    }
</style>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="administrador.php">ENCANTO DE LAGUNA</a>
    <form action="./controlador/cerrarcession.php" method="post" class="d-flex">
      <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
  </div>
</nav>
<br>
<br>
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
                            <div class="col-sm-12" >
                            <button class="btn btn-outline-success position-relative" type="button" data-bs-toggle="modal" data-bs-target="#modalcarrito">
                CARRITO <i class="fas fa-shopping-cart"></i>   
                <span id="contadorCarrito" class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </button> 
                            </div>
                            <br>
                            <br>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row" id="productos">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>  

    <!-- modal carrito -->

    <div class="modal fade" id="modalcarrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-7" id="exampleModalLabel">CARRITO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="lista" class="list-group"></ul>
                <br>
                <div id="total">
                    <label for="inputTotal" class="form-label">TOTAL:</label>
                    <input type="text" class="form-control" id="inputTotal" disabled>
                </div>
                <input type="hidden" id="idDetalle" name="idDetalle">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnImprimir"><i class="fas fa-print"></i> Imprimir boleta</a>
                </button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="./controlador/ajaxVentas.js"></script>
<script type="text/javascript">
  listarEntradas();
</script>
</body>
</html>
