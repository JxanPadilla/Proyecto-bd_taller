<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/headerr.css'); ?>">
  <script src="<?php echo base_url(); ?>/css/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta charset="utf-8" />
  
</head>

<header>
  <img src="<?php echo base_url('/img/logo.png'); ?>">
  <div class="titulos">

    <h1 style="text-align: center;"><?php echo $titulo; ?></h1>
    <h4 style="text-align: center;"><?php echo $nombre; ?></h4>

  </div>

  <a href="https://oferta.senasofiaplus.edu.co/sofia-oferta/"><img src="<?php echo base_url('/img/senablanco.png'); ?>"></a>

</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ubicacion
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url('/paises'); ?>">Pais</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('/departamentos'); ?>">Departamentos</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('/municipios'); ?>">Municipios</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('/cargos'); ?>" tabindex="-1">Cargos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Empleados
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url('/empleados'); ?>">Administrar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>
  <nav class="menu"></nav>
</body>