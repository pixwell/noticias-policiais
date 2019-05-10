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
                    <li>
                        <article>
                            <div class="details">
                                <div class="category"><a href="/cidade/porto-alegre">Porto Alegre</a></div>
                                <div class="date">06/05/2019</div>
                            </div>
                            <div class="text">
                                <h2><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit iure</a></h2>
                                <p>Corrupti doloremque possimus deserunt soluta accusantium quaerat sapiente, nisi consectetur inventore maiores nesciunt quibusdam ea aspernatur omnis quo modi dolorem! Deleniti ...</p>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article>
                            <div class="details">
                                <div class="category"><a href="/cidade/cachoeirinha">Cachoeirinha</a></div>
                                <div class="date">05/05/2019</div>
                            </div>
                            <div class="text">
                                <h2><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit iure</a></h2>
                                <p>Corrupti doloremque possimus deserunt soluta accusantium quaerat sapiente, nisi consectetur inventore maiores nesciunt quibusdam ea aspernatur omnis quo modi dolorem! Deleniti ...</p>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article>
                            <div class="details">
                                <div class="category"><a href="/cidade/canoas">Canoas</a></div>
                                <div class="date">04/05/2019</div>
                            </div>
                            <div class="text">
                                <h2><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit iure</a></h2>
                                <p>Corrupti doloremque possimus deserunt soluta accusantium quaerat sapiente, nisi consectetur inventore maiores nesciunt quibusdam ea aspernatur omnis quo modi dolorem! Deleniti ...</p>
                            </div>
                        </article>
                    </li>
                </ul><!-- /Lista de noticias  -->    
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