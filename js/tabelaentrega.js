$(function() {
    $('#TabelaEntregaForm').on('click', function() {
        let evento = $('#evento').val();
        let montadora = $('#montadora').val();
        let contato = $('#Contato').val();
        let stand = $('#stand').val();
        let local = $('#Local').val();
        let entrega = $('#Entrega').val();
        let retirada = $('#Datade').val();

        let produtosSelecionados = [];
        $('.tabela tbody tr').each(function() {
            if ($(this).find('input[type="checkbox"]').is(':checked')) {
                let idProduto = $(this).find('input[type="checkbox"]').attr('id').split('_')[2];
                let quantidade = $(this).find('input[type="number"]').val();
                let observacaocod = $(this).find('textarea[name="Observacao"]').val();
                let observacao = encodeURIComponent(observacaocod);

                produtosSelecionados.push({id: idProduto, quantidade: quantidade, observacao: observacao}); 
            }
        });

        let dados = {
            evento: evento,
            montadora: montadora,
            contato: contato,
            stand: stand,
            local: local,
            entrega: entrega,
            retirada: retirada,
            produtos: JSON.stringify(produtosSelecionados) 
        };

        $.ajax({
            type: 'POST',
            url: 'entregapdf.php',
            data: dados,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Redireciona o usuário para o arquivo PDF para fazer o download
                    window.location.href = response.pdf_filename;
                } else {
                    console.error('Erro ao gerar o PDF');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
    });
});
