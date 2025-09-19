<?php 
$pag = 'calendario';

if(@$calendario == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'> -->

<link href="paginas/fullcalendar/css/custom.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container ">
  <div class="row align-items-center mt-3 mb-2">
    <div class="col-8">
      <h4 class="m-0">📅 Agenda Receber</h4>
    </div>
    <div class="col-4 text-end">
      <!-- exemplo de select cliente (opcional) -->
      <select id="clienteSelect" class="form-select form-select-sm">
        <option value="">Todos clientes</option>
        <option value="1">Cliente 1</option>
        <option value="2">Cliente 2</option>
      </select>
    </div>
  </div>

  <div id="calendar"></div>
</div>

<!-- Modal de detalhes -->
<div class="modal fade" id="detalhesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes do dia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <ul id="listaEventos" class="list-group"></ul>
      </div>
      <div class="modal-footer">
        <span id="totalDia" class="me-auto fw-bold"></span>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap + FullCalendar JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
    <!-- <script src='paginas/fullcalendar/js/index.global.min.js'></script> -->
    <!-- <script src="paginas/fullcalendar/js/bootstrap5/index.global.min.js"></script> -->
     
<script src='paginas/fullcalendar/js/core/locales-all.global.min.js'></script>
<script src='paginas/fullcalendar/js/custom.js'></script>

