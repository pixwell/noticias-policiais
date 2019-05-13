<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9">
                <h2>Registre sua ocorrência</h2>
                <p>Conte-nos o que está acontecendo na sua cidade, no seu bairro, envie sua história.</p>
                <form id="form-registro" action="/noticia/store" method="post">
                    <label for="nome">Seu Nome</label>
                    <input type="text" name="nome" id="nome">
                </form>
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <p>#TODO widget com últimas notícias</p>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php include $code_footer ?>