<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Cursos</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/js/script.js" defer></script>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="logo">
            <h2>LEO</h2>
        </div>
        <nav>
        <div class="campo-busca">
                <div class="input-container">
                    <input type="text" id="courseSearch" placeholder="Pesquisar curso...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <ul id="searchResults" style="display:none;"></ul>
            </div>

            <div class="user-info">
                <img src="../public/images/perfil.webp" alt="Usuário">
            </div>

            <div class="user-info2">
                <span class="bem2">Seja bem-vindo</span><br>
                <span class="nome2">John Doe</span>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Dinâmico -->
    <main>
        <div class="container">
            <?= $content; ?>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="footer-content1">
            <h2>LEO</h2>
            <p>Maecenas faucibus mollis interdum. Morbi leo risus,
                porta ac consectetur ac, vestibulum at eros.</p>
        </div>
        <div class="footer-content2">
            <p class="foo-coont1">// CONTATO</p>
            <p class="foo-coont2">(21)98765-3434<br>contato@leolearning.com</p>
        </div>
        <div class="footer-content3">
            <p class="foo-coont3">// REDES SOCIAIS</p>
            <div class="social-footer">
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-pinterest"></i>
            </div>
        </div>
    </footer>
    <div class="copy">
        <p>Copyright 2017 - All right reserved</p>
    </div>
</body>
</html>
