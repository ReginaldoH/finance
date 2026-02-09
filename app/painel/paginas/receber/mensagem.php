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
$id_ref = $res2[0]['id_ref'];

$tot_parcelas = '';
$query22 = $pdo->query("SELECT tipo_juros, parcelas, contato FROM emprestimos where id = '$id_ref'");
$res22 = $query22->fetchAll(PDO::FETCH_ASSOC);
$tipo_juros = $res22[0]['tipo_juros'];
$total_parcelas = $res22[0]['parcelas'];
if($tipo_juros != 'Somente Júros'){
   $tot_parcelas = ' / '.$total_parcelas;
}
$contato = $res22[0]['contato'];
if($contato != ''){
   $contato  = '📲 Contato: *' . $contato . '* ';
}else{
   $contato = '';
}

$dataF = implode('/', array_reverse(@explode('-', $data)));

$valorF = number_format($valor, 2, ',', '.');


$query2 = $pdo->query("SELECT * from clientes where id = '$id_cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome = @$res2[0]['nome'];
$telefone = @$res2[0]['telefone'];
$tel_cliente = '55' . preg_replace('/[ ()-]+/', '', $telefone);
$telefone_envio = $tel_cliente;

if ($token != "" and $instancia != "") {
   $mensagem = '*💰' . $nome_sistema . '* %0A';
   $mensagem .= '--------------------------------%0A';
   $mensagem .= '*📌LEMBRETE DE PAGAMENTO* %0A%0A';
   $mensagem .= 'Olá *' . $nome . '*, tudo bem? 😊 %0A';
   //Tratamento de vencimento
   if ($data == $data_atual) {
      //Vence hoje
      $mensagem .= 'Estamos lembrando que *hoje (' . $dataF . ')* vence sua parcela:%0A%0A';
   } else if ($data < $data_atual) {
      //já venceu
      $mensagem .= 'Verificamos que sua parcela com vencimento em *' . $dataF . '* ainda consta em aberto:%0A%0A';
   } else {
      //Ainda não venceu
      $mensagem .= 'Estamos passando para lembrar sobre a sua parcela em aberto:%0A%0A';
   }
   $mensagem .= '📅 Data: *' . $dataF . '* %0A';
   $mensagem .= '💲 Valor: *' . $valorF . '* %0A';
   if ($parcela > 0) {
      $mensagem .= '🔢Parcela: *' . $parcela . '' . $tot_parcelas . '* %0A';
   }
   $mensagem .= $contato . '%0A%0A';  
   if ($data < $data_atual) {
      //já venceu
      $mensagem .= 'Pedimos a gentileza de realizar o pagamento o quanto antes. %0A%0A';
   }
   if ($pix_sistema != "") {
      $mensagem .= '*Chave Pix:* %0A';
      $mensagem .= $pix_sistema;
   } else {
      $mensagem .= '⬇️ CLIQUE PARA PAGAR ⬇️ %0A%0A';
      $mensagem .= '*Link Pagamento:* %0A';
      $mensagem .= $link_pgto;
   }
   $mensagem .= '%0A%0ASe já tiver realizado o pagamento, por favor, desconsidere esta mensagem. %0A';
   $mensagem .= 'Caso precise de ajuda, estamos à disposição. 🤝 %0A';
   require('../../../../painel/apis/texto.php');

}
?>