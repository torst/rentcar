var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_modele").validate({
            rules: {
                nom: "required",
                description: "required",
				prix_court: "required",
				prix_longue: "required"
            },
            messages: {
                nom: "Veuillez renseigner le Nom du modèle",
                description: "Veuillez renseigner la Description du modèle",
				prix_court: "Veuillez renseigner le prix de courte durée",
				prix_longue: "Veuillez renseigner le prix de longue durée"
            }
        });
        


    });


}();