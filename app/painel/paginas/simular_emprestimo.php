<style>
h2 {
  text-align: center;
  color: #2c3e50;
}
 input, select, button {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 15px;
    }
    .botoes {
      display: flex;
      gap: 10px;
      margin-top: 15px;
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
    button:hover {
      background: #2980b9;
    }
    .limpar {
      background: #e74c3c;
    }
    .limpar:hover {
      background: #c0392b;
    }
    .whatsapp {
      background: #25d366;
    }
    .whatsapp:hover {
      background: #1da851;
    }
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
    tfoot td {
      font-weight: bold;
      background: #ecf0f1;
    }
    .valor_tr_verde{
      background: #71e388;
      color: #000;
    }
    tr{
      background: #60d6f6;
      color: #000;
    }

  .range-rs {
    -webkit-appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 5px;
    background: linear-gradient(90deg, #4caf50, #ffeb3b, #f44336);
    outline: none;
  }

  /* Bolinha do range */
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

  /* Adiciona o símbolo R$ */
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

  /* Para Firefox */
  .range-rs::-moz-range-thumb {
    width: 30px;
    height: 30px;
    background: #2c4a89;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
  }
  .range-rs::-moz-range-thumb::after {
    content: "R$";
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>
<!-- SIMULADOR -->
<div class="content" style="margin-top: 75px;">
  <h2>Simulador de Empréstimo</h2>
     
    <div class="row g-2">
      <!-- Valor do emprestimo-->
      <div class="col-12">
        <div class="form-floating position-relative">
          <i class="bi bi-cash-coin position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="number" class="form-control rounded-xs ps-5" id="valor" name="valor" placeholder="Valor" required value="1000" onchange="calcular()">
          <label class="color-theme ps-5">Valor do Empréstimo (R$)</label>
        </div>
          <div style="display: flex; align-items: center; gap: 10px;">
       <input type="range" id="valorRange" min="100" max="20000" value="1000" step="100"
           oninput="atualizarValor(this.value)"
           class="range-rs">
    
  </div>
      </div>

      <!-- Parcelas + Juros Final -->
      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-stack position-absolute start-0 top-50 translate-middle-y ms-3"></i>
           <select class="form-select rounded-xs ps-5" name="parcelas" id="parcelas"  onchange="calcular()">
            <option value="1">1 parcela</option>
            <option value="2">2 parcelas</option>
            <option value="3">3 parcelas</option>
            <option value="4">4 parcelas</option>
            <option value="5">5 parcelas</option>
          </select>
          <label class="color-theme ps-5">Parcelas</label>
        </div>
      </div>

      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-calendar-check-fill position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="date" class="form-control rounded-xs ps-5" id="data_venc" name="data_venc" value="<?php echo date('Y-m-d', strtotime($data_atual . " +1 month")) ?>" onchange="calcular()">
          <label class="color-theme ps-5">Vencimento</label>
        </div>
      </div>

      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-percent position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input disabled type="number" class="form-control rounded-xs ps-5" id="juros" name="juros" placeholder="Juros Final %" required value="20" onchange="calcular()">
          <label class="color-theme ps-5">Juros Final %</label>
        </div>
      </div>

      <!-- Tipo de Juros -->
      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-bar-chart-line-fill position-absolute start-0 top-50 translate-middle-y ms-3"></i>
        <select disabled class="form-select rounded-xs ps-5" name="tipo" id="tipo" onchange="calcular()">
          <option disabled value="Padrão">Juros Padrão (Básico)</option>
          <option disabled value="Simples">Juros Simples (Price JS)</option>
          <option disabled value="Composto_Price">Juros Composto Banco</option>
          <option disabled value="Composto">Juros Composto Comum</option>
          <option value="Prefixado">Juros Prefixados</option>
          <option value="Somente Júros">Somente Juros</option>
          <option value="Sem Júros">Sem Juros</option>
        </select>
          <label class="color-theme ps-5">Tipo de Cálculo</label>
        </div>
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
          <tr>
            <td colspan="2">Total a Pagar</td>
            <td id="total"></td>
          </tr>
          <tr>
            <td colspan="2">Lucro Real</td>
            <td id="lucro"></td>
          </tr>
        </tfoot>
      </table>
      
    </div>

</div>
<script>
  // function valorToBr(valor) {
  //   return Number(valor).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  // }

  function atualizarValor(valor) {
    document.getElementById('valor').value = (valor);
    calcular();
    // document.getElementById('valorExibido').innerText = 'R$ ' + valorToBr(valor);
  }
</script>

<script>
    function calcularOld() {
      const valor = parseFloat(document.getElementById('valor').value);
      const parcelas = parseInt(document.getElementById('parcelas').value);
      const juros = parseFloat(document.getElementById('juros').value) / 100;
      const tipo = document.getElementById('tipo').value;
      const dataInicio = document.getElementById('data_venc').value ? new Date(document.getElementById('data_venc').value) : new Date();

      if (!valor || !parcelas || !juros) {
        alert('Preencha todos os campos!');
        return;
      }

      let valorParcela = 0;
      let total = 0;

      if (tipo === 'composto') {
        valorParcela = valor * (juros * Math.pow(1 + juros, parcelas)) / (Math.pow(1 + juros, parcelas) - 1);
        total = valorParcela * parcelas;
      } else if (tipo === 'simples') {
        valorParcela = (valor + (valor * juros * parcelas)) / parcelas;
        total = valorParcela * parcelas;
      } else if (tipo === 'prefixado') {
        const totalPrefixado = valor * (1 + juros);
        valorParcela = totalPrefixado / parcelas;
        total = totalPrefixado;
      }

      const tbody = document.querySelector('#resultado tbody');
      tbody.innerHTML = '';
      let valorParcelaFor = 0;
      for (let i = 1; i <= parcelas; i++) {
        valorParcelaFor = valorParcelaFor + valorParcela;
        const dataParcela = new Date(dataInicio);
        dataParcela.setMonth(dataParcela.getMonth() + (i - 1));
        const dia = String(dataParcela.getDate()).padStart(2, '0');
        const mes = String(dataParcela.getMonth() + 1).padStart(2, '0');
        const ano = dataParcela.getFullYear();

        const dataFormatada = `${dia}/${mes}/${ano}`;
        const tr = document.createElement('tr');
        console.log("i " + i);
        console.log("valor " + valor);
        console.log("valorParcelaFor " + valorParcelaFor);
        if (valor > valorParcelaFor) {
          tr.className('valor_tr_verde');
        }
        tr.innerHTML = `<td>${i}</td><td>${dataFormatada}</td><td>R$ ${valorParcela.toFixed(2).replace('.', ',')}</td>`;
        tbody.appendChild(tr);
      }

      const lucro = total - valor;
      document.getElementById('total').innerText = 'R$ ' + total.toFixed(2).replace('.', ',');
      document.getElementById('lucro').innerText = 'R$ ' + lucro.toFixed(2).replace('.', ',');
      document.getElementById('resultado').style.display = 'table';
    }

    function calcular() {
      // Captura dos valores dos campos (ajustei os IDs para o que parece ser usado no PHP)
      const valor = parseFloat(document.getElementById('valor').value.replace('.', '').replace(',', '.')); // Valor total do empréstimo
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
  function valorToBr(valor) {
    return Number(valor).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
    function limparCampos() {
      document.getElementById('valor').value = '';
      document.getElementById('parcelas').value = '';
      document.getElementById('juros').value = '';
      document.getElementById('tipo').value = 'composto';
      document.getElementById('data_venc').value = '';
      document.getElementById('resultado').style.display = 'none';
    }

    function enviarWhatsApp() {
      const total = document.getElementById('total').innerText;
      const lucro = document.getElementById('lucro').innerText;
      const valor = document.getElementById('valor').value;
      const parcelas = document.getElementById('parcelas').value;
      const juros = document.getElementById('juros').value;

      if (!valor || !parcelas || !juros || total === '') {
        alert('Realize o cálculo antes de enviar pelo WhatsApp!');
        return;
      }

      const mensagem = encodeURIComponent(`💰 *Simulação de Empréstimo*\n\nValor: R$ ${valor}\nParcelas: ${parcelas}\nJuros: ${juros}% ao mês\n\n${total}\n${lucro}`);
      const link = `https://wa.me/?text=${mensagem}`;
      window.open(link, '_blank');
    }

    function mascara_valor(valor) {
      var valorAlterado = $('#'+valor).val();
      valorAlterado = valorAlterado.replace(/\D/g, ""); // Remove todos os não dígitos
      valorAlterado = valorAlterado.replace(/(\d+)(\d{2})$/, "$1,$2"); // Adiciona a parte de centavos
      valorAlterado = valorAlterado.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Adiciona pontos a cada três dígitos
      valorAlterado = valorAlterado;
      $('#'+valor).val(valorAlterado);
    }
  </script>