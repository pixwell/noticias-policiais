
<!-- ========== Cabecalho ========== -->
<header id="header">
    <div class="container">
        <h1><a href="/">Admin</a></h1>

        <div id="toggle-menu">
            <a href="#"><svg><use href="#menu" /></svg></a>
        </div>
        
        <nav id="main-menu">
            <ul class="menu">
                <li><span style="margin-right: 8px">Você está logado como, <strong><?php echo auth_check() ? user_name() : '' ?></strong></span></li>
                <li>
                    <a href="/logout" class="btn-estilo1"><svg width="16" height="14" style="margin-right: 5px">
                        <use href="#power" /></svg>Deslogar
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
