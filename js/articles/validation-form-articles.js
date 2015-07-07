var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_articles").validate({
            rules: {
                titre: "required"
                
            },
            messages: {
                titre: "Veuillez renseigner le Titre",
                
            }
        });
        


    });


}();