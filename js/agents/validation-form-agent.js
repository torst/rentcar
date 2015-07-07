var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_agent").validate({
            rules: {
                nom: "required",
                prenom: "required",
                login: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                nom: "Veuillez renseigner le Nom",
                prenom: "Veuillez renseigner le Prénom",
                login: {
                    required: "Veuillez renseigner le Login",
                    minlength: "Le Login doit se composer au minimum de deux caractères"
                },
                email: "Veuillez renseigner l'Email"
            }
        });
        


    });


}();