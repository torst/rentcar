$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

function decremente_marqueur(libelle_selector)
{
	//recuperation nombre mssages non lus et decremente
	var nb = 0;
	var selector_jq = "#"+libelle_selector;
	var selector_js = libelle_selector;
	if(document.getElementById(selector_js) != null){
		nb =  $(selector_jq).text() - 1;
		if (nb < 0)
			nb = 0;
		//modification valeur nombre messages
		document.getElementById(selector_js).innerHTML = nb;
		//si nombre egale a 0, masquer marqueur
		if (nb == 0)
			document.getElementById(selector_js).style.display = 'none';
	}
}

function init_inbox_marqueur(libelle_selector, nombre)
{
	
	//recuperation nombre mssages non lus et decremente
	var selector_js = libelle_selector;
	if(document.getElementById(selector_js) != null){
		//modification valeur nombre messages
		document.getElementById(selector_js).innerHTML = nombre;
		//si nombre egale a 0, masquer marqueur
		if (nombre == 0)
			document.getElementById(selector_js).style.display = 'none';
		else{
			document.getElementById(selector_js).style.display = 'block';
			if(libelle_selector == "header_nb_msg_txt")
				document.getElementById(selector_js).style.display = 'inline';
		}
	}
}



function init_current_marqueur()
{
	var label = "1";
	if($.urlParam('label')!= null)
		label = $.urlParam('label'); //recuperation du label du message lu
	if(label == "1")
		decremente_marqueur("nb_inbox_nl");
	if(label == "2")
		decremente_marqueur("nb_important_nl");
	if(label == "3")
		decremente_marqueur("nb_traite_nl");
	if(label == "4")
		decremente_marqueur("nb_corbeille_nl");
	//update marker menu
	decremente_marqueur("menu_nb_msg");
	decremente_marqueur("header_nb_msg");
	decremente_marqueur("header_nb_msg_txt");
}

function init_all_marqueurs()
{
	var old_nb = 0;
	var new_nb = 0;
	if(document.getElementById('menu_nb_msg') != null) 
		old_nb = $("#menu_nb_msg").text();
		
	//connecte serveur to get the numbers with getJson
	var url_get_msg = 'inbox/inbox_get_nb_msg.php'; 
	$.getJSON(url_get_msg, function(data) {
		//update the markers
		init_inbox_marqueur("nb_inbox_nl",data.inbox);
		init_inbox_marqueur("nb_important_nl",data.important);
		init_inbox_marqueur("nb_traite_nl",data.traite);
		init_inbox_marqueur("nb_corbeille_nl",data.corbeille);
		init_inbox_marqueur("menu_nb_msg",data.allmsg);
		init_inbox_marqueur("header_nb_msg",data.allmsg);
		init_inbox_marqueur("header_nb_msg_txt",data.allmsg);
		//si nouveau message
		new_nb = data.allmsg;
		if(old_nb != "")
			if(new_nb != old_nb){
				setInterval(FaireClignoter,900); 
				$("#action_refresh").removeClass("btn-primary").addClass("btn-danger");
				}
	});
}

function FaireClignoter (){
  if(document.getElementById('action_refresh') != null) 
   	$("#action_refresh").fadeOut(500).fadeIn(400);  //header_nb_msg
} 

