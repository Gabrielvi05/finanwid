<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugestões ou Reclamações - FinanWise</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .feedback-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 1em;
            color: #333;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .form-group textarea {
            resize: vertical;
        }

        .cta-button-cadastro {
            background-color: black;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            align-self: flex-start;
            font-size: 1.2em;
            width: auto;
            border: none;
            cursor: pointer;
        }

        .cta-button-cadastro:hover {
            background-color: #333;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .feedback-form {
                padding: 15px;
                width: 100%;
            }

            .form-group input,
            .form-group textarea {
                font-size: 1.1em;
            }
        }

        /* Mensagem de sucesso */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            padding: 15px;
            max-width: 600px;
            margin: 20px auto;
            font-weight: bold;
            text-align: center;
        }

        /* Erro simples */
        .error-text {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header-spacer"></div>

    <header>
        <nav>
            <a href="{{ url('/') }}" class="logo">FinanWise</a>
            <ul>
                <li><a href="{{ url('/#conheca-nosso-site') }}">Conheça Nosso Site</a></li>
                <li><a href="{{ url('/#sobre-nos') }}">Sobre Nós</a></li>
                <li><a href="{{ url('/#contato') }}">Suporte</a></li>
            </ul>
            <a href="{{ route('cadastro') }}" class="cta-button-cadastro">Faça o cadastro aqui</a>
        </nav>
    </header>

    <div class="container">

        {{-- MENSAGEM DE SUCESSO --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-section">
            <h1>Envie suas <span class="highlight">Sugestões</span> ou <span class="highlight">Reclamações</span></h1>
            <p>
                Seu feedback é muito importante para nós! Se você tiver alguma sugestão ou reclamação, 
                por favor, preencha o formulário abaixo. Estamos sempre dispostos a ouvir você e melhorar 
                nossos serviços.
            </p>
        </div>
    </div>

    <section class="info-text" id="sugestoes-reclamacoes">
        <div class="info-content">
            <div class="text-part">
                <h2>Formulário de Sugestões e Reclamações</h2>
                <p>Por favor, preencha o formulário com seus dados e sua mensagem. Vamos analisar com carinho e buscar a melhor solução para o seu caso.</p>

                <form action="{{ route('sugestoes.enviar') }}" method="POST" class="feedback-form">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Seu nome" required value="{{ old('nome') }}">
                        @error('nome')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Seu email" required value="{{ old('email') }}">
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea id="mensagem" name="mensagem" rows="5" placeholder="Digite sua sugestão ou reclamação" required>{{ old('mensagem') }}</textarea>
                        @error('mensagem')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="cta-button-cadastro">Enviar</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-links">
            <a href="{{ route('trabalhe') }}">Trabalhe Conosco</a>
            <a href="{{ route('sugestoes') }}">Sugestões ou Reclamações</a>
        </div>
    </footer>
</body>
</html>
