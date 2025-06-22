<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trabalhe Conosco - FinanWise</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <style>
        /* Centraliza o conteúdo das vagas */
        .vagas-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            margin-top: 30px;
        }

        .vaga-item {
            width: 60%;
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .vaga-item h3 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #333;
        }

        .vaga-item p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6;
        }

        /* Ajustes de estilo para a seção de vagas */
        #vagas {
            text-align: center;
            padding: 60px 20%;
            background-color: #f9f9f9;
        }

        #vagas h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        #vagas p {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="header-spacer"></div>

    <header>
        <nav>
            <a href="{{ url('/') }}" class="logo">FinanWise</a>
            <ul>
                <li><a href="{{ url('/') }}#conheca-nosso-site">Conheça Nosso Site</a></li>
                <li><a href="{{ url('/') }}#sobre-nos">Sobre Nós</a></li>
                <li><a href="{{ url('/') }}#contato">Suporte</a></li>
            </ul>
            <a href="{{ url('/') }}" class="cta-button-cadastro">Faça o cadastro aqui</a>
        </nav>
    </header>

    <div class="container">
        <div class="text-section">
            <h1><span class="highlight">Junte-se</span> à nossa equipe!</h1>
            <p>
                Se você é apaixonado por tecnologia e deseja contribuir com soluções inovadoras
                para facilitar a gestão financeira, temos uma vaga para você! Faça parte do time da FinanWise e ajude
                a transformar a vida de nossos usuários.
            </p>
        </div>
    </div>

    <section class="info-text" id="trabalhe-conosco">
        <div class="info-content">
            <div class="text-part">
                <h2>Por que trabalhar na <span class="highlight">FinanWise?</span></h2>
                <p>Na FinanWise, acreditamos que um bom ambiente de trabalho é a chave para o sucesso. Oferecemos uma cultura inclusiva, colaborativa e inovadora, onde todos têm espaço para crescer, aprender e impactar diretamente os nossos usuários.</p>
                <p><strong>Se você busca desenvolvimento profissional, desafios empolgantes e a chance de trabalhar com uma equipe talentosa,</strong> aqui é o seu lugar!</p>
            </div>
        </div>
    </section>

    <section class="info-text" id="vagas">
        <h2>Vagas Disponíveis</h2>
        <p>Confira as vagas abertas e envie sua candidatura para a posição que mais combina com o seu perfil:</p>
        <div class="vagas-list">
            <div class="vaga-item">
                <h3>Desenvolvedor Front-end</h3>
                <p>Responsável pela criação e manutenção da interface do usuário. É necessário ter experiência com HTML, CSS, JavaScript e frameworks modernos de front-end.</p>
            </div>
            <div class="vaga-item">
                <h3>Desenvolvedor Back-end</h3>
                <p>Focado no desenvolvimento da lógica e integração do sistema. É necessário ter experiência com linguagens como Java, Node.js, Python e banco de dados relacionais.</p>
            </div>
            <div class="vaga-item">
                <h3>Designer UX/UI</h3>
                <p>Criar experiências intuitivas para os usuários da nossa plataforma. É necessário ter experiência com ferramentas de design e prototipação, além de uma forte visão de usabilidade.</p>
            </div>
        </div>
    </section>

    <section class="info-text" id="enviar-curriculo">
        <h2>Como Enviar Seu Currículo</h2>
        <p>Para se candidatar, envie seu currículo atualizado para o nosso e-mail <strong>recrutamento@controlefinanceiro.com</strong>. Não se esqueça de incluir uma breve carta de apresentação!</p>
    </section>

    <footer>
        <div class="footer-links">
            <a href="{{ url('/') }}#trabalhe-conosco">Trabalhe Conosco</a>
            <a href="{{ url('/sugestoes') }}">Sugestões ou Reclamações</a>
        </div>
    </footer>
</body>
</html>
