<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Financeiro</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="header-spacer"></div>

    {{-- Componente Blade do Header --}}
    <x-header />

    <div class="container">
        <div class="text-section">
            <h1>Controle <span class="highlight">financeiro</span> <span class="highlight">descomplicado</span> para sua
                vida.</h1>
            <p>
                Organize a gestão financeira da sua vida e de quebra
                <strong>tenha mais tempo para se dedicar no que você faz de melhor.</strong>
            </p>
            <a href="{{ url('/login') }}" class="cta-button-entrar">Entre Aqui</a>
        </div>
        <div class="image-section">
            <img src="{{ asset('images/img_index.jfif') }}" alt="Imagem do aplicativo" />
        </div>
    </div>

    <section class="info-text" id="conheca-nosso-site">
        <div class="info-content">
            <div class="text-part">
                <h2>Conheça <span class="highlight">Nosso</span> Site</h2>
                <p>Nosso site foi criado para oferecer uma experiência simples e eficiente na gestão financeira do seu
                    negócio. Com uma interface intuitiva e funcionalidades práticas, nossa plataforma permite que você
                    acompanhe suas receitas e despesas de forma organizada, garantindo mais controle e previsibilidade
                    para sua empresa.</p>
                <p><strong>Acreditamos que a tecnologia deve facilitar a sua rotina,</strong> e não complicá-la. Por
                    isso, desenvolvemos um sistema acessível, onde você pode visualizar relatórios detalhados, analisar
                    seu fluxo de caixa e tomar decisões estratégicas com base em dados reais.</p>
            </div>
            <div class="image-part">
                <img src="{{ asset('images/mais.png') }}" alt="Demonstração do Aplicativo">
            </div>
        </div>
    </section>

    <section class="info-text" id="sobre-nos">
        <h2>Sobre Nós</h2>
        <p>Somos um time apaixonado por tecnologia e inovação, com a missão de tornar a gestão financeira mais acessível
            e descomplicada para empresas de todos os tamanhos. Nossa jornada começou ao percebermos um problema comum
            entre empreendedores: a dificuldade em organizar as finanças de forma eficiente, sem perder tempo com
            processos burocráticos e complicados.</p>
        <p>Nosso compromisso vai além de oferecer um sistema eficiente — queremos construir uma comunidade de
            empreendedores que enxergam a gestão financeira como um aliado estratégico para o crescimento de seus
            negócios.</p>
    </section>

    <section class="info-text" id="contato">
        <h2>Contato</h2>
        <p>
            Para suporte, entre em contato conosco pelo <strong>Email:</strong> finanwide@gmail.com,
            pelo <strong>Telefone:</strong> (11) 1234-5678 ou pelo <strong>WhatsApp:</strong> (11) 98765-4321.
        </p>
    </section>

    <x-footer-links />
</body>

</html>