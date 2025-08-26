<?php 
@session_start();
include('../../conexao.php');

$id = @$_POST['id'];
$enviar = @$_POST['enviar'];

ob_start();
include("recibo.php");
$html = ob_get_clean();

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);



//Definir o tamanho do papel e orientação da página
$pdf->set_paper(array(0, 0, 320.28, 290.89));

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();


$output = $pdf->output();
$arquivo = "../pdf/recibo_".$id.".pdf";
	
if(file_put_contents($arquivo,$output) <> false) {
	$pdf->stream(
	'recibo.pdf',
	array("Attachment" => false)
);

}


$query = $pdo->query("SELECT * from receber where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['cliente'];
$parcela = $res[0]['parcela'];

$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res[0]['telefone'];

// Cria uma chave única para essa parcela
$chave_envio = 'enviado_recibo_' . $id;

// Verifica se já foi enviado
if ($token != "" && $instancia != "" && $enviar == 'Sim' && empty($_SESSION[$chave_envio])) {

    // Marca como enviado
    $_SESSION[$chave_envio] = true;

    // Envia o PDF só uma vez
    $telefone_envio = '55' . preg_replace('/[ ()-]+/', '', $telefone);
    $mensagem = 'Recibo_Parcela_' . $parcela;
    $url_envio = $url_sistema . "painel/pdf/recibo_" . $id . ".pdf";
    
    require("../apis/file.php");
}


?>