<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main>
    <div class="container pt-50">

        <div class="row">
            <section class="col-lg-9 mb-30">
                <h2>Registre sua ocorrência</h2>
                <p class="mb-50">Conte-nos o que está acontecendo na sua cidade, no seu bairro, envie sua história.</p>
                <form id="form-registro" action="/noticia/store" method="post">
                    <label for="nome-ocorrencia">Seu Nome</label>
                    <input type="text" name="nome-ocorrencia" id="nome-ocorrencia">

                    <label for="cidade-ocorrencia">Sua cidade</label>
                    <select name="cidade-ocorrencia" id="cidade-ocorrencia">
                        <option value="">Selecione ...</option>
                        <option value="alvorada">Alvorada</option>
                        <option value="cachoeirinha">Cachoeirinha</option>
                        <option value="canoas">Canoas</option>
                        <option value="porto-alegre">Porto Alegre</option>
                    </select>

                    <label for="titulo-ocorrencia">Título da ocorrência</label>
                    <input type="text" name="titulo-ocorrencia" id="titulo-ocorrencia">

                    <label for="texto">Texto</label>
                    <textarea name="texto-ocorrencia" id="texto-ocorrencia" cols="30" rows="10"></textarea>

                    <input type="submit" value="Enviar ocorrência" class="btn-estilo1">
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