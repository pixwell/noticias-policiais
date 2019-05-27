<?php
get_head($metaTitle);
include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9">
                <h2 class="mb-50">Notícias de <?php echo $metaTitle  ?></h2>
            
            <?php if($noticias){ ?>
                <!-- Lista de noticias  -->
                <ul class="lista-noticias">
                    <?php foreach ($noticias as $noticia) { ?>
                    <li>
                        <article>
                            <div class="details">
                                <div class="date"><?php echo date( 'd/m/Y' , strtotime( $noticia->created_at ) ); ?></div>
                            </div>
                            <div class="text">
                                <h3><a href="/<?php echo $noticia->slug ?>"><?php echo $noticia->title ?></a></h3>
                                <?php limita_texto( strip_tags($noticia->content), 250 ) ?>
                            </div>
                        </article>
                    </li>
                    <?php } ?>                   
                </ul><!-- /Lista de noticias  -->
                
                <nav><?php echo $navPaginacao ?></nav>
                
            <?php } else { ?>
                <p>Nenhuma notícias encontrada.</p>
            <?php }//if ?>   
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <?php include 'widget-ocorrencia.php' ?>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php get_footer(); ?>