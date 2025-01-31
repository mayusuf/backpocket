$(document).ready(function(){

	$("form#data").submit(function(e){

		e.preventDefault();
		
		let formData = new FormData(this);

		let name = $(".name").val();
		let image = $("#image")[0].files;

		if(name == "" || image.length == 0){

			alert("Name or Image Field should not Empty!!");
			return false;
		}

		$.ajax({
			 type: "POST",
			 url: "AccountCreateController.php",
			 data: formData,
			 cache: false,
			 contentType: false,
        	 processData: false,
			 success: function(data) {
			 	$(".name").val("");
			 	alert(data);			 	
			 },
			 error: function(xhr, status, error) {
			 	console.error(xhr);
			 	}
			 });		

	});

});

