$(document).ready(function() {
    $('#btn-visualizar-senha').on('click', function() {
        $iconeOlho = $('#icone-olho-senha')
        $inputSenha = $('[name="senha"').get(0)
        if($iconeOlho.hasClass('bi-eye')) {
            $iconeOlho.removeClass('bi-eye')
            $iconeOlho.addClass('bi-eye-slash')
            $inputSenha.type = 'text'
        } else {
            $iconeOlho.removeClass('bi-eye-slash')
            $iconeOlho.addClass('bi-eye')
            $inputSenha.type = 'password'
        }
    })

    $('#btn-visualizar-confirmacao-senha').on('click', function() {
        $iconeOlho = $('#icone-confirme-sua-senha')
        $inputSenha = $('[name="confirmacao_senha"').get(0)
        if($iconeOlho.hasClass('bi-eye')) {
            $iconeOlho.removeClass('bi-eye')
            $iconeOlho.addClass('bi-eye-slash')
            $inputSenha.type = 'text'
        } else {
            $iconeOlho.removeClass('bi-eye-slash')
            $iconeOlho.addClass('bi-eye')
            $inputSenha.type = 'password'
        }
    })
})