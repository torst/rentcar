var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_categorie").validate({
            rules: {
                nom: "required",
                description: "required"
            },
            messages: {
                nom: "Veuillez renseigner le Nom de la catégorie",
                description: "Veuillez renseigner la Description de la catégorie"
            }
        });
        


    });


}();