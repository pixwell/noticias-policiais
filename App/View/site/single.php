<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9 lista-noticias" style="border-top: 1px solid #F4F4F4">
                <article>
                    <div class="details">
                        <div class="category"><a href="#">Categoria</a></div>
                        <div class="date">00/00/0000</div>
                    </div>
                    <div class="text">
                        <h2>Título da Notícia</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, dolor, atque quae eos blanditiis quasi mollitia at accusantium numquam laudantium omnis ipsa vel asperiores dolores voluptatibus in odio sint labore!</p>
                    </div>
                </article>  
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <?php include 'widget-ocorrencia.php' ?>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php include $code_footer ?>