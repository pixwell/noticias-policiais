<?php
get_head();
include 'header.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <div class="row">
            <section class="col-lg-9 lista-noticias" style="border-top: 1px solid #F4F4F4">
                <article>
                    <?php foreach ($noticia as $page) { ?>
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
                    <?php } ?>
                </article>  
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <?php include 'widget-ocorrencia.php' ?>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php get_footer(); ?>