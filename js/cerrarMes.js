$(document).ready(function(){
	
	$( "#cerrar" ).click(function() {

		$.blockUI({ message: $('#question'), css: { width: '275px' } }); 
	});
	
	$('#yes').click(function() { 
//        // update the block message 
//        $.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
//
//        $.ajax({ 
//            url: 'generaCorreoValidador.php', 
//            cache: false, 
//            complete: function() { 
//                // unblock when remote call returns 
//                $.unblockUI(); 
//            } 
//        });
		
		location.href="generaCorreoValidador.php";
    }); 

    $('#no').click(function() { 
        $.unblockUI(); 
        return false; 
    }); 
});
