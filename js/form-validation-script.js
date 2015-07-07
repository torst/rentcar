var Script = function () {

    

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();
        
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
                email: "Veuillez renseigner le Email"
            }
        });

               
    });


}();