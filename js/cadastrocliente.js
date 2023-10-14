jQuery(function() {
    $('#clientesubmit').on('click', function() {
        let Endereco = $('#Endereco').val();
        let Bairro = $('#Bairro').val();
        let RazaoSocial = $('#RazaoSocial').val();
        let Cep = $('#Cep').val();
        let CpfCnpj = $('#CpfCnpj').val();
        let Telefone = $('#Telefone').val();
        let WhatsApp = $('#WhatsApp').val();
        let email = $('#Email').val();
        
        if(confirm("Deseja salvar a quantidade de estoque?")){
            $.ajax({
                type: "POST",
                url: "php/funcoes.php",
                data: { funcao: 'Cliente', 
                    Endereco: Endereco,
                    Bairro: Bairro,
                    RazaoSocial: RazaoSocial,
                    Cep: Cep,
                    CpfCnpj: CpfCnpj,
                    Telefone: Telefone,
                    WhatsApp: WhatsApp,
                    email: email 
                },
                success: function(response){
                    alert(response);
                },
                error: function(xhr, status, error){
                    alert("Erro ao salvar no banco de dados.");
                }
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    $('#Cep').mask('00000-000');
    $('#Telefone').mask('(00) 0000-0000');
    $('#WhatsApp').mask('(00) 0000-0000');
    
    $('#CpfCnpj').mask('000.000.000-00', {
        onKeyPress : function(CpfCnpj, e, field, options) {
          const masks = ['000.000.000-000', '00.000.000/0000-00'];
          const mask = (CpfCnpj.length > 14) ? masks[1] : masks[0];
          $('#CpfCnpj').mask(mask, options);
        }
      });
});


