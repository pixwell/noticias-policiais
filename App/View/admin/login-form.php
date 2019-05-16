<?php 
//Variavel reservada
include $code_head;
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row d-flex justify-content-center align-content-center">
            <section class="col-lg-5">
                <div class="widget">
                    <form action="/auth" id="login">
                        <input type="text" name="login" id="login" placeholder="Login">
                        <input type="password" name="pasword" id="login" placeholder="Senha">
                        <input type="submit" value="Login" class="btn-estilo1">
                    </form>
                </div>
            </section>
        </div>
    
    </div>
</main>

<?php include $code_footer ?>