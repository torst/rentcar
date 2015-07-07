//date picker start

    if (top.location != location) {
        top.location.href = document.location.href ;
    }
    $(function(){
        window.prettyPrint && prettyPrint();
        $('.dp1').datepicker({
            format: 'dd/mm/yyyy',
			autoclose: true,
			weekStart: 1
        });
		$('.dp2').datepicker({
            format: 'dd/mm/yyyy',
			autoclose: true,
			weekStart: 1
        });
		
        
        
         
    });

//date picker end
