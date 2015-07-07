var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_service").validate({
            rules: {
                nom: "required",
                description: "required",
				 prix: {
					required: true,
					number: true
					}
            },
            messages: {
                nom: "Veuillez renseigner le Nom du service",
                description: "Veuillez renseigner la Description du service",
                prix: "Veuillez renseigner le prix du service. Exemple: 99.05 ou 90.00 ou 90 ou 0 pour gratuit"
            }
        });
        


    });


}();