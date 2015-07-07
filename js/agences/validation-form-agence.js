var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_agence").validate({
            rules: {
                nom: "required",
                horaire: "required",
                adresse: "required"
            },
            messages: {
                nom: "Veuillez renseigner le Nom de l'agence",
                horaire: "Veuillez renseigner l'horaire de l'agence",
                adresse: "Veuillez renseigner l'adresse de l'agence"
            }
        });
        


    });


}();