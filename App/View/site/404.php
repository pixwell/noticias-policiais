<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9">    
                <h2 class="text-center">Erro 404</h2> 
                <p class="text-center">Página ou conteúdo não encontrado</p>
                <div class="text-center">
                    <svg><use href="#404" /></svg>
                </div>
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <div class="widget mb-30">
                    <h2><svg width="24" height="34"><use href="#boletim" /></svg>Ocorrências</h2>
                    <p class="mb-20">Conte-nos o que está acontecendo na sua cidade, no seu bairro, envie sua história.</p>
                    <a href="/formulario" class="btn-estilo1">Enviar ocorrência</a>
                </div>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php include $code_footer ?>