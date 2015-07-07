var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_service_modele_promotions").validate({
            rules: {
                date_debut: "required",
				date_fin: "required",
				prix_court: "required",
				prix_longue: "required"
				
                
            },
            messages: {
                 
				date_debut: "Veuillez renseigner une date de début",
				date_fin: "Veuillez renseigner une date de fin",
				prix_court: "Veuillez renseigner le prix de courte durée",
				prix_longue: "Veuillez renseigner le prix de longue durée"
                
            }
        });
        


    });


}();