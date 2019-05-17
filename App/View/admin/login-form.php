<?php get_head();?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row d-flex justify-content-center align-content-center">
            <section class="col-lg-5">
                <div class="widget">
                    <form id="form-login">
                        <input type="text" name="login" id="login" placeholder="Login">
                        <input type="password" name="password" id="password" placeholder="Senha">
                        <input type="submit" value="Login" class="btn-estilo1">
                    </form>                    
                </div>
                <div id="status-login"></div>
                <p class="mt-20"><svg width="22" height="22" style="margin-right: 8px"><use href="#home" /></svg> Voltar para <a href="/">a Home</a></p>
            </section>
        </div>
    
    </div>
</main>

<?php get_footer(); ?>