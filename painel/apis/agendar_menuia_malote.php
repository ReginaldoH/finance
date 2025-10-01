<?php 
require_once __DIR__ . '/../../conexao.php';

$queryEmprestimo = $pdo->query("SELECT r.id AS id, c.telefone, r.data_venc FROM receber AS r INNER JOIN clientes AS c ON r.cliente = c.id WHERE r.pago != 'Sim' AND c.enviar_whatsapp = 1 AND CHAR_LENGTH(TRIM(r.hash)) = 0 AND c.telefone IS NOT NULL AND c.telefone != '' ORDER BY r.data_venc DESC");
$resEmprestimo = $queryEmprestimo->fetchAll(PDO::FETCH_ASSOC);
$dados_conta = array_map('intval', array_column($resEmprestimo, 'id'));
// $dados_conta = [395, 348];
// echo('<pre>');
// print_r($dados_conta);
// print_r("<br><br>");
// print_r(array_map('intval', array_column($resEmprestimo, 'id')));
// echo('</pre>');
// exit;
// transforma o array em string separada por vírgula
$ids_str = implode(',', $dados_conta);

$query = $pdo->query("SELECT * 
    FROM receber AS r 
    WHERE r.id IN ($ids_str) ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

   print_r("Quantidade de mensagens: " . $total_reg);
    foreach ($res as $id) {
        $id_conta = $id['id'];
        $enviar_whatsapp = 'Sim';
        require('agendar_menuia.php');
        echo('<br><br>Conta ID: ' . $id_conta);
        echo('<br>Status: ' . $message );
        echo('<br>hash: ' . $hash );

}

?>