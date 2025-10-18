<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">


  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#2c4a89" />
  <title>Simulador de Empréstimo 1</title>
   <link rel="icon" type="image/png" href="./meu-icone.png">
  <link rel="shortcut icon" type="image/x-icon" href="img/icone.png">

  <link rel="apple-touch-icon" href="img/icone.png" sizes="180x180">

  <link rel="manifest" href="manifest.json?v=1.0">

<style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0 15px;
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-top: 20px;
    }

    /* NOVO: Estilo para o contêiner principal dos campos */
    .container-campos {
      max-width: 600px;
      margin: 0 auto;
      padding: 15px;
      background: #ffffff; /* Fundo branco para destacar o formulário */
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* NOVO: Estilo para cada grupo de label/input */
    .form-group {
      margin-bottom: 15px;
    }

    label {
        display: block; /* Garante que a label ocupe sua própria linha */
        margin-bottom: 5px;
        font-weight: 500;
        color: #34495e;
    }

    input, select, button {
      width: 100%;
      padding: 12px; /* Aumentei um pouco o padding para melhor toque */
      margin-top: 0;
      border-radius: 6px;
      border: 1px solid #bdc3c7;
      box-sizing: border-box;
      font-size: 16px;
    }
    
    .botoes {
      display: flex;
      gap: 10px;
      margin-top: 20px;
      flex-wrap: wrap;
    }
    button {
      flex: 1;
      background: #3498db;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover { background: #2980b9; }
    .limpar { background: #e74c3c; }
    .limpar:hover { background: #c0392b; }
    .whatsapp { background: #25d366; }
    .whatsapp:hover { background: #1da851; }

    /* --- ESTILOS DA TABELA RESTAURADOS --- */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom: 60px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    th {
      background: #3498db;
      color: white;
    }
    
    /* Restaura a cor de fundo das linhas */
    tr {
      background: #60d6f6;
      color: #000;
    }
    
    /* Restaura a cor de fundo das linhas pares (se você tiver) */
    .valor_tr_verde {
      background: #71e388 !important; /* Usei !important para garantir a aplicação */
      color: #000;
    }

    tfoot td {
      font-weight: bold;
      background: #ecf0f1;
    }
    
    /* --- ESTILOS DO RANGE --- */
    .range-rs {
      -webkit-appearance: none;
      width: 100%;
      height: 8px;
      border-radius: 5px;
      background: linear-gradient(90deg, #4caf50, #ffeb3b, #f44336);
      outline: none;
      border: none; /* Remove a borda padrão do input range */
    }
    .range-rs::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 30px;
      height: 30px;
      background: #2c4a89;
      border-radius: 50%;
      cursor: pointer;
      position: relative;
    }
    .range-rs::-webkit-slider-thumb::after {
      content: "R$";
      color: #fff;
      font-size: 12px;
      font-weight: bold;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    /* --- MÍDIA QUERY PARA RESPONSIVIDADE --- */
    @media (max-width: 600px) {
      body { padding: 10px; }
      .container-campos { padding: 10px; }
      input, select, button { font-size: 15px; }
      th, td { font-size: 14px; }
    }
  </style>
</head>
<body>

  <h2>Simulador de Empréstimo V0.2</h2>

  <div class="container-campos">
    
    <div class="form-group">
      <label for="valor" id="valorExibido">Valor do Empréstimo <b>R$ 1.000,00</b> </label>
      <input type="number" id="valor" value="1000" onchange="calcular()">
      <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
        <input type="range" id="valorRange" min="100" max="20000" value="1000" step="100"
               oninput="atualizarValor(this.value)" class="range-rs">
      </div>
    </div>

    <!-- <div class="form-group">
      <label for="valor" id="parcelasExibido">Parcela <b>( 1 ) </b> </label>
      <input type="hidden" id="parcelas" value="1" onchange="calcular()">
      <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
        <input type="range" id="valorRange" min="1" max="4" value="1" step="1"
               oninput="atualizarParcelas(this.value)" class="range-rs">
      </div>
    </div> -->
    <div class="form-group">
      <label for="parcelas">Parcelas</label>
      <select id="parcelas" onchange="calcular()">
        <option value="1">1 parcela</option>
        <option value="2">2 parcelas</option>
        <option value="3">3 parcelas</option>
        <option value="4">4 parcelas</option>
        <option value="5">5 parcelas</option>
      </select>
    </div>

    <div class="form-group">
      <label for="data_venc">Data Primeira Parcela</label>
      <input type="date" id="data_venc" onchange="calcular()" value="2025-10-08">
    </div>

    <div class="form-group">
      <label for="juros">Juros Final (%)</label>
      <input disabled type="number" id="juros" value="20">
    </div>

    <div class="form-group">
      <label for="tipo">Tipo de Cálculo</label>
      <select disabled id="tipo">
        <option value="Prefixado">Juros Prefixado</option>
        <option value="Composto">Juros Composto</option>
        <option value="Simples">Juros Simples</option>
        <option value="Sem Júros">Sem Juros</option>
      </select>
    </div>

    <div class="botoes">
      <button onclick="calcular()">Calcular</button>
      <button class="limpar" onclick="limparCampos()">Limpar</button>
      <button class="whatsapp" onclick="enviarWhatsApp()">Enviar WhatsApp</button>
    </div>

    <table id="resultado" style="display:none;">
      <thead>
        <tr>
          <th># Parcela</th>
          <th>Data</th>
          <th>Valor Parcela (R$)</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tfoot>
        <tr><td colspan="2">Total a Pagar</td><td id="total"></td></tr>
        <tr><td colspan="2">Lucro Real</td><td id="lucro"></td></tr>
      </tfoot>
    </table>
  </div>

  <script>
  // Pega a data atual (ou a data inicial desejada)
  const dataHoje = new Date(); // ou new Date('2025-10-08');
  // Soma 1 mês
  let mes = dataHoje.getMonth() + 1; // meses vão de 0 a 11
  let ano = dataHoje.getFullYear();
  let dia = dataHoje.getDate();

  // Ajusta para o próximo mês
  mes += 1;
  if (mes > 11) { // ultrapassou dezembro
    mes = 0; // janeiro
    ano += 1;
  }

  // Cria nova data
  const dataProximoMes = new Date(ano, mes, dia);
  // Formata como YYYY-MM-DD para o input
  const anoFormat = dataProximoMes.getFullYear();
  const mesFormat = String(dataProximoMes.getMonth()).padStart(2, '0');
  const diaFormat = String(dataProximoMes.getDate()).padStart(2, '0');
  document.getElementById('data_venc').value = `${anoFormat}-${mesFormat}-${diaFormat}`;
</script>

<script>
function valorToBr(valor) {
  return Number(valor).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function atualizarValor(valor) {
  document.getElementById('valor').value = valor;
  document.getElementById('valorExibido').innerHTML = "Valor do Empréstimo <b>R$ " + valorToBr(valor) + "</b>";
  calcular();
}

function atualizarParcelas(parcelas) {
  document.getElementById('parcelas').value = parcelas;
  document.getElementById('parcelasExibido').innerHTML = "Parcela <b> ( " + (parcelas) + " )</b>";
  calcular();
}

function calcular() {
  // Captura dos valores dos campos (ajustei os IDs para o que parece ser usado no PHP)
  const valor = parseFloat(document.getElementById('valor').value.replace('.', '').replace(',', '.')); // Valor total do empréstimo
  document.getElementById('valorExibido').innerHTML = "Valor do Empréstimo <b>R$ " + valorToBr(valor) + "</b>";
  const parcelas = parseInt(document.getElementById('parcelas').value); // Número de parcelas
  const juros = parseFloat(document.getElementById('juros').value.replace(',', '.')) / 100; // Taxa de juros (ex: 5 para 5%)
  const tipo = document.getElementById('tipo').value; // Tipo de juros (ex: 'Padrão', 'Simples', 'Composto_Price')
  const data_venc = document.getElementById('data_venc').value; // Data do primeiro vencimento (YYYY-MM-DD)
  // const dias_frequencia = parseInt(document.getElementById('frequencia').value); // Frequência em dias (ex: 30, 7)
  const dias_frequencia = 30; // Frequência em dias (ex: 30, 7)

  // Verifica se os campos obrigatórios foram preenchidos
  if (isNaN(valor) || isNaN(parcelas) || isNaN(juros) || !data_venc || isNaN(dias_frequencia)) {
      alert('Preencha todos os campos corretamente (Valor, Parcelas, Juros, Data Vencimento, Frequência)!');
      return;
  }

  if (valor <= 0 || parcelas <= 0) {
      alert('Valor e Parcelas devem ser maiores que zero.');
      return;
  }

  let valor_parcela_base = valor / parcelas;
  let valor_parcela_final = 0;
  let valor_sem_juros = valor_parcela_base;
  let valor_total_juros = 0;
  let total_emprestimo = 0;
  let parcelas_calculadas = []; // Array para armazenar os detalhes das parcelas
  // --- Lógica de Cálculo da Parcela Final (Adaptado do PHP) ---
  // A maioria dos tipos no PHP calcula o valor final *por parcela*
  if (tipo === 'Padrão') {
      // Padrão: Valor base + (Valor base * Juros / 100)
      valor_parcela_final = valor_parcela_base + (valor_parcela_base * juros);
      total_emprestimo = valor_parcela_final * parcelas;
  } 
  else if (tipo === 'Simples') {
      // Simples: Juros são aplicados em todas as parcelas (PHP faz isso no loop)
      // O valor da parcela final será calculado dentro do loop, pois depende do 'i' (parcela)
      // Vamos usar um placeholder por enquanto.
      valor_parcela_final = 0; 
  } 
  else if (tipo === 'Composto' || tipo === 'Composto_Price') {
      // Composto Price (Usado nos empréstimos bancários)
      const taxa_mensal = juros;
      const fator = Math.pow(1 + taxa_mensal, parcelas);
      valor_parcela_final = valor * (taxa_mensal * fator) / (fator - 1);
      total_emprestimo = valor_parcela_final * parcelas;
  } 
  else if (tipo === 'Prefixado') {
      // Prefixado: Valor base + (Valor total * Juros / 100)
      valor_parcela_final = valor_parcela_base + (valor * juros);
      total_emprestimo = valor_parcela_final * parcelas;
      // console.log("valor_parcela_base " + valor_parcela_base);
      // console.log("valor " + valor);
      // console.log("juros " + juros);
      // console.log("parcelas " + parcelas);
      // console.log("valor_parcela_base + (valor * juros / parcelas) ");
      // console.log("valor_parcela_final " + valor_parcela_final);
  } 
  else if (tipo === 'Somente Júros') {
      // Somente Júros: A parcela principal é apenas os juros do valor total.
      valor_parcela_final = valor * juros;
      valor_sem_juros = 0;
      total_emprestimo = valor_parcela_final * parcelas;
  } 
  else if (tipo === 'Sem Júros') {
      // Sem Júros
      valor_parcela_final = valor_parcela_base;
      total_emprestimo = valor;
  } else {
      // Default para valor base se o tipo não for reconhecido (como 'Sem Júros')
      valor_parcela_final = valor_parcela_base;
      total_emprestimo = valor;
  }

  // --- Geração e Cálculo das Datas das Parcelas ---
  let data_venc_inicial = new Date(data_venc + 'T00:00:00'); // Adiciona T00:00:00 para evitar problemas de fuso horário

  for (let i = 1; i <= parcelas; i++) {
    let valor_atual_parcela = valor_parcela_final;
    let data_parcela = new Date(data_venc_inicial); // Começa com a data do primeiro vencimento
    
    // --- Recálculo para Simples e Determinação da Data ---
    if (tipo === 'Simples') {
        // Recalcula para o Simples, pois depende da parcela 'i'
        valor_atual_parcela = valor_parcela_base + (valor_parcela_base * juros * i);
        total_emprestimo += valor_atual_parcela;
    }

    // Lógica de Vencimento Adaptada (simplificada do PHP)
    if (i > 1) {
        if (dias_frequencia === 30 || dias_frequencia === 31) {
            // Mensal, Bimensal, etc. (30 ou 31 dias)
            let meses_adicionar = i - 1; 
            data_parcela.setMonth(data_parcela.getMonth() + meses_adicionar);

        } else if (dias_frequencia === 90) { 
            // Trimestral
            let meses_adicionar = (i - 1) * 3;
            data_parcela.setMonth(data_parcela.getMonth() + meses_adicionar);

        } else if (dias_frequencia === 180) { 
            // Semestral
            let meses_adicionar = (i - 1) * 6;
            data_parcela.setMonth(data_parcela.getMonth() + meses_adicionar);

        } else if (dias_frequencia === 360 || dias_frequencia === 365) { 
            // Anual
            let meses_adicionar = (i - 1) * 12;
            data_parcela.setMonth(data_parcela.getMonth() + meses_adicionar);

        } else {
            // Outras Frequências (7, 15, 1 dia, etc.) - Adiciona dias ao vencimento da parcela anterior
            let dias_adicionar = (i - 1) * dias_frequencia;
            data_parcela = new Date(data_venc_inicial);
            data_parcela.setDate(data_parcela.getDate() + dias_adicionar);
        }
    }
      
    // Formatação da data (DD/MM/AAAA)
    const dia = String(data_parcela.getDate()).padStart(2, '0');
    const mes = String(data_parcela.getMonth() + 1).padStart(2, '0');
    const ano = data_parcela.getFullYear();
    const dataFormatada = `${dia}/${mes}/${ano}`;

    parcelas_calculadas.push({
        numero: i,
        vencimento: dataFormatada,
        valor: valor_atual_parcela
    });
  }

  // Se o tipo era Simples, o valor_total_juros foi acumulado no loop.
  if (tipo !== 'Simples') {
      valor_total_juros = total_emprestimo - valor;
  } else {
      // Se Simples, o total_emprestimo foi somado no loop.
      valor_total_juros = total_emprestimo - valor;
      // Ajusta o total_emprestimo para o valor final acumulado no Simples
      // Nota: No PHP, o valor final da parcela no Simples é o último valor calculado, mas o total é a soma.
  }
      
  // --- Renderização da Tabela ---
  const tbody = document.querySelector('#resultado tbody');
  tbody.innerHTML = '';
  let valorParcelaFor = 0;
  parcelas_calculadas.forEach(p => {
    const tr = document.createElement('tr');
    console.log("i " + p.numero);
    console.log("valor " + p.valor);
    console.log("valorParcelaFor " + valorParcelaFor);
    if (valorParcelaFor < valor ) {
      tr.classList.add('valor_tr_verde');
    }
    valorParcelaFor = valorParcelaFor + p.valor;
      const valorFormatado = valorToBr(p.valor);
      tr.innerHTML = `<td>${p.numero}</td><td>${p.vencimento}</td><td>R$ ${valorFormatado}</td>`;
      tbody.appendChild(tr);
  });

    // --- Renderização dos Totais ---
    const totalFormatado = valorToBr(total_emprestimo);
    const lucroFormatado = valorToBr(valor_total_juros);

    document.getElementById('total').innerText = 'R$ ' + totalFormatado;
    document.getElementById('lucro').innerText = 'R$ ' + lucroFormatado;
    document.getElementById('resultado').style.display = 'table';
  }

function enviarWhatsApp() {
  const total = document.getElementById('total').innerText;
  const lucro = document.getElementById('lucro').innerText;
  const valor = document.getElementById('valor').value;
  const parcelas = document.getElementById('parcelas').value;
  const juros = document.getElementById('juros').value;
  const mensagem = encodeURIComponent(`💰 *Simulação de Empréstimo*\nValor: R$ ${valor}\nParcelas: ${parcelas}\nJuros: ${juros}%\n${total}\n${lucro}`);
  window.open(`https://wa.me/?text=${mensagem}`, '_blank');
}
</script>

<!-- Manifest e Service Worker -->
<script>
  // Não ulitar esta linha, problema de cache
// if ('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('sw.js');
// }

<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(function (registrations) {
      for (let registration of registrations) {
        registration.unregister();
      }
    }).then(() => {
      navigator.serviceWorker.register('sw.js?v=2.1', { updateViaCache: 'none' })
        .then(reg => reg.update());
    });
  }

</script>

</body>
</html>
