
	
function entrar() {
	$.ajax({
		url: "login?user=" + $("#user").val() + "&pass=" + $("#pass").val(),
		cache: false,
		dataType: "json",
		success: function(data) {
			if (data.success) {
				$().message(data.message);
				
				setTimeout(function(){
					window.location = "interno/";
				},1500);
				
			} else {
				$().message(data.message);
			}
		},
		error: function() {
			$().message("Houve uma falha ao lhe autenticar. Contacte o administrador do sistema.");
		}
	});			
}

$("#entrar").click(entrar);
$('#user, #pass').keydown(function(event) {
	if (event.keyCode == '13') {
		event.preventDefault();
		entrar();
	}
});

