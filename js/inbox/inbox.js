var toImportant = document.getElementById('action_to_important');

toImportant.addEventListener('click', function() {
	document.getElementById("tolabel").value = 'IMPORTANT';
    document.forms["action_form"].submit();
}, false);

var toTraite = document.getElementById('action_to_traite');

toTraite.addEventListener('click', function() {
	document.getElementById("tolabel").value = 'TRAITE';
    document.forms["action_form"].submit();
}, false);

var toCorbeille = document.getElementById('action_to_corbeille');

toCorbeille.addEventListener('click', function() {
	document.getElementById("tolabel").value = 'CORBEILLE';
    document.forms["action_form"].submit();
}, false);

var toInbox = document.getElementById('action_to_inbox');

toInbox.addEventListener('click', function() {
	document.getElementById("tolabel").value = 'INBOX';
    document.forms["action_form"].submit();
}, false);

var toEnvoye = document.getElementById('action_to_envoye');

toEnvoye.addEventListener('click', function() {
	document.getElementById("tolabel").value = 'ENVOYE';
    document.forms["action_form"].submit();
}, false);

var actionRefresh = document.getElementById('action_refresh');

actionRefresh.addEventListener('click', function() {
	location.reload();
}, false);

var attachement1 = document.getElementById('attachement1');
var file1_p = document.getElementById('file1_p');
attachement1.addEventListener('change', function() {
    // On récupère la liste des fichiers
    file1_p.innerHTML = "(1) "+document.getElementById('attachement1').value;
	var action_del_file1 = document.getElementById('action_del_file1');
	action_del_file1.style.display='inline';
    
});
var attachement2 = document.getElementById('attachement2');
var file2_p = document.getElementById('file2_p');
attachement2.addEventListener('change', function() {
    // On récupère la liste des fichiers
    file2_p.innerHTML = "(2) "+document.getElementById('attachement2').value;
	var action_del_file2 = document.getElementById('action_del_file2');
	action_del_file2.style.display='inline';
    
});
var attachement3 = document.getElementById('attachement3');
var file3_p = document.getElementById('file3_p');
attachement3.addEventListener('change', function() {
    // On récupère la liste des fichiers
    file3_p.innerHTML = "(3) "+document.getElementById('attachement3').value;
	var action_del_file3 = document.getElementById('action_del_file3');
	action_del_file3.style.display='inline';
    
});
var action_del_file1 = document.getElementById('action_del_file1');
action_del_file1.addEventListener('click', function() {
    // On récupère la liste des fichiers
    document.getElementById('file1_p').innerHTML = "";
	document.getElementById('attachement1').value = "";
	action_del_file1.style.display='none';
    
});
var action_del_file2 = document.getElementById('action_del_file2');
action_del_file2.addEventListener('click', function() {
    // On récupère la liste des fichiers
    document.getElementById('file2_p').innerHTML = "";
	document.getElementById('attachement2').value = "";
	action_del_file2.style.display='none';
    
});
var action_del_file3 = document.getElementById('action_del_file3');
action_del_file3.addEventListener('click', function() {
    // On récupère la liste des fichiers
    document.getElementById('file3_p').innerHTML = "";
	document.getElementById('attachement3').value = "";
	action_del_file3.style.display='none';
    
});

$("#to_all").click(function(e) {
	var selectto = document.getElementById('dis_emails');
    if ( !$("#to_all").is(':checked') && !$("#to_mail_list").is(':checked')){
		//desactivation du champ destinataire 
		selectto.style.display='block';
	}
	else{
		selectto.style.display='none';
	}
});
$("#to_mail_list").click(function(e) {
	var selectto = document.getElementById('dis_emails');
    if ( !$("#to_mail_list").is(':checked') && !$("#to_all").is(':checked')){
		//desactivation du champ destinataire 
		selectto.style.display='block';
	}
	else{
		selectto.style.display='none';
	}
});
$("#repondre").click(function(e) {
	document.forms["form_new_msg"].reset();
    $('#myModal3').modal('hide');
	$('#myModal').modal('show');
	//alert($(this).attr('id_dest'));
	var selectize = $("#select-to")[0].selectize; //id="detail_msg_objet" id="detail_msg_objet"
	selectize.addItem($(this).attr('id_dest')); // selection du destinataire 
	//filling the object
	document.getElementById('objetMail').value = "Re: " + document.getElementById('detail_msg_objet').innerHTML;
	//filling the message origine
	document.getElementById('corps').value = "\n\n\n\n\n\n\n------------------------- Message d'origine -------------------------\n" 
		+ "Date: " + document.getElementById('detail_msg_date').innerHTML + "\n" 
		+ document.getElementById('detail_msg_corps').innerHTML;
	//descativate les options de diffusion
	document.getElementById('option_diffusion').style.display='none';
	//initialiser les attachement
	init_attachement();
	//focus sur le textarea corps message
	//$('#corps').focus();
});


