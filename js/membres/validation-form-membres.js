var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_membres").validate({
            rules: {
                email: {

                    required: true,

                    email: true

                }
                
            },
            messages: {
                email: "Veuillez renseigner l'Email"
                
            }
        });
        


    });


}();