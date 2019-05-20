<?php
get_head($metaTitle);
include 'header-admin.php';
?>

<main>
    <div class="container pt-50 pb-30">
        <?php if ($noticias) : ?>
            <!-- Lista de noticias  -->
            <ul class="lista-noticias-admin">
            <?php foreach ($noticias as $noticia) : ?>                
                <li>
                    <article class="row">
                        <div class="text col-md-8 col-lg-9 mb-20">
                            <h2><a href="/admin/<?php echo $noticia->slug ?>"><?php echo $noticia->title ?></a></h2>
                            <?php limita_texto( strip_tags($noticia->content), 250 ) ?>
                        </div>
                        <div class="news-detail col-md-4 col-lg-3 mb-20">
                            <ul>
                                <li><svg><use href="#user" /></svg> <?php echo $noticia->author ?></li>
                                <li><svg><use href="#folder" /></svg> <?php echo $categoryList[$noticia->categories_id]['title'] ?></li>
                                <li><svg><use href="#clock" /></svg> <?php echo date( 'd/m/Y' , strtotime( $noticia->created_at ) ); ?></li>
                            </ul>
                            <div class="mt-20">
                                <?php if($noticia->active){ ?>                                
                                <a href="#" class="btn-processing" id="aprovado" style="margin-right: 5px"><svg><use href="#checkbox" /></svg> Aprovado</a>
                                <?php } else { ?>
                                <a href="/admin/<?php echo $noticia->id ?>/ativar" id="aprovar" class="btn-success" style="margin-right: 5px"><svg><use href="#checkbox" /></svg> Aprovar</a>
                                <?php } ?>
                                <a href="/admin/<?php echo $noticia->id ?>/delete" class="btn-fail"><svg><use href="#trash" /></svg> Deletar</a>
                            </div>
                        </div>
                    </article>
                </li>  
            <?php endforeach; ?>
            </ul><!-- /Lista de noticias  -->    
        <?php else : ?>
            <p>Nenhuma notícia registrada ainda.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>