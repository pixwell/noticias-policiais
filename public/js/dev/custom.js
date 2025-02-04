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
    var $nome = $('#nome');
    var $cidade = $('#cidade');
    var $titulo = $('#titulo');
    var $texto = $('#texto');
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
    var $btnStatus = $('.btn-status');
    
    $btnStatus.on('click', function(event){
        event.preventDefault();
        var $idNoticia = $(this).data('id');
        var $btnAtual = $(this);
        
        $.ajax({
            url: '/admin/' + $idNoticia + '/change-status',
            type: 'POST',
            data: {id: $idNoticia},
            beforeSend: function(){
                if ( $btnAtual.hasClass('btn-success') ) {
                    $btnAtual.removeClass('btn-success').addClass('btn-processing');
                }                
                $btnAtual.empty().html('<svg style="margin: 0;"><use href="#loader" /></svg>');
            },
            success: function(response){
                var $obj = JSON.parse(response);
                $btnAtual.empty().removeClass('btn-success btn-processing').removeAttr('style').css('margin-right', '5px').addClass($obj.class).html($obj.content);
            },
            error: function(){
                $btnAtual.empty().removeClass('btn-success btn-processing').removeAttr('style').css('margin-right', '5px').html('<div class="btn-processing">Erro!</div>');
            }
        });
    });
    
    //Delete noticia =============
    var $btnDelete = $('.btn-delete');
    var $modalDelete = $('#confirm-delete');
    var $linkDelete = $('#confirm-delete #btn-delete');
    var $openModal = $('.open-modal');
    var $duration = 500;
    
    //Ao clicar no botao delete, abrir modal com os dados da ocorrencia
    $openModal.on('click', function(event){
        event.preventDefault();
        var $idNoticia = $(this).data('id');
        var $isHome = $(this).data('home');
        
        $linkDelete.removeAttr('data-id data-home').attr({'data-id': $idNoticia, 'data-home': $isHome});
        $modalDelete.modal({fadeDuration: $duration});
    });
    
    //Ao clicar no botao de confirmacao
    $linkDelete.click(function(event){
        event.preventDefault();
        
        var $idNoticia = $(this).attr('data-id');
        var $isHome = $(this).attr('data-home');
        var $liContainer = $('#item-' + $idNoticia);
        var $contentBtnDelete = $linkDelete.html();
        var $redirectTo = '/admin';
        
        $.ajax({
            url: '/admin/' + $idNoticia + '/delete',
            type: 'POST',
            data: {id: $idNoticia},
            beforeSend: function(){
                $linkDelete.empty().html('<svg style="margin: 0; width: 16px; height: 16px;"><use href="#loader" /></svg>');
            },
            success: function(response){
                $.modal.close();
                //Aguarda o tempo de fechamento do modal
                setTimeout(function(){
                    if($isHome === 'true'){
                        $liContainer.css('background', '#ffe0e0').slideUp($duration);
                        $linkDelete.empty().html($contentBtnDelete);
                    } else {
                        window.location.href = $redirectTo;
                    }
                }, $duration);
            },
            error: function(){
                $.modal.close();
                setTimeout(function(){
                    alert('Erro ao deletar notícia!');
                }, $duration);
            }
        });
        
    });

})(jQuery);