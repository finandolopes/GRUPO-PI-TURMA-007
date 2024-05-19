<?php
session_start();
include_once('php/conexao.php');

// Verificar se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('php/processa_login.php');
}
// Consulta ao banco de dados para recuperar as imagens do carrossel
$sql = "SELECT * FROM imagens_carrossel";
$result = mysqli_query($conexao, $sql);


// Verificar se a variável de sessão sucesso_depoimento está definida
if (isset($_SESSION['sucesso_depoimento']) && $_SESSION['sucesso_depoimento']) {
    // Exibir a mensagem de sucesso
    echo "<p class='text-success'>Depoimento enviado com sucesso!</p>";
    // Remover a variável de sessão para que a mensagem não seja exibida novamente após o próximo carregamento da página
    unset($_SESSION['sucesso_depoimento']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CONFINTER | Consolidando sonhos</title>
    <meta name="description" content="Consolidando sonhos">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="lib/nivo-slider/css/nivo-slider.min.css" rel="stylesheet">
    <link href="lib/nivo-slider/css/nivo-slider-theme.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.transitions.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/venobox/venobox.min.css" rel="stylesheet">
    <!-- Inclua o CSS do Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Inclua jQuery e o JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            // Remover a máscara de data antes de enviar o formulário
            $('#form-requisicao').submit(function () {
                // Remover a máscara de data antes de enviar o formulário
                var dataNascimento = $('#data_nascimento').val();
                // Remover qualquer caractere que não seja número
                var dataLimpa = dataNascimento.replace(/\D/g, '');
                // Formatar a data para o padrão YYYY-MM-DD
                var dataFormatada = dataLimpa.replace(/(\d{2})(\d{2})(\d{4})/, '$3-$2-$1');
                // Atribuir a data formatada de volta ao campo
                $('#data_nascimento').val(dataFormatada);
            });
        });
    </script>


    <!-- Script JavaScript para validar o formulário -->
    <script>
        $(document).ready(function () {
            // Função para validar o formulário antes do envio
            $('#form-requisicao').submit(function (event) {
                // Verifica se o campo nome está vazio
                if ($('#nome').val().trim() === '') {
                    alert('Por favor, preencha o campo nome.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Verifica se o campo data de nascimento está vazio
                //  if ($('#data_nascimento').val().trim() === '') {
                //     alert('Por favor, preencha o campo data de nascimento.');
                //     event.preventDefault(); // Impede o envio do formulário
                //     return;
                //  }

                // Verifica se o campo telefone está vazio
                if ($('#telefone').val().trim() === '') {
                    alert('Por favor, preencha o campo telefone.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Verifica se o campo email está vazio
                if ($('#email').val().trim() === '') {
                    alert('Por favor, preencha o campo email.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Verifica se o campo horário de contato está vazio
                if ($('#horario_contato').val().trim() === '') {
                    alert('Por favor, preencha o campo horário de contato.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }

                // Verifica se pelo menos uma opção de categoria foi selecionada
                if ($('input[name="categoria[]"]:checked').length === 0) {
                    alert('Por favor, selecione pelo menos uma categoria.');
                    event.preventDefault(); // Impede o envio do formulário
                    return;
                }
            });
        });
    </script>
    <script>
        // Função para exibir o campo "Outros" quando a opção é selecionada
        document.addEventListener('DOMContentLoaded', function () {
            var outrosCheckbox = document.getElementById('outros_check');
            var outrosInfoDiv = document.getElementById('outros_info_div');

            outrosCheckbox.addEventListener('change', function () {
                if (outrosCheckbox.checked) {
                    outrosInfoDiv.style.display = 'block';
                } else {
                    outrosInfoDiv.style.display = 'none';
                }
            });

            // Verifica se pelo menos uma categoria foi selecionada antes de enviar o formulário
            var form = document.getElementById('form-requisicao');
            form.addEventListener('submit', function (event) {
                var checkboxes = document.querySelectorAll('input[name="categoria[]"]');
                var isChecked = false;
                checkboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        isChecked = true;
                    }
                });
                if (!isChecked) {
                    alert('Por favor, selecione pelo menos uma categoria.');
                    event.preventDefault(); // Impede o envio do formulário
                }
            });
        });
    </script>


    </script>
    <script>
        $(document).ready(function () {
            // Máscara para data (DD/MM/AAAA)
            //  $('#data_nascimento').mask('00/00/0000');

            // Máscara para hora (HH:MM)
            $('#horario_contato').mask('00:00');

            $(document).ready(function () {
                // Máscara para telefone
                $('#telefone').mask('(00) 00000-0000');
            });

            // Máscara para e-mail
            $('#email').mask('A', {
                translation: {
                    'A': { pattern: /[\w@\-.+]/, recursive: true }
                }
            });

            // Validação do formulário
            $('#modalForm').submit(function (event) {
                // Limpar mensagens de erro
                $('.error-msg').remove();

                // Flag para validação
                var isValid = true;

                // Validar nome
                var nome = $('#nome').val();
                if (!nome.trim()) {
                    $('#nome').after('<div class="error-msg">Por favor, preencha o nome.</div>');
                    isValid = false;
                }

                // Validar data de nascimento
                var dataNascimento = $('#data_nascimento').val();
                if (!dataNascimento.trim()) {
                    $('#data_nascimento').after('<div class="error-msg">Por favor, preencha a data de nascimento.</div>');
                    isValid = false;
                }

                // Validar telefone
                var telefone = $('#telefone').val();
                if (!telefone.trim()) {
                    $('#telefone').after('<div class="error-msg">Por favor, preencha o telefone.</div>');
                    isValid = false;
                }

                // Validar e-mail
                var email = $('#email').val();
                if (!email.trim()) {
                    $('#email').after('<div class="error-msg">Por favor, preencha o e-mail.</div>');
                    isValid = false;
                } else if (!isValidEmail(email)) {
                    $('#email').after('<div class="error-msg">Por favor, preencha um e-mail válido.</div>');
                    isValid = false;
                }

                // Validar horário de contato
                var horarioContato = $('#horario_contato').val();
                if (!horarioContato.trim()) {
                    $('#horario_contato').after('<div class="error-msg">Por favor, preencha o horário de contato.</div>');
                    isValid = false;
                }

                // Validar categoria
                var categoria = $('#categoria').val();
                if (!categoria.trim()) {
                    $('#categoria').after('<div class="error-msg">Por favor, selecione a categoria.</div>');
                    isValid = false;
                }

                // Se algum campo estiver inválido, impedir o envio do formulário
                if (!isValid) {
                    event.preventDefault();
                    $('#modalAlert').addClass('alert alert-danger').html('Por favor, corrija os campos destacados.');
                }
            });

            // Função para verificar se o e-mail é válido
            function isValidEmail(email) {
                var pattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
                return pattern.test(email);
            }
        });

    </script>   
    </head>
<div class="floating-buttons">
    <a href="https://www.instagram.com/confintersp?igsh=a3NuaGJrem5pYzZu" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
    <a href="https://api.whatsapp.com/send?phone=11948016298" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
    <a href="mailto:contato@confinter.com.br" class="email"><i class="bi bi-envelope-at"></i></i></a>
</div>
<body>

    <!-- ======= Inicio Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <!--<h1 class="logo"><a href="index.html">CONFINTER</a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#sobre">Sobre</a></li>
                    <li><a class="nav-link scrollto" href="#valores">Nossos Valores</a></li>
                    <li><a class="nav-link scrollto" href="#servicos">Serviços</a></li>
                    <li><a class="nav-link scrollto" href="#requi">Requisições</a></li>
                    <li><a class="nav-link scrollto" href="#faq">Dúvidas</a></li>
                    <li><a class="nav-link scrollto" href="#depoimentos">Depoimentos</a></li>
                    <li><a class="nav-link scrollto" href="#chegar">Como Chegar</a></li>
                    <a class="page-scroll" href="#" data-toggle="modal" data-target="#loginModal">Login</a> 
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- Fim do Header -->
    <!-- Modal Login -->
    <div id="loginModal" class="modal fade modal-login" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="php/processa_login.php" method="POST">
                                <div class="form-group">
                                    <label for="user">Usuário:</label>
                                    <input type="text" class="form-control" id="user" name="usuario">
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha:</label>
                                    <input type="password" class="form-control" id="senha" name="senha">
                                </div>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <img src="assets/img/logo01-black.png" alt="Imagem de Login" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="hero">
        <!-- ======= Incio Slides ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="full-site w-100">
        <div id="home" class="slider-area w-100">
            <div class="bend niceties preview-2 w-100">
                <div id="ensign-nivoslider" class="slides">
                        <?php
                        $diretorio = "assets/img/slider/";
                        $imagens = glob($diretorio . "*.{jpg,png,gif}", GLOB_BRACE);
                        foreach ($imagens as $imagem) {
                        echo '<img src="' . $imagem . '" alt="slider" />';
                        }
                        ?>
                    </div>
                    <div id="slider-direction-1" class="slider-direction slider-one">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slider-content">
                                        <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                                            <h2 class="title1"></h2>
                                        </div>
                                        <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                            <h1 class="title2"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-2" class="slider-direction slider-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slider-content text-center">
                                        <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                            <div class="container">
                                                <h2 class="animate__animated animate__fadeInDown">Experiência no Mercado</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-3" class="slider-direction slider-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slider-content">
                                        <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                            <div class="container">
                                                <p class="animate__animated animate__fadeInUp">Transparência e Credibilidade</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-4" class="slider-direction slider-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slider-content">
                                        <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                            <div class="container">
                                                <p class="animate__animated animate__fadeInUp">Foco no Resultado</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-5" class="slider-direction slider-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slider-content">
                                        <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                            <div class="container">
                                                <p class="animate__animated animate__fadeInUp">Alcançar Objetivos</p>
                                                <p class="animate__animated animate__fadeInUp">Alcançar Objetivos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- Fim Slides -->

    <main id="main">

        <!-- ======= Seção Sobre ======= -->
        <section id="sobre" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-headline text-center">
                    <h2 class="br">Sobre Nós</h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="well-middle">
                                <div class="single-well">
                                    <span class="br minor-title-about"></span>
                                    <h4 class="about-content">
                                        <div class="br">
                                            A <strong>CONFINTER</strong> é uma empresa especializada em Consultoria Financeira e Correspondente Bancária que atua na intermediação de negócios, presencialmente e online.
                                        </div>
                                    </h4>
                                    <h4 class="about-content">
                                        <div class="br">
                                            Seguimos as diretrizes do Banco Central do Brasil, nos termos da Resolução no 3.954/2011. Nosso procedimento de avaliação de crédito é submetido à política de crédito da Instituição
                                            Financeira escolhida pelo usuário e está submetida a aprovação.
                                        </div>
                                    </h4>
                                    <h4 class="about-content">
                                        <div class="br">
                                            Antes da contratação de qualquer serviço através de nossos parceiros e consultores, você receberá todas as condições e informações relativas à linha
                                            de crédito a ser contratada, de forma completa e transparente.
                                        </div>
                                    </h4>
                                    <br /><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- Fim da Seção Sobre -->
        <!-- ======= Missão, Visão e Valores ======= -->
        <section id="valores" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-headline text-center">
                    <h2 class="br">Nossos Valores</h2>
                    <p></p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box iconbox-blue">
                            <div class="icon">
                                
                                <img src="assets/img/missao.png" alt="missao">
                            </div>
                            <h4><a href=""></a></h4>
                            <p>Facilitar o acesso a crédito consignado e fornecer consultoria financeira personalizada, visando o equilíbrio e bem-estar financeiro dos nossos clientes.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box iconbox-orange ">
                            <div class="icon">                            
                                <img src="assets/img/visao.png" alt="visao">
                            </div>
                            <h4><a href=""></a></h4>
                            <p>
                                Ser reconhecida como a empresa líder  em intermediação de negócios, destacando-se pela excelência no atendimento ao cliente e pela construção de relacionamentos sólidos e duradouros.
                            </p><br>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box iconbox-pink">
                            <div class="icon">
                                <img src="assets/img/valores.png" alt="valores">
                            </div>
                            <h4><a href=""></a></h4>
                            <p>
                                <strong>Transparência:</strong> Agimos com total transparência em nossas operações e informações, promovendo a confiança mútua.<br>
                                <strong>Comprometimento Personalizado:</strong> Nos dedicamos a entender as necessidades individuais de cada cliente, oferecendo soluções financeiras.<br>
                                <strong>Respeito e Empatia:</strong> Valorizamos a diversidade e tratamos todos com respeito e empatia, construindo relações duradouras.<br>
                                <strong>Sustentabilidade Financeira:</strong> Comprometemo-nos a promover práticas financeiras sustentáveis, visando o bem-estar financeiro a longo prazo de nossos clientes.<br>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- Fim da Seção Missão, Visão e Valores -->

        <style>
            .icon-large {
                font-size: 2em; /* Ajuste este valor para o tamanho desejado */
            }
        </style>
        <div id="serviços" class="services-area area-padding">
            <!-- ======= Serviços ======= -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2 class="br">Nossos Serviços</h2>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <!-- Inicio Serviços -->
                        <div class="about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <a class="services-icon" href="#">
                                        <i class="bi bi-briefcase"></i>
                                    </a>
                                    <h4>Consultoria</h4>
                                    <p>
                                        Nossos especialistas ajudarão desde a abertura de contas até delinear a melhor estratégia para os diferentes mercados financeiros.
                                    </p>
                                </div>
                            </div><!-- Fim Detalhes Sobre -->
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <a class="services-icon" href="#">
                                        <i class="bi bi-person-vcard-fill"></i>
                                    </a>
                                    <h4>Intermediação de Negócios</h4>
                                    <p>
                                        Atuando como correspondentes bancários com mais de 15 anos de experiência. Parceria com os principais bancos e financeiras de crédito consignado no país.
                                    </p>
                                </div>
                            </div><!-- Fim Detalhes Sobre -->
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class=" about-move">
                            <!-- fim col-md-3 -->
                            <div class="services-details">
                                <div class="single-services">
                                    <a class="services-icon" href="#">
                                        <i class="bi bi-credit-card"></i>
                                    </a>
                                    <h4>Cartões de Crédito Consignado</h4>
                                    <p>
                                        Conveniado com os principais bancos, ao todo são mais de 250 convênios ativos em Governos, Prefeituras e para aposentados e pensionistas do INSS.
                                    </p>
                                </div>
                            </div><!-- fim dos detalhes do sobre -->
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <!-- fim col-md-3 -->
                        <div class=" about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <a class="services-icon" href="#">
                                        <i class="bi bi-cash-coin"></i>
                                    </a>
                                    <h4>Saque Aniversário FGTS</h4>
                                    <p>
                                        No saque-aniversário você pode sacar o valor que possui em FGTS com taxas a partir de 1.29% a.m..
                                    </p>
                                </div>
                            </div><!-- fim dos detalhes do sobre -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fim da Seção de serviços -->
        <div id="requi" class="requisicoes section-bg"></div>

        <div id="requi" class="requisicoes section-bg"></div>

        <div class="container">
            <div class="row">
                <!-- Coluna 1: Requisição de Análise de Crédito -->
                <div class="col-md-5">
                    <section id="requi" class="requisicoes section-bg">
                        <div class="container">
                            <div class="row align-items-stretch">
                                <!-- Conteúdo da Requisição de Análise de Crédito -->
                                <div class="section-headline text-center">
                                    <h2 class="br">Requisição de Análise de Crédito</h2>
                                    <p></p>
                                </div>
                                <div class="formulario-modal" id="requisicaoForm">
                                    <form action="php/process.php" method="POST" id="form-requisicao">
                                        <div class="form-group">
                                            <input type="text" class="br form-control" id="nome" name="nome" placeholder="Nome completo" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="data_nascimento">Data Nascimento:</label>
                                                <input type="date" class="br form-control" id="data_nascimento" placeholder="Data de Nascimento:" name="data_nascimento" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="telefone">Telefone:</label>
                                                <input type="tel" class="br form-control" id="telefone" name="telefone" placeholder="Telefone" required maxlength="15">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">E-mail:</label>
                                                <input type="email" class="br form-control" id="email" name="email" placeholder="Digite seu E-mail" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="horario_contato">Horário para Contato:</label>
                                            <div class="input-group">
                                                <input type="time" class="br form-control" id="horario_contato" name="horario_contato" required>
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo" class="text-left">Tipo:</label>
                                            <textarea class="br form-control" id="tipo" name="tipo" rows="3" maxlength="250"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Categoria:</label><br>
                                            <div class="form-row">
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" id="aposentado" name="categoria[]" value="Aposentado">
                                                    <label class="form-check-label" for="aposentado">Aposentado</label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" id="pensionista" name="categoria[]" value="Pensionista">
                                                    <label class="form-check-label" for="pensionista">Pensionista</label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" id="servidor_publico" name="categoria[]" value="Servidor Público">
                                                    <label class="form-check-label" for="servidor_publico">Servidor Público</label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" id="outros_check" name="categoria[]" value="Outros">
                                                    <label class="form-check-label" for="outros_check">Outros</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="outros_info_div" style="display: none;">
                                            <label for="outros_info">Insira outras informações se necessário:</label>
                                            <input type="text" class="br form-control" id="outros_info" name="outros_info" rows="3" maxlength="200">
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <div class="br">Enviar Requisição</div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
    
                <!-- Coluna 2: Dúvidas Frequentes -->
                <div class="col-md-7">
                    <section id="faq" class="faq section-bg">
                        <div class="container" data-aos="fade-up">
                            <div class="section-headline text-center">
                                <h2 class="br">Dúvidas Frequentes</h2>
                            </div>
                            <div class="faq-list" style="font-size: 14px; height: 100%;">
                                <ul>
                                    <!-- Perguntas frequentes -->
                                    <li data-aos="fade-up">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#check1" style="width: 100%;">Em que área a empresa opera? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check1" class="collapse show" data-bs-parent=".faq-list">
                                            <p>
                                                Operamos como prestadores de serviços, há mais de 15 anos nas áreas de Crédito Consignado, Intermediação de Negócios, Consultoria Financeira e Cobranças.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="100">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check2" class="collapsed" style="width: 100%;">Porquê escolher a CONFINTER? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check2" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                Você terá um atendimento rápido e prático em todo território nacional. Nossos profissionais são dinâmicos e altamente qualificados, oferecendo suporte eficiente, soluções práticas com foco em resultados.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="300">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check3" class="collapsed" style="width: 100%;">O que é empréstimo consignado? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check3" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                O consignado é uma modalidade de crédito em que os pagamentos são descontados automaticamente do salário do servidor ou do benefício do INSS do tomador. Por conta dessa dinâmica, a taxa de inadimplência é baixa e o risco para os bancos muito pequeno, e é isso que faz com que o crédito consignado tenha uma das menores taxas do mercado.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check4" class="collapsed" style="width: 100%;">Quem pode solicitar crédito consignado? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check4" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                Aqui na CONFINTER, o crédito consignado está disponível para alguns públicos, entre eles: Beneficiário do INSS (BPC/LOAS), Servidores Públicos Municipais, Estaduais e Federais do SIAPE, Militares das Forças Armadas e Aposentados e Pensionistas do INSS.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check5" class="collapsed" style="width: 100%;">Quais são as taxas de juros? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check5" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                Oferecemos Empréstimo Consignado com taxas personalizadas que podem variar dependendo do tipo de convênio, operação, prazo, valor solicitado e perfil do cliente. As taxas de juros máximas são de 1.72% ao mês no empréstimo consignado para aposentado e/ou pensionista do INSS e Beneficiário do INSS (BPC/LOAS); e para Servidores Públicos à partir de 1.93% ao mês.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check6" class="collapsed" style="width: 100%;">Como é feita a análise de crédito? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check6" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                Prezando sempre pela saúde financeira, optamos pelas melhores estratégias de acordo com a gama de bancos parceiros e financeiras, buscando o melhor custo-benefício para nossos clientes.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check7" class="collapsed" style="width: 100%;">Como a CONFINTER pode me ajudar hoje? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check7" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                A CONFINTER atua também como Correspondente Digital autorizado pelo Banco Central e pode intermediar operações de crédito ajudando você, consumidor, a escolher as melhores opções de crédito disponíveis para seu perfil. Conosco, você não precisa sair de casa ou do trabalho perdendo tempo indo até o banco, enfrentando filas e burocracia! Nós fazemos todo o processo e acompanhamos o seu caso, digitalmente até a liberação do crédito em conta.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#check8" class="collapsed" style="width: 100%;">Como faço para assinar o meu contrato? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="check8" class="collapse" data-bs-parent=".faq-list">
                                            <p>
                                                A assinatura é de forma digital, podendo ser enviado um link por WhatsApp ou SMS, enviado para o seu número de celular informado no formulário. A maioria dos bancos exigem: • o envio do documento de identidade; • o aceite (SIM) na CCB: essa etapa o cliente verifica se todas as condições contratadas e precisa dar o aceite para seguir para a assinatura; • tirar uma selfie (foto de si mesmo) que é a etapa de assinatura digital do cliente; Entretanto, essa modalidade pode variar de acordo com as exigências de cada Instituição Financeira.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>        

        <!-- ======= Seção Enviar Depoimentos ======= -->
        <section id="envdepoimentos" class="testimonials">
        <div class="container-fluid container-center">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-8 col-xs-12 text-center">
                    <div class="section-headline text-center">
                        <h2 class="br">Enviar Depoimento</h2>
                    </div>
                    <!-- Adicionando um identificador único ao formulário -->
                    <form id="form-depoimento" action="php/enviar_depoimento.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="nome" class="br form-control" id="nome" placeholder="Insira o nome, em branco enviará como Anônimo" data-rule="minlen:4" data-msg="" />
                            <div class="br validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="br form-control" name="mensagem" rows="5" data-rule="required" data-msg="Por favor escreva algo para nós" placeholder="Mensagem"></textarea>
                            <!-- Adicionando um identificador único ao elemento onde a mensagem de erro será exibida -->
                            <div id="erro-mensagem" class="text-danger">
                                <?php
                                // Verificar se a variável de sessão erro_mensagem está definida
                                if (isset($_SESSION['erro_mensagem'])) {
                                    // Exibir a mensagem de erro
                                    echo $_SESSION['erro_mensagem'];
                                    // Remover a variável de sessão para que a mensagem não seja exibida novamente após atualizar a página
                                    unset($_SESSION['erro_mensagem']);
                                }
                                ?>
                            </div>
                            <div class="br validation"></div>
                            <div class="en validation"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar Depoimento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Fim Item Depoimentos -->
        <script>
    window.onload = function() {
        // Verificar se a URL contém o parâmetro de erro
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('erro')) {
            // Rolar a página até a mensagem de erro
            const erroMensagem = document.getElementById('erro-mensagem');
            if (erroMensagem) {
                erroMensagem.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    };
</script>

       <!-- ======= Seção Depoimentos ======= -->
<section id="depoimentos" class="testimonials">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Depoimentos</h2>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <?php
                $sql = "SELECT nome, mensagem FROM depoimentos WHERE status_mod = 'aprovado'";
                $result = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nome = $row['nome'] ? $row['nome'] : "Anônimo";
                        $mensagem = $row['mensagem'];
                ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <?php echo $mensagem; ?>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <h3><?php echo $nome; ?></h3>
                            </div>
                        </div><!-- Fim Item Depoimentos -->
                <?php
                    }
                } else {
                    echo "<div class='swiper-slide'><div class='testimonial-item'><p>Nenhum depoimento aprovado disponível.</p></div></div>";
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- Fim Seção Depoimentos -->

        <!-- ======= Seção Contato ======= -->
        <section id="chegar" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-headline text-center">
                    <h2 class="br">Contato</h2>                  
                </div>

                <div>
                    <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.674620432733!2d-46.34657878502169!3d-23.529135784679013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce43de0d92a6f5%3A0x8f85eeb0c19e3c32!2sMarina%20La%20Regina!5e0!3m2!1sen!2sus!4v1648523258379!5m2!1sen!2sus&hl=pt-BR" frameborder="0" allowfullscreen></iframe>                    
                </div>

                <div class="row mt-5">
                    
                        </div>

                    </div>
                   
        </section><!-- Fim da Seção de Contato -->

    </main><!-- Fim #main -->

    <!-- ======= Inicio do Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
			    <img src="assets/img/logo01-black.png" alt="logo" width="125px">
                       <h4 class="br">Consultoria Financeira<br /><spam class="number-sequence">CNPJ: 11.727.809.0001/36</spam></h4>
                       <h5 class="br">Especialista em corretagem, consultoria, intermediação<br />e mediação de negócios financeiros.</h5>
                        
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Links Úteis</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#sobre">Sobre</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#valores">Nossos Valores</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#servicos">Serviços</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#requi">Requisições</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#faq">Dúvidas</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#depoimentos">Depoimentos</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#chegar">Como Chegar</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4></h4>
                        <ul>
                            <li><i class="bx bx-phone-outgoing"></i> <a href="#">(11)94801-6298</a></li>
                            <li><i class="bx bx-mail-send"></i> <a href="#">contato@confinter.com.br</a></li>                                                  
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Para Informações</h4>
                        <p>Cadastre seu E-mail</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input class="btn-primary" type="submit" value="Inscreva-se">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Confinter 2024</span></strong>. Todos Direitos Reservados.
                </div>
                <div class="credits">
                    Desenvolvido por <a href="https://github.com/finandolopes/DRP01-PJI110-SALA-007GRUPO-017/tree/main">DRP01-PJI110-SALA-007GRUPO-017</a> com <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>            
        </div>
    </footer><!-- Fim Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/venobox/venobox.min.js"></script>
    <!-- <script src="lib/parallax/parallax.min.js"></script>-->
    <script src="lib/nivo-slider/js/jquery.nivo.slider.min.js" type="text/javascript"></script>
    <!--<script src="lib/isotope/isotope.pkgd.min.js"></script> -->


    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

<!-- Initialize Nivo Slider -->
<script>
$(window).on('load', function() {
    $('#ensign-nivoslider').nivoSlider();
});
</script>
</body>

</html>
