
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Despesas GA</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ url('css/main.css') }}" rel="stylesheet">
    <link href="{{ url('css/self.css') }}" rel="stylesheet">
    <style>
        .entrada {
            color: green;
        }

        .saida {
            color: red;
        }
    </style>
    <style>
        .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .row [class^="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }

    .form-group {
        width: 100%;
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 15px;
        padding-left: 15px;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection {
        width: 100% !important;
    }
    </style>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registrado com sucesso:', registration);
                })
                .catch(function(error) {
                    console.log('Falha ao registrar o Service Worker:', error);
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('css')
  </head>

  <body class="app sidebar-mini">

        @php
            @session_start();
        @endphp

        @auth
            @include('layouts.header')
            @include('layouts.sidebar')
        @endauth

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>

        <script src="{{ url('js/main.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        @stack('scripts')

    </body>
    <script type="text/javascript">
        var $rows = $('#tabela tr');
        $('#search').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
            }).hide();
        });
    </script>



<!-- Inclua a biblioteca Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script>
    function formatarValor(input) {
        // Obter o valor digitado
        var valor = input.value;

        // Remover todos os caracteres não numéricos
        valor = valor.replace(/[^\d.-]/g, '');

        // Converter para um número
        var numero = parseFloat(valor);

        // Verificar se é um número válido
        if (!isNaN(numero)) {
            // Dividir o número por 100 para mover os dois últimos dígitos para os centavos
            var valorFormatado = (numero / 100).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Definir o valor formatado no campo de entrada
            input.value = valorFormatado;
        }
    }
</script>

<script>
    // Obter a data atual
    var currentDate = new Date().toISOString().split('T')[0];

    // Definir a data atual como valor padrão do campo de entrada
    document.getElementById('data').value = currentDate;
</script>

<script>
    // Obter a data atual
    var currentDate = new Date().toISOString().split('T')[0];

    // Definir a data atual como valor padrão do campo de entrada
    document.getElementById('datafim').value = currentDate;
</script>
</html>
