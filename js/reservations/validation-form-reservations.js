/*
var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
                
        $("#modifier_reservations").validate({
            rules: {
                client: "required",
				modele: "required",
				date_debut: "required",
				date_fin: "required"
				
                
            },
            messages: {
                 
				date_debut: "Veuillez renseigner une date de début",
				date_fin: "Veuillez renseigner une date de fin",
				client: "Veuillez renseigner le client",
				modele: "Veuillez renseigner le modèle"
                
            }
        });
        


    });


}();
*/

$("#modifier_reservations").submit(function(e) {
    var idclient = $('#client').val();

	//validate modele selectionne
	if (idclient == ""){
		e.preventDefault();
		alert('Prière de renseigner un client');
		return;
	}
    
    var idModele = $('#modele').val();

	//validate modele selectionne
	if (idModele == ""){
		e.preventDefault();
		alert('Prière de renseigner un modèle de véhicule');
		return;
	}
	
	var date_debut = $('#date_debut').val();

	//validate modele selectionne
	if (date_debut == ""){
		e.preventDefault();
		alert('Prière de renseigner une date début');
		return;
	}
	
	var date_fin = $('#date_fin').val();

	//validate modele selectionne
	if (date_fin == ""){
		e.preventDefault();
		alert('Prière de renseigner une date fin');
		return;
	}
	
	var agence_depart = $('#agence_depart').val();

	//validate modele selectionne
	if ((agence_depart == "") && ($("#check_depart_perso").is(':checked') == false)){
		e.preventDefault();
		alert('Prière de renseigner une agence de départ');
		return;
	}
	
	var agence_reprise = $('#agence_reprise').val();

	//validate modele selectionne
	if ((agence_reprise == "") && ($("#check_reprise_perso").is(':checked') == false)){
		e.preventDefault();
		alert('Prière de renseigner une agence de reprise');
		return;
	}
	
	var montant_apayer = $('#montant_apayer').val();

	//validate modele selectionne
	if (montant_apayer == ""){
		e.preventDefault();
		alert('Prière de renseigner le montant à payer');
		return;
	}
	
	//validation montant a payer doit etre numerique
	if(isNaN($('#montant_apayer').val()))
	{
		e.preventDefault();
		alert('Le montant à payer doit être un chiffre valide');
		return;
	}
	
	
	//validation montant payé doit etre numerique
	var montant_paye = $('#montant_paye').val();

	//validate modele selectionne
	if (montant_paye != "")
		if(isNaN($('#montant_paye').val()))
		{
			e.preventDefault();
			alert('Le montant payé doit être un chiffre valide');
			return;
		}

    
});