
// var refreshId = setInterval(function()
// {
//      $('#responsecontainer').fadeOut(300).load('includes/Basic_divs/refresh_totals_div.php').fadeIn(1500);
// }, 15000);





(function newjobs() {

	//alert('trexeiiiiiii');

    var inputjob = $.ajax({
    					method:'GET',
                        url: "includes/Basic_divs/refresh_totals_div.php"
                   });

    inputjob.done(function(data) { 

    	$('#responsecontainer').fadeOut(300).html(data).fadeIn(1500);
        setTimeout(newjobs, 15000); // recursion
    });


    inputjob.fail(function(jqXHR, textStatus, errorThrown) { 
        alert('error' + errorThrown);
    });


})();