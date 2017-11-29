var endvolunteer = function () {
    $("#endvolbtn").on('click', function () {
        var bhaktaId = $('input[name=bhakta_id]').val();
        var endDate = new Date($('#szolgalat-vege').val());
        var host = $(location).attr('origin');
        var baseUrl = $($('script')[1]).attr('src').replace(/\/js\/.*/, '');
        var url = host + baseUrl + '/bhaktas/endvolunteer/' + bhaktaId + '.json';
        $.ajax({
            url: url,
            method: 'post',
            data: {endDate: endDate},
            success: function (result) {
                if(result.status == 'success'){
                    new Noty({
                        text: 'Státusz státusz sikeresen módisítva',
                        type: 'success'
                    }).show();
                    $("#endvolform").remove();
                    $("#communityrole-id").val('4');
                    $("#legalstatus-id").val('');
                }
                if(result.status == 'fail'){
                    new Noty({
                        text: 'Nem lehetett a státuszt visszaállítani, próbálja később',
                        type: 'error'
                    }).show();
                }
            },
            error: function (result) {
                new Noty({
                    text: 'Nem lehetett a státuszt visszaállítani, próbálja később',
                    type: 'error'
                }).show();
            }
        });
    });
}();
