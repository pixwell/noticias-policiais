<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9">    
                <!-- Lista de noticias  -->
                <ul class="lista-noticias">
                    <?php foreach ($noticias as $noticia) { ?>
                    <li>
                        <article>
                            <div class="details">
                                <div class="category"><a href="<?php echo $noticia->route ?>"><?php echo $noticia->categories_id ?></a></div>
                                <div class="date"><?php echo date( 'd/m/Y' , strtotime( $noticia->created_at ) ); ?></div>
                            </div>
                            <div class="text">
                                <h2><a href="<?php echo $noticia->slug ?>"><?php echo $noticia->title ?></a></h2>
                                <?php limita_texto( strip_tags($noticia->content), 250 ) ?>
                            </div>
                        </article>
                    </li>
                    <?php } ?>                   
                </ul><!-- /Lista de noticias  -->    
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <?php include 'widget-ocorrencia.php' ?>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php include $code_footer ?>