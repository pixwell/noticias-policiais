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
                    var $obj = JSON.parse(response);
                    
                    if( $obj.status ){
                        $formLogin.get(0).reset();
                        window.location.href = $obj.redirect;
                    } else {
                        $statusLogin.empty().hide().html($obj.mensagem).slideDown();
                    }
                },
                error: function () {
                    $statusLogin.empty().hide().html('<div class="status-fail">Erro ao fazer login.</div>').slideDown();
                }
            }); //Ajax
        } else {
            return false;
        }
    });
    
    //Form Criar Usuario =============
    var $formUser = $('#form-create-user');
    var $nome = $('#nome');
    var $login = $('#login');
    var $pass = $('#pass1');
    var $matchPass = $('#pass2');
    var $statusUser = $('#status-user');

    $formUser.submit(function(event){
        event.preventDefault();

        var $campos = {
            name: $nome.val(),
            login: $login.val(),
            password: $pass.val()
        };

        //Validacoes ==================
        if(!$campos.name){
            alerta($nome, 'Insira seu nome');
        } else if( !$campos.login ){
            alerta($login, 'Insira um Login');
        } else if( !$pass.val() ){
            alerta($pass, '');
        } else if( !$matchPass.val() ){
            alerta($matchPass, '');
        }
        
        //Se um dos campos tiver conteudo
        if($pass.val() && $matchPass.val()){
            //Eles combinam, sao iguais?
            if($pass.val() === $matchPass.val()){
                //Incluir alteracao da senha
                $campos['password'] = $pass.val();
                $statusUser.slideDown('slow', function(){$(this).empty()})
            } else {
                //Para e mata o processo
                $statusUser.empty().hide().html('<p class="status-fail">As senhas <strong>NÃO</strong> combinam. Por favor, corrija para prosseguir.</p>').slideDown();
                return false;
            }            
        }
        //FIM das Validacoes ==================

        if( $login.val() && $pass.val() && $matchPass.val() ){
            $.ajax({
                url: '/store-user',
                type: 'POST',
                data: $campos,
                beforeSend: function () {
                    $statusUser.empty().hide().html('<p class="status-processing">Enviando ...</p>').slideDown();
                },
                success: function (response) {
                    var $obj = JSON.parse(response);
                    $statusUser.empty().hide().html($obj.mensagem).slideDown();
                    if( $obj.status ){
                        $formUser.get(0).reset();
                    }
                },
                error: function () {
                    $statusUser.empty().html('<div class="status-fail">Erro ao fazer login.</div>');
                }
            }); //Ajax
        } else {
            return false;
        }
    });
    
    //Toggle Status =============
    var $btn = $('.btn-status');
    
    $btn.on('click', function(event){
        event.preventDefault();
        var $idNoticia = $(this).data('id');
        var $btnAtual = $(this);
        var $tamanho = $btnAtual.width();
        
        $.ajax({
            url: '/admin/' + $idNoticia + '/change-status',
            type: 'POST',
            data: {id: $idNoticia},
            beforeSend: function(){
                if ( $btnAtual.hasClass('btn-success') ) {
                    $btnAtual.removeClass('btn-success').addClass('btn-processing');
                }                
                $btnAtual.width($tamanho).empty().html('<div class="text-center"><svg style="margin: 0; width: 24px; height: 24px;"><use href="#loader" /></svg></div>');
            },
            success: function(response){
                var $obj = JSON.parse(response);
                $btnAtual.removeClass('btn-success btn-processing').removeAttr('style').css('margin-right', '5px').addClass($obj.class).empty().html($obj.content);
            },
            error: function(){
                $btnAtual.removeClass('btn-success btn-processing').removeAttr('style').css('margin-right', '5px').empty().html('<div class="btn-processing">Erro!</div>');
            }
        });
    });

})(jQuery);