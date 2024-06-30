
  <style>
    /* Estilo general para la barra de navegación */
    .navbar {
      background-color: #C8D2C2 !important; /* Cambia el color de fondo */
    }

    .navbar-brand {
      font-weight: bold; /* Negrita para el brand */
      color: #77947D !important; /* Color del brand */
    }

    /* Estilo para los ítems del menú */
    .nav-link {
      color: black !important; /* Color de los enlaces */
      font-weight: bold; /* Negrita para los enlaces */
      transition: color 0.3s ease; /* Transición de color */
    }

    .nav-link:hover {
      color: #77947D !important; /* Color al pasar el ratón */
    }
  </style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid d-flex justify-content-between">
    <a class="navbar-brand" href="administrador.php">ENCANTO DE LAGUNA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="administrador.php"><i class="fa fa-archive"></i> Administrador</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reportes.php"><i class="fa fa-area-chart"></i> Reportes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link close" href="./controlador/cerrarcession.php"><i class="fa fa-close"></i> SALIR</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<br>
