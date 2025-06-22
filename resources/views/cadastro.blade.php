<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Clientes - FinanWise</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <style>
        .form-section {
            width: 100%;
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
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            font-size: 1.1em;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input {
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            border-color: #dff348;
            outline: none;
        }
        /* Estilo para mensagens de erro do backend */
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        /* Estilo para mensagens de erro do JS (frontend) */
        .error-js {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
        }
        .cta-button-entrar {
            background-color: black;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            border-radius: 5px;
            width: 100%;
            font-size: 1.3em;
            transition: 0.3s;
            cursor: pointer;
            border: none;
        }
        .cta-button-entrar:hover {
            background-color: #333;
        }
        header {
            background-color: white;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo {
            font-size: 2.5em;
            font-weight: bold;
            text-decoration: none;
            color: #333;
            text-align: center;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            position: relative;
            display: inline-block;
        }
        .logo::after {
            content: ''; 
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #dff348;
            bottom: -10px;
            left: 0;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2em;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="header-spacer"></div>

    <header>
        <a href="{{ url('/') }}" class="logo">FinanWise</a>
    </header>

    <div class="container" style="padding-top: 120px;">
        <div class="text-section">
            <h1>Cadastro de Cliente</h1>
            <p>Preencha o formulário abaixo para se cadastrar e começar a utilizar nosso sistema de controle financeiro.</p>
        </div>

        {{-- Exibir erros gerais em bloco, se houver --}}
        @if ($errors->any())
        <div class="alert alert-danger" style="max-width:600px; margin: 20px auto; padding: 15px; border-radius: 5px; background-color:#f8d7da; color:#842029; border:1px solid #f5c2c7;">
            <ul style="list-style:none; padding-left:0; margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-section">
            <form id="cadastroForm" action="{{ route('cadastro.store') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
                    @error('nome')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <p class="error-js" id="erro-nome-js">O nome deve ter pelo menos 3 caracteres.</p>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <p class="error-js" id="erro-email-js">Insira um e-mail válido.</p>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" value="{{ old('telefone') }}" required placeholder="(XX) XXXXX-XXXX">
                    @error('telefone')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="position: relative;">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                    <span class="toggle-password" onclick="toggleSenha('senha')">👁</span>
                    @error('senha')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="position: relative;">
                    <label for="confirmar-senha">Confirmar Senha</label>
                    <input type="password" id="confirmar-senha" name="senha_confirmation" required>
                    <span class="toggle-password" onclick="toggleSenha('confirmar-senha')">👁</span>
                    <p class="error-js" id="erro-senha-js">As senhas não coincidem.</p>
                </div>

                <button type="submit" class="cta-button-entrar">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("cadastroForm").addEventListener("submit", function(event) {
            let valid = true;

            const nome = document.getElementById("nome").value.trim();
            const email = document.getElementById("email").value.trim();
            const senha = document.getElementById("senha").value;
            const confirmarSenha = document.getElementById("confirmar-senha").value;

            // Nome
            if (nome.length < 3) {
                document.getElementById("erro-nome-js").style.display = "block";
                valid = false;
            } else {
                document.getElementById("erro-nome-js").style.display = "none";
            }

            // Email básico
            const emailValido = /\S+@\S+\.\S+/;
            if (!emailValido.test(email)) {
                document.getElementById("erro-email-js").style.display = "block";
                valid = false;
            } else {
                document.getElementById("erro-email-js").style.display = "none";
            }

            // Senha confirmação
            if (senha !== confirmarSenha) {
                document.getElementById("erro-senha-js").style.display = "block";
                valid = false;
            } else {
                document.getElementById("erro-senha-js").style.display = "none";
            }

            if (!valid) event.preventDefault();
        });

        function toggleSenha(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
