var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_clients").validate({
            rules: {
                nom: "nom",
				prenom: "prenom",
				adresse: "adresse",
				telephone: "telephone",
                
            },
            messages: {
                nom: "Veuillez renseigner le Nom",
				prenom: "Veuillez renseigner le Prénom",
				adresse: "Veuillez renseigner l'adresse",
				telephone: "Veuillez renseigner le Téléphone",
                
            }
        });
        


    });


}();