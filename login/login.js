$(document).ready(function(){		// ultimoTurno();		$("#form_login").submit(function(event){		event.preventDefault();		$("#btn_login").prop("disabled", true);		$("#spinner").toggleClass("hide");		$.ajax({			"url": "login.php", 			"method": "POST", 			"data": $("#form_login").serialize(),			"success" : function(response, status){				$("#btn_login").prop("disabled", false);				if(response.login == "valid"){					alertify.success("Acceso Correcto");					switch(response.permisos){						case 'caja':						location.href="../index.php";						break;						case 'administrador':						location.href="../productos/catalogo.php";						break;						case 'mostrador':						location.href="../index.php";						break;					}					}else{					alertify.error(response.mensaje);				}			},			"error": function(xhr, textStatus, errno){				console.log(xhr);				console.log(textStatus);				console.log(errno);				alertify.error("ERROR: " + textStatus);			}			}).always(function(){			$("#spinner").toggleClass("hide");			$("#btn_login").prop("disabled", false);		});	});});