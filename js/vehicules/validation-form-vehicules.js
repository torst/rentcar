var Script = function () {

    //$.validator.setDefaults({
    //    submitHandler: function() { alert("submitted!"); }
    //});

    $().ready(function() {
    	 
                // validate signup form on keyup and submit
        $("#modifier_vehicules").validate({
            rules: {
                matricule: "required"
                
            },
            messages: {
                matricule: "Veuillez renseigner le Matricule",
                
            }
        });
        


    });


}();