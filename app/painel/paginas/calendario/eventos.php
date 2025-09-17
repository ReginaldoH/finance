<?php 
$tabela = 'calendario';
require_once("../../../../conexao.php");

// pega as datas enviadas pelo FullCalendar
$start = isset($_GET['start']) 
    ? date("Y-m-d", strtotime($_GET['start'])) 
    : date("Y-m-01");

$end = isset($_GET['end']) 
    ? date("Y-m-d", strtotime($_GET['end'])) 
    : date("Y-m-t");
// echo('<pre>');
// print_r($start);
// print_r('<br>');
// print_r($end);
// echo('</pre>');
// exit;
$query = $pdo->query("SELECT data_venc, valor from receber where pago != 'Sim'
 AND data_venc BETWEEN '$start' AND '$end' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$eventos = [];
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
		$eventos[] = [
        'title' => 'R$ ' . number_format($res[$i]['valor'], 2, ',', '.'),
        'start' => $res[$i]['data_venc'] // precisa estar em formato YYYY-MM-DD
    ];


	}
}

echo json_encode($eventos, JSON_UNESCAPED_UNICODE);

?>