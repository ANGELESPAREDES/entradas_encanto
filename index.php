<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/login.css"> 
    <title>Inicio</title>
</head>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #8ebe70;
}
.login-box {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background: #C8D2C2;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 8px;
}
.login-box h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
}
.user-box {
    position: relative;
    margin-bottom: 30px;
}
.user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
    border: none;
    border-bottom: 2px solid #333;
    outline: none;
    background: transparent;
}
.user-box label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #333;
    pointer-events: none;
    transition: 0.5s;
}
.user-box input:focus ~ label,
.user-box input:valid ~ label {
    top: -20px;
    left: 0;
    color: #333;
    font-size: 12px;
}
</style>
<body>
<div class="login-box">
  <h2>login</h2>
  <form action="./controlador/login.php" method="POST">
    <div class="user-box">
      <input type="text" class="form-control" name="txtusuario" id="txtusuario" required>
      <label>Usuario</label>
    </div>
    <div class="user-box">
      <input type="password" class="form-control" name="txtclave" id="txtclave" required>
      <label>Clave</label>
    </div>
    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
