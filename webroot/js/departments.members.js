var sourceListId;
var targetListId;
$(".drag").draggable({
    drag: function (i, el) {
        sourceListId = $(this).parent().attr("id");
    }
});
$(".drop").each(function (i, el) {
    $(this).droppable({
        drop: function (event, ui) {
            targetListId = $(this).attr("id");
            var itemId = ui.draggable.attr("id");
            $("#" + itemId).appendTo("#" + targetListId);
            $("#"+targetListId+" li").last().css({"position": "relative","left": 0, "top": 0});
        }
    });
});