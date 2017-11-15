var endvolunteer = function () {
    $("#endvolbtn").on("click", function () {
        var bhakta_id = $("input[name=bhakta_id]").val();
        var enddate = new Date($("#szolgalat-vege").val());
        var year = enddate.getFullYear();
        var month = enddate.getMonth() +1;
        var day = enddate.getDate();
        var host = $(location).attr("origin");
        var baseUrl = $($("script")[1]).attr("src").replace(/\/js\/.*/, '');
        var url = host + baseUrl + "/bhaktas/endvolunteer/" + bhakta_id;
        $.ajax({
            url: url,
            method: "post",
            data: "enddate=" +enddate ,
            success: function (result) {
                var response = JSON.parse(result);
                if(response["status"] == "success"){
                    $("#endvolbtn").remove();
                    $("#communityrole-id").val("4");
                    $("#legalstatus-id").val("");
                }
                if(response.status == "fail"){
                    alert("Nem lehetett a státuszt visszaállítani, próbálja később");
                }
            },
            error: function (result) {
                alert("Nem lehetett a státuszt visszaállítani, próbálja később");
            }
        });
    });
}();
