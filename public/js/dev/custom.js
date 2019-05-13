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
            nome: $nome.val(),
            cidade: $cidade.val(),
            titulo: $titulo.val(),
            texto: $texto.val()
        };

        //Validacoes ==================
        if( !$campos.nome ){
            alerta($nome, 'Insira seu nome.');
        } else if(!$campos.cidade){
            alerta($cidade, 'Escolha a sua cidade.');
        } else if(!$campos.titulo){
            alerta($titulo, 'Insira um título para a sua ocorrência.');
        } else if(!$campos.texto){
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
                    $statusOcorrencia.empty().hide().html('<p class="status-success">' + response + '</p>').slideDown();
                    $formRegistro.get(0).reset();
                },
                error: function (response) {
                    $statusOcorrencia.empty().html('<p class="status-fail">' + response + '</p>');
                }
            }); //Ajax
        } else {
            return false;
        }
    });

})(jQuery);