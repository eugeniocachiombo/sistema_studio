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
    <div id="logo-container">
        <div id="logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="80">
            <h1 style="color: black"><b>@include('inclusao.nomesite')</b></h1>
        </div>
        <div id="session-ending">
            <div class="spinner-border spinner-border-sm text-dark" role="status"></div> Terminando a sessão...
        </div>
    </div>

    <script>
        setTimeout(() => {
            window.location = "{{ route('pagina_inicial.') }}";
        }, 5000);
    </script>
</body>

</html>
