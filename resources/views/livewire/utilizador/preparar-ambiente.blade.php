<html lang="pt-BR">

<head>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        #logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #logo img {
            display: block;
            margin: 0 auto;
        }

        #logo {
            animation: heartbeat 0.5s infinite alternate, opacityPulse 2s infinite alternate;
        }

        @keyframes heartbeat {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        @keyframes opacityPulse {
            from {
                opacity: 1;
            }

            to {
                opacity: 0.5;
            }
        }

        #session-ending {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="logo-container d-none">
        <div id="logo">
            <img class="d-none" src="{{ asset('assets/img/logo.png') }}" alt="logo" style="object-fit: cover" width="150px">
        </div>
        <div id="session-ending">
            <div class="spinner-border spinner-border-sm text-dark" role="status"></div>
            <b>Iniciando:</b> Por favor Aguarde...
        </div>
    </div>

    @php
        $texto = "Olá, " . session("utilizador") . " estamos a preparar o ambiente. Por favor aguarde.";
    @endphp

    <script>
        /*const synthesis = window.speechSynthesis;
        const utterance = new SpeechSynthesisUtterance('<?php echo $texto; ?>');
        synthesis.speak(utterance); */

        setTimeout(() => {
            window.location = "{{ route('pagina_inicial.') }}";
        }, 4000);
    </script>
</body>

</html>
