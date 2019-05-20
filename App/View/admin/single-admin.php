<?php
get_head($metaTitle);
include 'header-admin.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <?php foreach ($noticia as $page) { ?>
        <div class="row">
            <section class="col-lg-9 lista-noticias" style="border-top: 1px solid #F4F4F4">
                <article>
                    <div class="details">
                        <div class="category">
                            <a href="/cidade/<?php echo $categoryList[$page->categories_id]['slug'] ?>"><?php echo $categoryList[$page->categories_id]['title'] ?></a>
                        </div>
                        <div class="date"><?php echo date( 'd/m/Y' , strtotime( $page->created_at ) ); ?></div>
                    </div>
                    <div class="text">
                        <h2><?php echo $page->title ?></h2>
                        <p class="mb-50"><strong>Registrado por:</strong> <?php echo $page->author ?></p>
                        <?php echo $page->content ?>
                    </div>
                </article>  
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <div class="widget mb-30">
                    <div class="news-detail">
                        <ul>
                            <li><svg><use href="#user" /></svg> <?php echo $page->author ?></li>
                            <li><svg><use href="#folder" /></svg> <?php echo $categoryList[$page->categories_id]['title'] ?></li>
                            <li><svg><use href="#clock" /></svg> <?php echo date('d/m/Y', strtotime($page->created_at)); ?></li>
                        </ul>
                        <div class="mt-20">
                            <?php if ($page->active) { ?>                                
                                <a href="#" class="btn-processing" style="margin-right: 5px"><svg><use href="#checkbox" /></svg> Aprovado</a>
                            <?php } else { ?>
                                <a href="#" class="btn-success" style="margin-right: 5px"><svg><use href="#checkbox" /></svg> Aprovar</a>
                            <?php } ?>
                            <a href="#" class="btn-fail"><svg><use href="#trash" /></svg> Deletar</a>
                        </div>
                    </div>                    
                </div>
            </aside><!-- /Sidebar  -->
        </div>
        <?php } ?>
    
    </div>
</main>

<?php get_footer(); ?>