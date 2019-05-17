<?php
//Variavel reservada
include $code_head;
include 'header-admin.php';
?>

<main>
    <div class="container pt-50 pb-30">

        <!-- Lista de noticias  -->
        <ul class="lista-noticias-admin">
                <li>
                    <article class="row">
                        <div class="text col-lg-9 mb-20">
                            <h2><a href="/#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, ipsam, possimus magnam cupiditate deserunt veniam natus delectus quae dolorum iure eum nisi dolores non maiores alias reiciendis repellat. Dolorum, reiciendis!</p>
                        </div>
                        <div class="details col-lg-3 mb-20">
                            <ul>
                                <li><svg><use href="#user" /></svg> conse</li>
                                <li><svg><use href="#folder" /></svg> Alvorada</li>
                                <li><svg><use href="#clock" /></svg> 00/00/2019</li>
                            </ul>
                            <a href="#" class="btn-success"><svg><use href="#checkbox" /></svg> Aprovar</a>
                            <a href="#" class="btn-fail"><svg><use href="#trash" /></svg> Deletar</a>
                        </div>
                    </article>
                </li>                 
        </ul><!-- /Lista de noticias  -->

    </div>
</main>

<?php include $code_footer ?>