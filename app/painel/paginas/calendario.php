<?php 
$pag = 'calendario';

if(@$calendario == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

<link href="./../../painel/paginas/fullcalendar/css/custom.css" rel="stylesheet">

    <div id='calendar'></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src='./../../painel/paginas/fullcalendar/js/index.global.min.js'></script>
    <script src="./../../painel/paginas/fullcalendar/js/bootstrap5/index.global.min.js"></script>
    <script src='./../../painel/paginas/fullcalendar/js/core/locales-all.global.min.js'></script>
    <script src='../../../painel/paginas/fullcalendar/js/custom.js'></script>

