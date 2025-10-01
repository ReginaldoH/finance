<?php 
require_once __DIR__ . '/../../conexao.php';
//enviar mensagem Agendada para o cliente
if($token != "" and $instancia != "" and $enviar_whatsapp == 'Sim'){
	$query = $pdo->query("SELECT * 
									FROM receber AS r 
									INNER JOIN clientes AS c 
									ON r.cliente = c.id 
									WHERE r.id = '$id_conta' ");

	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);




	if($total_reg > 0){
		$id_ref = $res[0]['id_ref'];	
		$query_emprestimo = $pdo->query("SELECT * 
										FROM emprestimos									
										WHERE id = '$id_ref'");
		$res_emprestimo = $query_emprestimo->fetchAll(PDO::FETCH_ASSOC);
		$parcelas = $res_emprestimo[0]['parcelas'];
		$contato = $res_emprestimo[0]['contato'];
	if (strlen($contato ?? '') == 0) {
		$contato = '';
	} else {
		$contato = '/' . $contato;
	}


		$data_venc = $res[0]['data_venc'];
		$parcela = $res[0]['parcela'];
		$nome_cliente = $res[0]['nome'];
		$tel_cliente = $res[0]['telefone'];
		$tel_cliente = '55'.preg_replace('/[ ()-]+/' , '' , $tel_cliente);
		$telefone_envio = $tel_cliente;
		$valor = $res[0]['valor'];
		$valorF = number_format($valor, 2, ',', '.');
		$data_vencF = date('d', strtotime($data_venc));
		
		$data_alerta = date('Y-m-d', strtotime("-$dias_aviso days",strtotime($data_venc)));
		$hora_alerta = "09:00:00";
		$data_envio = $data_alerta . ' ' . $hora_alerta ;

		$mensagem = '💰 *' . $nome_sistema . '*%0A';
		$mensagem .= '📢 _Agendamento Automatizado_ %0A';
		if ( $res_emprestimo) {
			# code...
		}
		$mensagem .= 'Olá  *'.$nome_cliente.$contato.'*, tudo bem com você?%0A%0A';
		$mensagem .= 'Estamos passando para *lembrar com antecedência* sobre sua próxima parcela:%0A%0A';
		$mensagem .= '🔢 *Parcela: nº* '.$parcela.' de '.$parcelas.'%0A';
		$mensagem .= '💲 *Valor:* R$ '.$valorF.' %0A';
		$mensagem .= '📅 *Vencimento:* dia '.$data_vencF.' %0A%0A';
		$mensagem .= '👉 Organize-se para o pagamento até a data e garanta tranquilidade, evitando encargos. %0A%0A';
		$mensagem .= '✨ Pagando suas parcelas em dia, você aumenta sua credibilidade e libera mais crédito para futuros empréstimos com condições ainda melhores! 🚀%0A%0A';
		$mensagem .= 'Qualquer dúvida, estamos à disposição! 👊';

		require('agendar.php');
		$message = $messageAgendar;
		$pdo->query("UPDATE receber SET hash = '$hash', data_alerta = '$data_alerta', hora_alerta = '$hora_alerta', alerta = 'Sim' where id = '$id_conta' ");
	}
}

?>