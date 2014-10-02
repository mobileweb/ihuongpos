$(document).ready(function() {
    $host = "http://ihuong.com";

    /* Price check */
    $("#searchText").on("paste",function(e){
        setTimeout(function() {
            $("#searchForm").submit();
        }, 0); // note the 0 milliseconds
    });

    $( "#searchForm" ).submit(function( event ) {
        var searchText = $("#searchText").val();
        if (searchText.length > 0) {
            var content = "<tr style='text-align: center'><td colspan='4'>Searching, please wait...</td></tr>";

            $('#productTable tbody').empty().append(content);
            var formData = $(this).serialize();
            var request = $.ajax({
                type: "POST",
                url: "controller.php",
                data: formData,
                dataType: "json"
            });

            request.success(function( data ) {
                var products = data["products"];
                if (products.length > 0) {
                    content = "";
                    for (var i = 0; i < products.length; i++) {
                        var product = products[i];
                        content += "<tr>" +
                                        "<td>" + "<img class=\"preview\" src=\"" + $host + product.image + "\" />" + "</td>" +
                                        "<td>" + "<a target=\"_blank\" href=\"" + $host + product.path + "\">" + product.name + "</a>"+ "</td>" +
                                        "<td>" + "$" + product.price + "</td>" +
                                    "</tr>";
                    }
                } else {
                    content = "<tr style='text-align: center'><td colspan='4'>No product found.</td></tr>";
                }
                $('#productTable tbody').empty().append(content);
            });

            request.error(function( xhr, ajaxOptions, thrownError ) {
                content = "<tr style='text-align: center'><td colspan='4'>Error while searching. Please try again...</td></tr>";
                $('#productTable tbody').empty().append(content);
            });
        }

        return false;
    });

    /* Settings */
    if ($("#settingForm").length > 0) {
        $oldAPIKey = $("#APIKey").val();
        $oldUsername = $("#username").val();

        $('#APIKey, #username, #password').on('keyup', function () {
            $newAPIKey = $("#APIKey").val();
            $newUsername = $("#username").val();
            $newPassword = $("#password").val();

            if ($newAPIKey != $oldAPIKey || $newUsername != $oldUsername || $newPassword.length > 0)
                $("#submitButton").removeAttr('disabled');
            else {
                $("#submitButton").attr('disabled','disabled');
            }
        });
    }
});

/* Menu */
function hideMenuItem(item) {
    $(item).hide();
}