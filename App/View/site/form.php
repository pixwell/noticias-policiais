<?php
get_head($metaTitle);
include 'header.php';
?>

<main>
    <div class="container pt-50">

        <div class="row">
            <section class="col-lg-9 mb-30">
                <h2>Registre sua ocorrência</h2>
                <p class="mb-50">Conte-nos o que está acontecendo na sua cidade, no seu bairro, envie sua história.</p>
                <form id="form-registro">
                    <label for="nome-ocorrencia">Seu Nome</label>
                    <input type="text" name="author" id="nome-ocorrencia">

                    <label for="cidade-ocorrencia">Sua cidade</label>
                    <select name="categories_id" id="cidade-ocorrencia">
                        <option value="">Selecione ...</option>
                        <?php foreach ($cidades as $cidade) { ?>
                            <option value="<?php echo $cidade->id ?>"><?php echo $cidade->title ?></option>
                        <?php } ?>
                    </select>

                    <label for="titulo-ocorrencia">Título da ocorrência</label>
                    <input type="text" name="title" id="titulo-ocorrencia">

                    <label for="texto">Texto</label>
                    <textarea name="content" id="texto-ocorrencia" cols="30" rows="10"></textarea>

                    <div id="status-envio-ocorrencia" class="mt-20 mb-20"></div>

                    <input type="submit" value="Enviar ocorrência" class="btn-estilo1">
                </form>
            </section>
        
            <!-- Sidebar  -->
            <aside class="col-lg-3 sidebar">
                <div class="widget">                    
                    <h2 class="mb-30">Últimos registros</h2>
                <?php 
                if($ultimas){ 
                    foreach ($ultimas as $noticia) { ?>
                    <hr>
                    <h3><a href="/<?php echo $noticia->slug ?>"><?php echo limita_texto($noticia->title, 50) ?></a></h3>                    
                <?php 
                    }//foreach
                }//if
                ?>
                </div>
            </aside><!-- /Sidebar  -->
        </div>
    
    </div>
</main>

<?php get_footer(); ?>
