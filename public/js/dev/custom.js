jQuery.noConflict();
(function ($) {
    //Toggle menu =============
    var $nav = $('#main-menu');
    var $toggle = $('#toggle-menu a');
   
    $toggle.click(function (event) {
        event.preventDefault();
        $nav.toggle("slow");
    });

    //Form ocorrencias =============
    var $formRegistro = $('#form-registro');
    var $nome = $('#nome-ocorrencia');
    var $cidade = $('#cidade-ocorrencia');
    var $titulo = $('#titulo-ocorrencia');
    var $texto = $('#texto-ocorrencia');
    var $statusOcorrencia = $('#status-envio-ocorrencia');

    function alerta($campo, $mensagem){            
        $campo.css({border: '1px solid red', color: 'red'}).attr( 'placeholder', $mensagem );
        $campo.focus(function(){
            $(this).removeAttr('style').removeAttr( 'placeholder' );
        });
        return false;
    }

    $formRegistro.submit(function(event){
        event.preventDefault();

        var $campos = {
            author: $nome.val(),
            categories_id: $cidade.val(),
            title: $titulo.val(),
            content: $texto.val()
        };

        //Validacoes ==================
        if( !$campos.author ){
            alerta($nome, 'Insira seu nome.');
        } else if(!$campos.categories_id){
            alerta($cidade, 'Escolha a sua cidade.');
        } else if(!$campos.title){
            alerta($titulo, 'Insira um título para a sua ocorrência.');
        } else if(!$campos.content){
            alerta($texto, 'Insira o texto da sua ocorrência.');
        }

        if( $nome.val() && $cidade.val() && $titulo.val() && $texto.val() ){
            $.ajax({
                url: '/store-ocorrencia',
                type: 'POST',
                data: $campos,
                beforeSend: function () {
                    $statusOcorrencia.empty().hide().html('<p class="status-processing">Enviando ...</p>').slideDown();
                },
                success: function (response) {
                    $statusOcorrencia.empty().hide().html(response).slideDown();
                    $formRegistro.get(0).reset();
                },
                error: function (response) {
                    $statusOcorrencia.empty().html(response);
                }
            }); //Ajax
        } else {
            return false;
        }
    });
    //Form Login =============
    var $formLogin = $('#form-login');
    var $login = $('#login');
    var $senha = $('#password');
    var $statusLogin = $('#status-login');

    $formLogin.submit(function(event){
        event.preventDefault();

        var $campos = {
            login: $login.val(),
            password: $senha.val()
        };

        //Validacoes ==================
        if( !$campos.login ){
            alerta($login, 'Insira seu login.');
        } else if(!$campos.password){
            alerta($senha, 'Insira a sua senha.');
        }

        if( $login.val() && $senha.val() ){
            $.ajax({
                url: '/auth',
                type: 'POST',
                data: $campos,
                beforeSend: function () {
                    $statusLogin.empty().hide().html('<p class="status-processing">Enviando ...</p>').slideDown();
                },
                success: function (response) {
                    $statusLogin.empty().hide();
                    $formLogin.get(0).reset();
                    var $obj = JSON.parse(response);
                    if( $obj.status ){
                        window.location.href = $obj.redirect;
                    }
                },
                error: function (response) {
                    var $obj = JSON.parse(response);
                    $statusLogin.empty().html('<div class="status-fail">Erro ao fazer login.</div>');
                }
            }); //Ajax
        } else {
            return false;
        }
    });

})(jQuery);