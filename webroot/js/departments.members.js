var sourceListId;
var targetListId;
$('.drag').draggable({
    drag: function (i, el) {
        sourceListId = $(this).parent().attr('id');
    }
});
$('.drop').each(function (i, el) {
    $(this).droppable({
        drop: function (event, ui) {
            targetListId = $(this).attr('id');
            var itemId = ui.draggable.attr('id');
            $('#' + itemId).appendTo('#' + targetListId);
            $('#' + targetListId + ' li').last().css({'position': 'relative', 'left': 0, 'top': 0});
            if (sourceListId != targetListId) {
                var bhaktaId = itemId.substring(3);
                var departmentId = targetListId.substring(3);
                var host = $(location).attr('origin');
                var baseUrl = $($('script')[1]).attr('src').replace(/\/js\/.*/, '');
                var url = host + baseUrl + '/services/addbybhaktaanddepartment.json';
                var now = new Date();
                var month = now.getMonth() + 1;
                var day = now.getDate();
                var now = now.getFullYear() + '-' + (month < 10 ? '0' : '')
                    + month + '-' + (day < 10 ? '0' : '') + day;
                var beginDate = prompt('Adja meg az új szolgálat kezdetét', now);
                var pattern = new RegExp('^\\d{4}\\-(0?[1-9]|1[012])\\-(0?[1-9]|[12][0-9]|3[01])$');
                if (!pattern.test(beginDate)) {
                    new Noty({
                        text: 'Nem megfelelő dátum formátum!'
                    }).show();
                } else {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {bhaktaId: bhaktaId, departmentId: departmentId, beginDate: beginDate},
                        success: function (result) {
                            if (result.status == 'success') {
                                new Noty({
                                    text: 'Szolgálat sikeresen hozzáadva!',
                                    type : 'success'
                                }).show();
                            }
                            if (result.status == 'fail') {
                                new Noty({
                                    text: 'Nem lehetett a szolgálatot hozzáadni, próbálja később!',
                                    type: 'error'
                                }).show();
                            }
                        },
                        error: function (result) {
                            new Noty({
                                text: 'Nem lehetett a szolgálatot hozzáadni, próbálja később!',
                                type: 'error'
                            }).show();
                        }
                    });
                }
            }
        }
    });
});