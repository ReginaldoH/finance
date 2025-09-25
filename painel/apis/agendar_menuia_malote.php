<?php 
require_once __DIR__ . '/../../conexao.php';

// $dados_conta = [341];
$dados_conta = [395, 348];
// transforma o array em string separada por vírgula
$ids_str = implode(',', $dados_conta);

$query = $pdo->query("SELECT * 
    FROM receber AS r 
    WHERE r.id IN ($ids_str) 
    AND r.hash IS NULL");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

   print_r("Quantidade de mensagem: " . $total_reg);
    foreach ($res as $id) {
        $id_conta = $id['id'];
        $enviar_whatsapp = 'Sim';
        require('agendar_menuia.php');
        echo('<br><br>Conta ID: ' . $id_conta);
        echo('<br>Status: ' . $message );
        echo('<br>hash: ' . $hash );

}

?>