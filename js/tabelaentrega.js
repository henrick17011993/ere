jQuery(function() {
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
                observacao = encodeURIComponent(observacaocod);
                
                produtosSelecionados.push({id: idProduto, quantidade: quantidade, observacao: observacao}); 
            }
        });

        
        let dados_codificados = btoa(JSON.stringify({evento: evento, montadora: montadora, contato: contato, stand: stand, local: local, entrega: entrega, retirada: retirada, produtos: produtosSelecionados}));
        let cookie_nome = 'dados_cookie';
        let duracao = 100; 
        let path = '/';
        document.cookie = cookie_nome + '=' + dados_codificados + '; expires=' + new Date(Date.now() + duracao * 1000).toUTCString() + '; path=' + path;
        window.location.href = 'entregapdf.php';
    });

});


