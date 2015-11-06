$(document).ready(function() {
    
    // ADD PRODUCT TO LIST
    $("#addForm").submit(function(e){
        $("#addForm input[type='submit']").prop("disabled", true);
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");

        $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data)
                {
                    if (data === "true"){
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        e.preventDefault();
    });
    
    // REMOVE PRODUCT FROM LIST
    $(".deleteElement").click(function(e){
        var formURL = $(this).attr("href");

        $.ajax(
            {
                url : formURL,
                type: "GET",
                success:function(data)
                {
                    if (data === "true"){
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        e.preventDefault();
    });
    
});