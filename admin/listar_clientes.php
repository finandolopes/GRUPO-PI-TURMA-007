<?php
// Incluir o arquivo de conexão e as funções de manipulação de clientes
include('../php/conexao.php');
include('../php/funcoes_clientes.php');

// Consultar todos os clientes do banco de dados
$clientes = listarClientes($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFINTER - Painel Administrativo</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.png" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <style>
        body {
            background-color: #fff;
            color: #333;
            padding: 20px;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: transparent;
            color: #333;
            font-weight: bold;
        }

        td {
            vertical-align: middle;
        }

        .btn-container {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            background-color: #0078d4;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

            .btn-action:hover {
                background-color: #005a9e;
            }

        .cardHeader {
            border: none;
            background-color: transparent;
        }

        .page-title {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- =============== Navegação ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <a class="navbar-brand brand-logo-mini" href="admin.php">
                            <img src="assets/imgs/logo2.png" alt="" />
                            </span>
                            <span class="title"></span>
                        </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/listar_clientes.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Listar Clientes</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/consultar_requisicoes.php">
                        <span class="icon">
                            <ion-icon name="trending-up"></ion-icon>
                        </span>
                        <span class="title">Requisições Realizadas</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/admin_depoimentos.php">
                        <span class="icon">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </span>
                        <span class="title">Moderar Depoimentos</span>
                    </a>
                </li>

                <li>
                    <a href="https://login.consigsystem.com.br/">
                        <span class="icon">
                            <ion-icon name="desktop"></ion-icon>
                        </span>
                        <span class="title">Acesso ao ERP</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/gerenciar_usuarios.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Gerenciar Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="../admin/upload_imagens.php">
                        <span class="icon">
                            <ion-icon name="images"></ion-icon>
                        </span>
                        <span class="title">Alterar Slides</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sair</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Principal ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Procure aqui">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="container-scroller">
                    <div class="content-wrapper">
                        <div class="user">
                            <img src="assets/imgs/perfil/1.png" alt="">
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="display: none;">
                                <div class="dropdown-header text-center">
                                    <img class="img-md rounded-circle" src="../assets/img/perfil/1.png" alt="Profile image">
                                    <p class="mb-1 mt-3 font-weight-semibold"><?php echo $usuario['nome']; ?></p>
                                    <p class="fw-light text-muted mb-0"><?php echo $usuario['email']; ?></p>
                                </div>
                                <a class="dropdown-item" href="perfil.php?nome=<?php echo $usuario['nome'] ?? ''; ?>&email=<?php echo $usuario['email'] ?? ''; ?>"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Meu perfil</a>
                                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sair</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ================ Listar Requisições Recentes ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <div class="page-title">
                            <h1>Clientes que entraram em contato</h1>

                            <!-- Tabela para exibir os clientes -->
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($clientes as $cliente): ?>
                                    <tr>
                                        <td><?php echo $cliente['id_cliente']; ?></td>
                                        <td><?php echo $cliente['nome']; ?></td>
                                        <td><?php echo $cliente['email']; ?></td>
                                        <td><?php echo $cliente['telefone']; ?></td>
                                        <td class="btn-container">
                                            <form action="editar_cliente.php" method="GET">
                                                <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
                                                <button type="submit" class="btn-action btn-edit">Editar</button>
                                            </form>
                                            <form action="excluir_cliente.php" method="GET" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                                <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
                                                <button type="submit" class="btn-action btn-delete">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Scripts -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/todolist.js"></script>
    <!-- Adicionando script para inicializar o Datepicker -->
    <script>
        $(document).ready(function () {
            $('.user').on('click', function () {
                $(this).find('.dropdown-menu').toggle();
            });
        });
    </script>
</body>

</html>
