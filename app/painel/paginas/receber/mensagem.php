<?php 
require_once("../../../../conexao.php");

$id = $_POST['id'];


$query2 = $pdo->query("SELECT * from receber where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_cliente = @$res2[0]['cliente'];
$data = @$res2[0]['data_venc'];
$valor = @$res2[0]['valor'];
$parcela = @$res2[0]['parcela'];
$referencia = @$res2[0]['referencia'];
$descricao = @$res2[0]['descricao'];
$data_atual = date("Y-m-d");

$dataF = implode('/', array_reverse(@explode('-', $data)));
	
$valorF = number_format($valor, 2, ',', '.');


$query2 = $pdo->query("SELECT * from clientes where id = '$id_cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome = @$res2[0]['nome'];
$telefone = @$res2[0]['telefone'];
$tel_cliente = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
$telefone_envio = $tel_cliente;

if($token != "" and $instancia != ""){
    $mensagem  = '*'.$nome_sistema.'* %0A';
    $mensagem .= '--------------------------------%0A';
    $mensagem .= '*📌 Lembrete de Pagamento* %0A%0A';
    $mensagem .= 'Olá *'.$nome.'*, tudo bem? 😊 %0A';
    //Tratamento de vencimento
    if ( $data == $data_atual) {
       //Vence hoje
       $mensagem .= 'Estamos lembrando que *hoje ('.$dataF.')* vence sua parcela:%0A%0A';
    } else if ( $data < $data_atual ){
       //já venceu
       $mensagem .= 'Verificamos que sua parcela com vencimento em *'.$dataF.'* ainda consta em aberto:%0A%0A';
    } else{
        //Ainda não venceu
        $mensagem .= 'Estamos passando para lembrar sobre a sua parcela em aberto:%0A%0A';
    }
    $mensagem .= '📅 Data: *'.$dataF.'* %0A';
    $mensagem .= '💲 Valor: *'.$valorF.'* %0A';
    $mensagem .= '🔢 Parcela: *'.$parcela.'* %0A%0A';
    if ( $data < $data_atual ){
       //já venceu
       $mensagem .= 'Pedimos a gentileza de realizar o pagamento o quanto antes. %0A%0A';
    }
    $mensagem .= 'Se já tiver realizado o pagamento, por favor, desconsidere esta mensagem. %0A';
    $mensagem .= 'Caso precise de ajuda, estamos à disposição. 🤝 %0A';

    require('../../../../painel/apis/texto.php');

}
?>