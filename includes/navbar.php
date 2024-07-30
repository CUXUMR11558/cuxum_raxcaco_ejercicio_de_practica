<style>
  .navbar {
    background-color: #343a40;
    /* Color de fondo del navbar */
  }

  .navbar-brand {
    font-family: 'Arial Black', sans-serif;
    /* Fuente personalizada para el brand */
    color: #fff !important;
  }

  .nav-link {
    color: #fff !important;
    /* Color de texto de los links */
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
  }

  .nav-link:hover {
    background-color: #495057;
    /* Color de fondo al hacer hover */
    color: #ffc107 !important;
    /* Color de texto al hacer hover */
  }

  .navbar-toggler {
    border-color: #ffc107;
    /* Color del borde del botón toggler */
  }

  .navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%287, 119, 255, 1%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
  }
</style>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/cuxum_raxcaco_ejercicio_de_practica/views/inicion/index.php">Página Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link" href="/cuxum_raxcaco_ejercicio_de_practica/views/cliente/index.php">Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/cuxum_raxcaco_ejercicio_de_practica/views/mascota/index.php">Mascotas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/cuxum_raxcaco_ejercicio_de_practica/views/cita/index.php">Citas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>