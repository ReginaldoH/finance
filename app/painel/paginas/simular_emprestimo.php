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


</style>
<!-- SIMULADOR -->
<div class="content" style="margin-top: 75px;">
  <h2>Simulador de Empréstimo</h2>
     
    <div class="row g-2">

      <!-- Valor -->
      <div class="col-12">
        <div class="form-floating position-relative">
          <i class="bi bi-cash-coin position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="number" class="form-control rounded-xs ps-5" id="valor" name="valor" placeholder="Valor" required >
          <label class="color-theme ps-5">Valor do Empréstimo (R$)</label>
        </div>
      </div>

      <!-- Parcelas + Juros Final -->
      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-stack position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="number" class="form-control rounded-xs ps-5" id="parcelas" name="parcelas" placeholder="Parcelas" required value="1">
          <label class="color-theme ps-5">Parcelas</label>
        </div>
      </div>

      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-percent position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="number" class="form-control rounded-xs ps-5" id="juros" name="juros" placeholder="Juros Final %" required >
          <label class="color-theme ps-5">Juros Final %</label>
        </div>
      </div>

      <!-- Tipo de Juros -->
      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-bar-chart-line-fill position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <select class="form-select rounded-xs ps-5" name="tipo" id="tipo">
            <option disabled value="Padrão">Juros Padrão (Básico)</option>
            <option disabled value="Simples">Juros Simples (Price JS)</option>
            <option disabled value="Composto_Price">Juros Composto Banco</option>
            <option disabled value="composto">Juros Composto Comum</option>
            <option value="prefixado">Juros Prefixados</option>
            <option disabled value="Somente Júros">Somente Juros</option>
            <option disabled value="Sem Júros">Sem Juros</option>
          </select>
          <label class="color-theme ps-5">Tipo de Cálculo</label>
        </div>
      </div>

      <div class="col-6">
        <div class="form-floating position-relative">
          <i class="bi bi-calendar-check-fill position-absolute start-0 top-50 translate-middle-y ms-3"></i>
          <input type="date" class="form-control rounded-xs ps-5" id="dataPrimeira" name="dataPrimeira" value="<?php echo date('Y-m-d', strtotime($data_atual . " +1 month")) ?>">
          <label class="color-theme ps-5">Vencimento</label>
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
    function calcular() {
      const valor = parseFloat(document.getElementById('valor').value);
      const parcelas = parseInt(document.getElementById('parcelas').value);
      const juros = parseFloat(document.getElementById('juros').value) / 100;
      const tipo = document.getElementById('tipo').value;
      const dataInicio = document.getElementById('dataPrimeira').value ? new Date(document.getElementById('dataPrimeira').value) : new Date();

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

      for (let i = 1; i <= parcelas; i++) {
        const dataParcela = new Date(dataInicio);
        dataParcela.setMonth(dataParcela.getMonth() + (i - 1));
        const dia = String(dataParcela.getDate()).padStart(2, '0');
        const mes = String(dataParcela.getMonth() + 1).padStart(2, '0');
        const ano = dataParcela.getFullYear();

        const dataFormatada = `${dia}/${mes}/${ano}`;

        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${i}</td><td>${dataFormatada}</td><td>R$ ${valorParcela.toFixed(2).replace('.', ',')}</td>`;
        tbody.appendChild(tr);
      }

      const lucro = total - valor;
      document.getElementById('total').innerText = 'R$ ' + total.toFixed(2).replace('.', ',');
      document.getElementById('lucro').innerText = 'R$ ' + lucro.toFixed(2).replace('.', ',');
      document.getElementById('resultado').style.display = 'table';
    }

    function limparCampos() {
      document.getElementById('valor').value = '';
      document.getElementById('parcelas').value = '';
      document.getElementById('juros').value = '';
      document.getElementById('tipo').value = 'composto';
      document.getElementById('dataPrimeira').value = '';
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

  </script>