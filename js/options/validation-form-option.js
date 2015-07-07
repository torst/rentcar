var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_option").validate({
            rules: {
                nom: "required",
                description: "required",
				 prix: {
					required: true,
					number: true
					}
            },
            messages: {
                nom: "Veuillez renseigner le Nom l'option",
                description: "Veuillez renseigner la Description de l'option",
                prix: "Veuillez renseigner le prix de l'option. Exemple: 99.05 ou 90.00 ou 90 ou 0 pour gratuit"
            }
        });
        


    });


}();