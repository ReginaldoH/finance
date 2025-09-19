document.addEventListener('DOMContentLoaded', function() {
  var clienteSelect = document.getElementById('clienteSelect');
  var detalhesModalEl = document.getElementById('detalhesModal');
  var detalhesModal = new bootstrap.Modal(detalhesModalEl);
  var listaEventosEl = document.getElementById('listaEventos');
  var totalDiaEl = document.getElementById('totalDia');

  var calendarEl = document.getElementById('calendar');

  // var url = ""; 
  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    initialView: 'dayGridMonth',
    locale: 'pt-br',
    expandRows: true,        // expande altura das linhas
    dayMaxEvents: false,     // nunca agrupar em "+x mais"
    dayMaxEventRows: false,  // não quebrar em linhas extras
    height: "auto",          // ajusta dinamicamente ao conteúdo
    contentHeight: "auto",
    headerToolbar: {
        right: 'today',
        center: 'title',
        left: 'prev,next'
        // right: 'dayGridMonth,timeGridWeek,listMonth'
    },
    height: 'auto',
    // pegamos os eventos por função para poder agregar no cliente
    events: function(fetchInfo, successCallback, failureCallback) {
      // monta URL com start/end + cliente
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
            tt = String(g.total);
            milharTotal = tt.replace(/,\d+$/, ""); 
            milharTotal = Number(milharTotal)/1000;
            out.push({
              title: (milharTotal.toFixed(1)),
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
      // var div = document.createElement('div');
      // div.className = 'fc-event-title';
      // div.innerText = arg.event.title;
      // return { domNodes: [div] };
      return {html: `<div style="text-align:center; display:flex; justify-content:center;  align-items:center; width:100%;">${arg.event.title}</div>`
          }
    },

    // abrir modal com detalhamento dos itens do dia
    eventClick: function(info) {
       info.jsEvent.preventDefault(); // impede redirecionamento
     info.event.setProp("url", 'calendario');

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
          li.innerHTML = '<div>' + descricao + '</div><div>' + valorTxt + '</div>';
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