document.addEventListener('DOMContentLoaded', function() {
  var clienteSelect = document.getElementById('clienteSelect');
  var detalhesModalEl = document.getElementById('detalhesModal');
  var detalhesModal = new bootstrap.Modal(detalhesModalEl);
  var listaEventosEl = document.getElementById('listaEventos');
  var totalDiaEl = document.getElementById('totalDia');
  var detalheDiaEl = document.getElementById('detalheDia');

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    initialView: 'dayGridMonth',
    locale: 'pt-br',
    expandRows: true,
    dayMaxEvents: false,
    dayMaxEventRows: false,
    height: "auto",
    contentHeight: "auto",
    headerToolbar: {
      right: 'today',
      center: 'title',
      left: 'prev,next'
    },
    height: 'auto',

    events: function(fetchInfo, successCallback, failureCallback) {
      var url = '../painel/paginas/calendario/eventos.php?start=' + encodeURIComponent(fetchInfo.startStr) + '&end=' + encodeURIComponent(fetchInfo.endStr);
      if (clienteSelect && clienteSelect.value) {
        url += '&cliente=' + encodeURIComponent(clienteSelect.value);
      }

      fetch(url)
        .then(function(res){
          if (!res.ok) throw new Error('Erro na requisição: ' + res.status);
          return res.json();
        })
        .then(function(data){
          var grouped = {};
          data.forEach(function(item){
            var date = (item.start || item.vencimento || '').toString().substr(0,10);
            if (!date) return;
            if (!grouped[date]) grouped[date] = { total: 0, items: [] };

            var valorRaw = item.valor;
            var valorNum = 0;
            if (typeof valorRaw === 'number') {
              valorNum = valorRaw;
            } else if (typeof valorRaw === 'string') {
              var tmp = valorRaw.replace(/\./g,'').replace(',','.');
              valorNum = parseFloat(tmp) || 0;
            }

            grouped[date].total += valorNum;
            var copy = Object.assign({}, item);
            copy._valorNum = valorNum;
            grouped[date].items.push(copy);
          });

          var out = [];
          Object.keys(grouped).sort().forEach(function(date){
            var g = grouped[date];

            // transforma total em milhares
            var tt = String(g.total);
            var milharTotal = tt.replace(/,\d+$/, ""); 
            milharTotal = Number(milharTotal) / 1000;

            out.push({
              title: (milharTotal.toFixed(1)),
              start: date,
              allDay: true,
              extendedProps: {
                total: g.total,
                qtd: g.items.length,   // 👈 quantidade de contas
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

eventContent: function(arg) {
  let valor = arg.event.title;
  let qtd = arg.event.extendedProps.qtd || 0;

  // container principal do evento
  let wrapper = document.createElement('div');
  wrapper.style.position = 'relative';
  wrapper.style.width = '100%';
  wrapper.style.textAlign = 'center';
  wrapper.style.fontWeight = 'bold';

  // valor no centro
  let valorEl = document.createElement('div');
  valorEl.textContent = valor;
  wrapper.appendChild(valorEl);

  // badge no canto superior direito
  if (qtd > 0) {
    let badgeEl = document.createElement('span');
    badgeEl.className = 'badge bg-success rounded-pill';
    badgeEl.textContent = qtd;

    // posicionamento absoluto no canto superior direito
    badgeEl.style.position = 'absolute';
    badgeEl.style.top = '-12px';
    badgeEl.style.right = '-10px';
    badgeEl.style.fontSize = '0.65rem';
    badgeEl.style.padding = '0.35em 0.45em';

    wrapper.appendChild(badgeEl);
  }

  return { domNodes: [wrapper] };
},

    eventClick: function(info) {
      info.jsEvent.preventDefault(); 
      info.event.setProp("url", 'calendario');

      var items = info.event.extendedProps.items || [];
      listaEventosEl.innerHTML = '';
      if (items.length === 0) {
        listaEventosEl.innerHTML = '<li class="list-group-item">Sem valores</li>';
        detalheDiaEl.innerText = '';
        totalDiaEl.innerText = '';
      } else {
        items.forEach(function(it){
          var li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-start';
          var descricao = it.title || it.descricao || it.nome || 'Item';
          var valorTxt = (typeof it._valorNum === 'number')
            ? it._valorNum.toLocaleString('pt-BR', { minimumFractionDigits: 2 })
            : (it.valor || '0,00');
          li.innerHTML = '<div>' + descricao + '</div><div><b>' + valorTxt + '</b></div>';
          listaEventosEl.appendChild(li);
        });
        var total = info.event.extendedProps.total || 0;
        var dia = info.event.start.getDate();
        detalheDiaEl.innerHTML = 'Detalhes do dia <b>(' + dia +')</b>';
        totalDiaEl.innerText = 'Total do dia: R$ ' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
      }
      detalhesModal.show();
    }
  });

  calendar.render();

  if (clienteSelect) {
    clienteSelect.addEventListener('change', function(){ calendar.refetchEvents(); });
  }
});
