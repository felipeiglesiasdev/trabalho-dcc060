// ESPERA O CONTEÚDO DA PÁGINA CARREGAR COMPLETAMENTE.
document.addEventListener('DOMContentLoaded', function() {

    // PROCURA PELO CAMPO DE INPUT COM O ID 'CPF'.
    const cpfInput = document.getElementById('cpf');

    // SE O CAMPO EXISTIR NA PÁGINA, APLICA A LÓGICA.
    if (cpfInput) {
        // ADICIONA UM "OUVINTE" QUE DISPARA TODA VEZ QUE O USUÁRIO DIGITA ALGO.
        cpfInput.addEventListener('input', function(e) {
            // PEGA O VALOR ATUAL DO CAMPO E REMOVE TUDO QUE NÃO FOR NÚMERO.
            let value = e.target.value.replace(/\D/g, '');

            // LIMITA O TAMANHO PARA OS 11 DÍGITOS DO CPF.
            value = value.substring(0, 11);

            // APLICA A MÁSCARA ###.###.###-##.
            if (value.length > 9) {
                value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else if (value.length > 6) {
                value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
            } else if (value.length > 3) {
                value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
            }

            // ATUALIZA O VALOR NO CAMPO DO FORMULÁRIO.
            e.target.value = value;
        });

        //============================================================
        // LÓGICA ADICIONADA: REMOVER A MÁSCARA ANTES DE ENVIAR
        //============================================================

        // PROCURA PELO FORMULÁRIO ONDE O CAMPO CPF ESTÁ.
        const form = cpfInput.closest('form');

        // SE ENCONTRAR UM FORMULÁRIO...
        if (form) {
            // ADICIONA UM "OUVINTE" PARA O EVENTO DE SUBMISSÃO.
            form.addEventListener('submit', function() {
                // ANTES DE ENVIAR, PEGA O VALOR DO CPF E REMOVE A MÁSCARA.
                cpfInput.value = cpfInput.value.replace(/\D/g, '');
            });
        }
    }


    //============================================================
    // MÁSCARA DE CNPJ
    //============================================================
    const cnpjInput = document.getElementById('cnpj');
    if (cnpjInput) {
        // APLICA A MÁSCARA ENQUANTO O USUÁRIO DIGITA.
        cnpjInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.substring(0, 14);

            if (value.length > 12) {
                // Formato: ##.###.###/####-##
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            } else if (value.length > 8) {
                // Formato: ##.###.###/####
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})/, '$1.$2.$3/$4');
            } else if (value.length > 5) {
                // Formato: ##.###.###
                value = value.replace(/^(\d{2})(\d{3})(\d{1,3})/, '$1.$2.$3');
            } else if (value.length > 2) {
                // Formato: ##.###
                value = value.replace(/^(\d{2})(\d{1,3})/, '$1.$2');
            }
            e.target.value = value;
        });

        // REMOVE A MÁSCARA ANTES DE O FORMULÁRIO SER ENVIADO.
        const form = cnpjInput.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                cnpjInput.value = cnpjInput.value.replace(/\D/g, '');
            });
        }
    }

});