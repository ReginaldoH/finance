// Executar quando o documento HTML for completamente carregado
document.addEventListener('DOMContentLoaded', function() {

    // Receber o SELETOR calendar do atributo id
    var calendarEl = document.getElementById('calendar');

    // Instanciar FullCalendar.Calendar e atribuir a variável calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {

        // Incluir o bootstrap 5
        themeSystem: 'bootstrap5',

        // Criar o cabeçalho do calendário
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        // Definir o idioma usado no calendário
        locale: 'pt-br',

        // Definir a data inicial
        //initialDate: '2023-01-12',
        //initialDate: '2023-10-12',
        expandRows: true,        // expande altura das linhas
        dayMaxEvents: false,     // nunca agrupar em "+x mais"
        dayMaxEventRows: false,  // não quebrar em linhas extras
        height: "auto",          // ajusta dinamicamente ao conteúdo
        contentHeight: "auto",

        // Permitir clicar nos nomes dos dias da semana 
        navLinks: true, 

        // Permitir clicar e arrastar o mouse sobre um ou vários dias no calendário
        selectable: true,

        // Indicar visualmente a área que será selecionada antes que o usuário solte o botão do mouse para confirmar a seleção
        selectMirror: true,

        // Permitir arrastar e redimensionar os eventos diretamente no calendário.
        editable: true,

        events: '../painel/paginas/calendario/eventos.php'
    });

    calendar.render();
});



//  events: '../painel/paginas/calendario/eventos.php'