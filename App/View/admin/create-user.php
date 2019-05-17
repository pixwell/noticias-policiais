<?php get_head();?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row d-flex justify-content-center align-content-center">
            <section class="col-lg-5">
                <div class="widget">
                    <h2 class="mb-20 text-center">Criar Usuário</h2>
                    <form id="form-create-user">
                        <input type="text" name="nome" id="nome" minlength="3" placeholder="Nome">
                        <input type="text" name="login" id="login" minlength="6" placeholder="Login">
                        <input type="password" name="pass1" id="pass1" placeholder="Senha">
                        <input type="password" name="pass2" id="pass2" placeholder="Confirmar Senha">
                        <input type="submit" value="Enviar" class="btn-estilo1">
                    </form>                    
                </div>
                <div id="status-user"></div>
                <p class="mt-20"><svg width="22" height="22" style="margin-right: 8px"><use href="#home" /></svg> Voltar para <a href="/">a Home</a></p>
            </section>
        </div>
    
    </div>
</main>

<?php get_footer(); ?>
