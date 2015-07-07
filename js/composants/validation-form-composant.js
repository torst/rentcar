var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_composant").validate({
            rules: {
                nom: "required"
            },
            messages: {
                nom: "Veuillez renseigner le Nom du composant"
            }
        });
        


    });


}();