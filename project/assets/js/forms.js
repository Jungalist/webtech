$(document).ready(function(){


   $("#category").change(function()
   {
	  
		$(".extra").empty();
		var category = $("#category").find(':selected').text();
			
		switch (category){
			case "Paper":
				$("#fields").removeClass('hidden');
				$(".extra").append("<label>DOI</label><br /><input type='text' class='form-control' required='required' class='form-control' name='doi'> <br />");
				break;
			case "Data":
				$("#fields").removeClass('hidden');
				$(".extra").append("<label>Paper DOI</label><br /><input type='text' required='required' class='form-control' name='doi'> <br />");
				break;
			case "Source code":
				$("#fields").removeClass('hidden');
				$(".extra").append("<label>Language</label><br /><input type='text' required='required' class='form-control' name='language'> <br />");
				$(".extra").append("<label>Platform</label><br /><input type='text' required='required' class='form-control' name='platform'> <br />");
				break;
			case "App":
				$("#fields").removeClass('hidden');
				$(".extra").append("<label>Use</label><br /><input type='text' required='required' class='form-control' name='use'> <br />");
				$(".extra").append("<label>Platform</label><br /><input type='text' required='required' class='form-control' name='platform'> <br />");
				break;
			
		}
			
			
	  
	  
		
   });
   
   
	var count = 1;
	var max = 5;
   $("#addauthor").click(function(){
		
		if (count === max)  {
			alert("You have reached the limit of adding " + count + " authors");
		}
		else {
			count++;
			$("#authors").append("<label>Author " + count + "</label><input type='text' required='required' name='authorArray[]' class='form-control'/>")
			}
				
	});
   
  
   
    $('#datepicker')
        .datepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/1970',
            endDate: '0'
        })
        .on('changeDate', function(e) {
			$('.datepicker').hide();
            $('#datepicker').formValidation();
			 
        });
    

});



