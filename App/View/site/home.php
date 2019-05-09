<?php 
//Variavel reservada
include $code_head;

include 'header.php';
?>

<main class="container pt-50 pb-30">
    <section class="content">

        <!-- Lista de noticias  -->
        <ul class="lista-noticias">
            <li>
                <article>
                    <div class="details">
                        <div class="category"></div>
                        <div class="date"></div>
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
    <aside class="sidebar">
        <div class="widget mb-30">
            <h2>Ocorrências</h2>
            <p>Conte-nos o que está acontecendo na sua cidade, no seu bairro, envie sua história.</p>
            <a href="/formulario" class="btn-estilo1">Enviar ocorrência</a>
        </div>
    </aside><!-- /Sidebar  -->

</main>

<?php include $code_footer ?>