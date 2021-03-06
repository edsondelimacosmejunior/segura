
		//var tabs = $(".ui-layout-center");
	

		$(document).ready( function() {

			// TABS-CENTER
			//tabs.tabs();
			
			//$('.ui-layout-center').bind('tabsshow', centralize_desc);
			
//	        $('a', ".ui-tabs-panel").live("click",function() {
//	            $(this).parents(".ui-tabs-panel").load(this.href);
//	            return false;
//	        });

			// PAGE LAYOUT
			$('body').layout({
				
				closable: false	
				,resizable:	false
				,slidable: false
				
				,north__size: 150
				,north__spacing_open: 8
				,north__spacing_closed: 8
				,north__showOverflowOnHover: true
				,north__closable: false
				,north__togglerLength_closed: '100%'
				,north__togglerLength_open: '100%'

				,north__togglerTip_open:		"Fechar o Banner Superior"
				,north__togglerTip_closed:	"Abrir o Banner Superior"
					
				,west__size: 200
				,west__spacing_open: 8
				,west__spacing_closed: 8
				,west__showOverflowOnHover: true
				,west__closable: false
				,west__togglerLength_closed: '100%'
				,west__togglerLength_open: '100%'

				,west__togglerTip_open:		"Fechar o Menu"
				,west__togglerTip_closed:	"Abrir o Menu"

			});

			centralize_desc();

			$(".ui-layout-center").removeClass("ui-corner-all");

			reset_buttons();

			$(".myMenu").buildMenu(
			{
				menuWidth:170,
				openOnRight:true,
				menuSelector: ".menuContainer",
				iconPath:"../view/imgs/menu/icons/",
				hasImages:true,
				adjustLeft:0,
				adjustTop:0,
				openOnClick:false,
				minZindex:200,
				shadow:true,
				closeOnMouseOut:true
			});
			
			

		});

		function reset_buttons() {
			
			//all hover and click logic for buttons
			$(".fg-button:not(.ui-state-disabled)")
			.hover(
				function(){ 
					$(this).addClass("ui-state-hover"); 
				},
				function(){ 
					$(this).removeClass("ui-state-hover"); 
				}
			)
			.mousedown(function(){
					$(this).parents('.fg-buttonset-single:first').find(".fg-button.ui-state-active").removeClass("ui-state-active");
					if( $(this).is('.ui-state-active.fg-button-toggleable, .fg-buttonset-multi .ui-state-active') ){ $(this).removeClass("ui-state-active"); }
					else { $(this).addClass("ui-state-active"); }	
			})
			.mouseup(function(){
				if(! $(this).is('.fg-button-toggleable, .fg-buttonset-single .fg-button,  .fg-buttonset-multi .fg-button') ){
					$(this).removeClass("ui-state-active");
				}
			});
			
		}
		
		// Centralizando a descrição das áreas de trabalho.
		function centralize_desc() {
			$('.area_descricao').each(function() {
				$(this).css("left",$(".ui-layout-center").width()/2 - $(this).width()/2);
				$(this).css("top",$(".ui-layout-center").height()/2 - $(this).height()/2 - 30);
			});
		}
		
		function selected_tab() {
			return $( "#tab0");
		}
		
		function openlink(url) {
			
			$.ajax({
				url: url,
				cache: false,
				success: function(data) {
				
					if (data.substring(0,1) == "{") {
					
						var d = eval('(' + data + ')');
				
						$().message(d.message);
						return;
					}
					
					$("#tab0").html(data);
					
					$("#status span").html("");
					
					reset_buttons();
					
				},
				error: function(data) {
					$().message("Desculpe. Não foi possível concluir sua solicitação.");
				}
			});
			
		}
		
		function status(text) {
			if (text)
				$("#status span").html(text);
			else
				$("#status span").html("");
		}
		
		
		
		function get_elemento(elemento_atual,elemento_procurado) {
			return $(elemento_atual).parents(".aba").find(elemento_procurado);
		}

