<?php 
$tabela = 'calendario';
require_once("../../../conexao.php");

// pega as datas enviadas pelo FullCalendar
$start = isset($_GET['start']) 
    ? date("Y-m-d", strtotime($_GET['start'])) 
    : date("Y-m-01");

$end = isset($_GET['end']) 
    ? date("Y-m-d", strtotime($_GET['end'])) 
    : date("Y-m-t");

$query = $pdo->query("SELECT data_venc, valor, referencia, descricao from receber where pago != 'Sim'
 AND data_venc BETWEEN '$start' AND '$end' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$eventos = [];
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
        //  {"title":"Conta de Luz","start":"2025-09-20","valor":"120,50"},
        $valorF = $valorF = @number_format($res[$i]['valor'], 2, ',', '.');;
		$eventos[] = [
        'title' => $res[$i]['referencia'] . ': ' . $res[$i]['descricao'],
        'start' => $res[$i]['data_venc'], // precisa estar em formato YYYY-MM-DD
        'valor' => $valorF
    ];


	}
}

echo json_encode($eventos, JSON_UNESCAPED_UNICODE);

?>