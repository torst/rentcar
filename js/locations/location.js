
//partie liste des locations ****************************************************
$("#btn_advanced_search").click(function(e) {
			if($(this).children('i').attr("class") == "icon-caret-down"){
				//document.getElementById('advanced_search').style.display='block';
				$("#advanced_search").slideDown(100);
				$(this).children('i').removeClass('icon-caret-down').addClass('icon-caret-up');
			}
			else{
				$("#advanced_search").slideUp(100);
				$(this).children('i').removeClass('icon-caret-up').addClass('icon-caret-down');
			}
});

//partie new location **************************************************** 

$("#check_reprise_perso").click(function(e) {
    if ( $("#check_reprise_perso").is(':checked') ){
		//affichage du champ definir lieu
		$("#lieu_reprise_groupe").slideDown(100);
		$('#service_select').multiSelect('select',['6']);
	}
	else{
		$("#lieu_reprise_groupe").slideUp(100);
		$('#service_select').multiSelect('deselect',['6']);
		//supprimer contenu
		document.getElementById('lieu_reprise').value ="";

	}
});

$("#check_depart_perso").click(function(e) {
    if ( $("#check_depart_perso").is(':checked') ){
		//affichage du champ definir lieu
		$("#lieu_depart_groupe").slideDown(100);
		$('#service_select').multiSelect('select',['5']);
	}
	else{
		$("#lieu_depart_groupe").slideUp(100);
		$('#service_select').multiSelect('deselect',['5']);
		//supprimer contenu
		document.getElementById('lieu_depart').value ="";
	}
});

$("#calcule_montant").click(function(e) {

var idVehicule = $('#vehicule').val();

//validate modele selectionne
if (idVehicule == ""){
	alert('Prière de renseigner un véhicule');
	return;
}

var dateDebutString = $('#date_debut').val();

//validate date debut selectionne
if (dateDebutString == ""){
	alert('Prière de renseigner une date de début');
	return;
}

var dateDebut = new Date(dateDebutString.substring(6,10),dateDebutString.substring(3,5),dateDebutString.substring(0,2));

var dateFinString = $('#date_fin').val();

//validate date fin selectionne
if (dateFinString == ""){
	alert('Prière de renseigner une date de fin');
	return;
}

var dateFin = new Date(dateFinString.substring(6,10),dateFinString.substring(3,5),dateFinString.substring(0,2));


var WNbJours = dateFin.getTime() - dateDebut.getTime();	//calcule nombre de jour
WNbJours = 1 + Math.ceil(WNbJours/(1000*60*60*24));

//calcule chronologie des dates
if (WNbJours <= 0){
	alert('La date de début doit être antérieure à la date de fin');
	return;
}

var optionSelect = $('#option_select').val();
var serviceSelect = $('#service_select').val();


jQuery.ajax({
  type: 'GET', 
  url: 'locations/ajax_locations.php', 
  data: {
    methode : 'getMontantCalcule',
	id_vehicule : idVehicule, 
    nombre_jours : WNbJours,
    options_liste : optionSelect,
	services_liste : serviceSelect,
	date_deb : dateDebutString
  },
  dataType: "json", 
  success: function(data, textStatus, jqXHR) {
    // La reponse du serveur est contenu dans data
    // On peut faire ce qu'on veut avec ici
    $('#montant_calcule').val(data);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
	alert('Error. Pleaze contact your system administrator.');
  }
});


});

$("#remise").change(function(e) {
    //alert('valeur selectionnee : ' + $('#remise').val());
    var remise = 0;
    var remise_param = $('#remise').val();
    var montant_calcule = 0;
    if ($('#montant_calcule').val() != "")
    	montant_calcule = parseFloat($('#montant_calcule').val());
    var remise_numerik = parseInt($('#remise').val());
    switch(remise_param){
    	
    	case '1': 
    				remise = montant_calcule * 0; 
    				$('#valeur_remise').val(remise);
    				break;
    				
    	case '3': 
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    				
    	case '5': 
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    				
    	case '8': 
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    				
    	case '10': 
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    				
    	case '15':
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    	
    	case '20': 
    				remise = montant_calcule * remise_numerik / 100;
    				$('#valeur_remise').val(remise.toPrecision());
    				break;
    				
    	case '99': 
    				$('#valeur_remise').val("");
    				break;
    				
    	}
});


$("#calcule_montant_remise").click(function(e) {
    var montant_apres_remise = 0;
    var montant_calcule = 0;
    var valeur_remise = 0;
    //recup valeur montant sans remise
    if ($('#montant_calcule').val() != "")
    	montant_calcule = parseFloat($('#montant_calcule').val());
    	
    //recuperer valeur remise appliquee
    if ($('#valeur_remise').val() != "")
    	valeur_remise = parseFloat($('#valeur_remise').val());
    	
    montant_apres_remise = montant_calcule - valeur_remise;
    $('#montant_apayer').val(montant_apres_remise);
    
});

$("#statut_paiement").change(function(e) {
    var statut_paiement = $('#statut_paiement').val();    
    if (statut_paiement == "1") //cacher mode paiement et montant paye
    	$("#bloc_paiement").slideUp(100);
    else //afficher sinon
    	$("#bloc_paiement").slideDown(100);
    				
    	
});

