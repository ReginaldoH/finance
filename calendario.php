<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calendário - Soma diária + Detalhes</title>

  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.css" rel="stylesheet">

  <style>
    body { background:#f8f9fa; }
    #calendar { max-width:100%; margin:18px auto; background:#fff; padding:12px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,.08); }
    .fc-event-title { font-weight:700; font-size:0.95rem; color:#198754; } /* verde bootstrap */
    @media (max-width:480px){
      .fc .fc-toolbar-chunk { display:block; text-align:center; }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row align-items-center mt-3 mb-2">
    <div class="col-8">
      <h4 class="m-0">📅 Agenda Financeira</h4>
    </div>
    <div class="col-4 text-end">
      <!-- exemplo de select cliente (opcional) -->
      <select id="clienteSelect" class="form-select form-select-sm">
        <option value="">Todos clientes</option>
        <option value="1">Cliente 1</option>
        <option value="2">Cliente 2</option>
      </select>
    </div>
  </div>

  <div id="calendar"></div>
</div>

<!-- Modal de detalhes -->
<div class="modal fade" id="detalhesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes do dia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <ul id="listaEventos" class="list-group"></ul>
      </div>
      <div class="modal-footer">
        <span id="totalDia" class="me-auto fw-bold"></span>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap + FullCalendar JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var clienteSelect = document.getElementById('clienteSelect');
  var detalhesModalEl = document.getElementById('detalhesModal');
  var detalhesModal = new bootstrap.Modal(detalhesModalEl);
  var listaEventosEl = document.getElementById('listaEventos');
  var totalDiaEl = document.getElementById('totalDia');

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    initialView: 'dayGridMonth',
    locale: 'pt-br',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,listMonth'
    },
    height: 'auto',
    // pegamos os eventos por função para poder agregar no cliente
    events: function(fetchInfo, successCallback, failureCallback) {
      // monta URL com start/end + cliente
      var url = 'calendario_eventos.php?start=' + encodeURIComponent(fetchInfo.startStr) + '&end=' + encodeURIComponent(fetchInfo.endStr);
      if (clienteSelect && clienteSelect.value) {
        url += '&cliente=' + encodeURIComponent(clienteSelect.value);
      }

      fetch(url)
        .then(function(res){
          if (!res.ok) throw new Error('Erro na requisição: ' + res.status);
          return res.json();
        })
        .then(function(data){
          // Espera-se que `data` seja um array de objetos com ao menos:
          // { title, start, valor, ... }
          // Vamos agrupar por data (YYYY-MM-DD)
          var grouped = {}; // { '2025-09-20': { total: X, items:[...] } }
          data.forEach(function(item){
            // normalize start
            var date = (item.start || item.vencimento || '').toString().substr(0,10);
            if (!date) return;
            if (!grouped[date]) grouped[date] = { total: 0, items: [] };

            // tenta extrair valor numérico (suporta "123.45" ou "123,45")
            var valorRaw = item.valor;
            var valorNum = 0;
            if (typeof valorRaw === 'number') {
              valorNum = valorRaw;
            } else if (typeof valorRaw === 'string') {
              // remove pontos de milhar e troca vírgula por ponto
              var tmp = valorRaw.replace(/\./g,'').replace(',','.');
              valorNum = parseFloat(tmp) || 0;
            }

            grouped[date].total += valorNum;
            // armazena item com valor numérico para uso posterior
            var copy = Object.assign({}, item);
            copy._valorNum = valorNum;
            grouped[date].items.push(copy);
          });

          // monta array de eventos agregados
          var out = [];
          Object.keys(grouped).sort().forEach(function(date){
            var g = grouped[date];
            out.push({
              title: 'R$ ' + g.total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }),
              start: date,
              allDay: true,
              extendedProps: {
                total: g.total,
                items: g.items
              }
            });
          });

          successCallback(out);
        })
        .catch(function(err){
          console.error(err);
          failureCallback(err);
        });
    },

    // mostra apenas o título (já com o total formatado)
    eventContent: function(arg) {
      var div = document.createElement('div');
      div.className = 'fc-event-title';
      div.innerText = arg.event.title;
      return { domNodes: [div] };
    },

    // abrir modal com detalhamento dos itens do dia
    eventClick: function(info) {
      var items = info.event.extendedProps.items || [];
      listaEventosEl.innerHTML = '';
      if (items.length === 0) {
        listaEventosEl.innerHTML = '<li class="list-group-item">Sem valores</li>';
        totalDiaEl.innerText = '';
      } else {
        items.forEach(function(it){
          var li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-start';
          var descricao = it.title || it.descricao || it.nome || 'Item';
          var valorTxt = (typeof it._valorNum === 'number')
            ? it._valorNum.toLocaleString('pt-BR', { minimumFractionDigits: 2 })
            : (it.valor || '0,00');
          li.innerHTML = '<div>' + descricao + '</div><div>R$ ' + valorTxt + '</div>';
          listaEventosEl.appendChild(li);
        });
        var total = info.event.extendedProps.total || 0;
        totalDiaEl.innerText = 'Total do dia: R$ ' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
      }
      detalhesModal.show();
    }
  });

  calendar.render();

  // refazer eventos ao trocar cliente
  if (clienteSelect) {
    clienteSelect.addEventListener('change', function(){ calendar.refetchEvents(); });
  }
});
</script>

</body>
</html>