$(".view-message").click(function(e) {
	//recuperer detail du message a partir du id msg
	//affichage loader
	document.getElementById('spinner').style.display='block';
	
	var url_get_msg = 'inbox/inbox_get_msg.php?id_msg=' + $(this).attr('id_msg'); //
	$.getJSON(url_get_msg, function(data) {
		document.getElementById('detail_msg_dest').innerHTML = data.nom + " &lt;" + data.mail + "&gt;";
		document.getElementById('detail_msg_date').innerHTML = data.date;
		document.getElementById('detail_msg_objet').innerHTML = data.objet;
		document.getElementById('detail_msg_corps').innerHTML = data.corps;
		if(data.attachement1 != ""){
			document.getElementById('detail_msg_attch1').innerHTML = "<span class=' icon-paper-clip'> "+ data.attachement1 +"</span>" ;
			$("#detail_msg_attch1").attr("href", data.attachement1); 
		}
		else
			document.getElementById('detail_msg_attch1').innerHTML = "" ;
		if(data.attachement2 != ""){
			document.getElementById('detail_msg_attch2').innerHTML = "<span class=' icon-paper-clip'> "+ data.attachement2 +"</span>" ;
			$("#detail_msg_attch2").attr("href", data.attachement2); 
			}
		else
			document.getElementById('detail_msg_attch2').innerHTML = "" ;
		if(data.attachement3 != ""){
			document.getElementById('detail_msg_attch3').innerHTML = "<span class=' icon-paper-clip'> "+ data.attachement3 +"</span>" ;
			$("#detail_msg_attch3").attr("href", data.attachement3); 
			}
		else
			document.getElementById('detail_msg_attch3').innerHTML = "" ;
		//modifier link repondre si c est un message recu
		if(data.sens == "IN"){
			$("#repondre").attr("id_dest", data.id_dest); 
			document.getElementById('repondre').style.display='block';
			}
		else
			document.getElementById('repondre').style.display='none';
	}).done(function() { // en cas de succès
	//masque loader
	document.getElementById('spinner').style.display='none';
	
  });
	
	$('#myModal3').modal('show');
	//decrement nb inbox non lu
	if($(this).parents("tr").attr("class") == "unread")
		init_current_marqueur();
	//marquer message comme lu
	$(this).parents("tr").removeClass('unread');
	
	
});

function init_attachement()
{
	var action_del_file1 = document.getElementById('action_del_file1');
	document.getElementById('file1_p').innerHTML = "";
	document.getElementById('attachement1').value = "";
	action_del_file1.style.display='none';
	var action_del_file2 = document.getElementById('action_del_file2');
	document.getElementById('file2_p').innerHTML = "";
	document.getElementById('attachement2').value = "";
	action_del_file2.style.display='none';
	var action_del_file3 = document.getElementById('action_del_file3');
	document.getElementById('file3_p').innerHTML = "";
	document.getElementById('attachement3').value = "";
	action_del_file3.style.display='none';
}



$("#btn_reset").click(function(e) {
	//en plus de vider les champ et checkbox:
    //supression des destinataire
	var selectize = $("#select-to")[0].selectize; 
	selectize.clear(); 
	//afficher select-to
	var selectto = document.getElementById('dis_emails');
	selectto.style.display='block';
	//supression des pieces jointes
	init_attachement();
	//activer les options de diffusion
	document.getElementById('option_diffusion').style.display='block';
	
});


//ajout evenement envoyer message
$("#form_new_msg").submit(function(e){ // On sélectionne le formulaire par son identifiant
    e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
	var erreur = 0;
    //test si aucun destinataire
	if (($("#select-to").val() == null) && !$("#to_all").is(':checked') && !$("#to_mail_list").is(':checked')){
		alert("Veuillez renseigner un ou plusieurs destinataires");
		erreur = 1;
	}else
	if ($("#objetMail").val() == ""){
		alert("Veuillez renseigner l\'objet du message.");
		erreur = 1;
	}else
	if ($("#corps").val() == ""){
		alert("Veuillez renseigner le contenu du message.");
		erreur = 1;
	}
	
	if (erreur == 0){
		document.getElementById('emails_plat').value = $("#select-to").val();
		document.forms["form_new_msg"].submit();
	}
});