jQuery(function($) {
    $('#Cep').mask('00000-000');
    $('#Telefone, #WhatsApp').mask('(00) 00000-0000');
    
    $('#cpfcnpj').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const masks = ['000.000.000-000', '00.000.000/0000-00'];
            const mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('#cpfcnpj').mask(mask, options);
        }
    });

    function limparCampos() {
        $('#razaosocial, #Endereco, #Bairro, #Cep, #WhatsApp, #Contato, #Telefone, #Email, #Estado, #RG, #CCM').val('');
    }
    
    $('#cpfcnpj').on('blur', function() {
        let cpfcnpj = $(this).val().trim();
    
        if (cpfcnpj !== '') {
            $.post('php/funcoes.php', { 
                funcao: 'buscarClientes',
                filtro: "cpfcnpj = '" + cpfcnpj + "'"
            }, function(response) {
                if (response) {
                    let data = JSON.parse(response);
                    
                    if (data.length > 0) {
                        if (confirm('Já existe um cliente "' + data[0].RazaoSocial + '" cadastrado com esses dados. Deseja preencher os campos com os dados desse cliente?')) {
                            $('#razaosocial').val(data[0].RazaoSocial);
                            $('#Endereco').val(data[0].Endereco);
                            $('#Bairro').val(data[0].Bairro);
                            $('#Cep').val(data[0].Cep);
                            $('#Contato').val(data[0].Contato);
                            $('#Email').val(data[0].Email);
                            $('#Telefone').val(data[0].Telefone);
                            $('#WhatsApp').val(data[0].WhatsApp);
                        } else {
                            limparCampos();
                        }
                    } else {
                        limparCampos();
                    }
                }
            }).fail(function(xhr, status, error) {
                console.error('Erro ao buscar dados: ' + status);
            });
        } else {
            limparCampos();
        }
    });   

    function tornarReadOnly(elementId, readOnly) {
        let element = document.getElementById(elementId);
        if (element) {
            element.readOnly = readOnly;
        }
    }
    
    tornarReadOnly('meuInput', true); 
    tornarReadOnly('meuInput', false);
});


document.addEventListener('DOMContentLoaded', function() {
    let cpfcnpjInput = document.querySelector('#cpfcnpj');
    let inputs = document.querySelectorAll('input:not(#cpfcnpj)');

    cpfcnpjInput.addEventListener('blur', function() {
        if (this.value.length >= 14) {
            inputs.forEach(function(input) {
                if (input.classList.contains('readonly')) {
                    input.removeAttribute('readOnly');
                }
            });
        } else {
            inputs.forEach(function(input) {
                if (input.classList.contains('readonly')) {
                    input.setAttribute('readOnly', 'true');
                }
            });
        }
    });
});

