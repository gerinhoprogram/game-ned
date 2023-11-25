<?php
function geradorTags($valor)
{
	$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç",
					 "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç",
					 "/", "- ", ",", "?", "&", "º", "ª", "|", "'", "(", ")", ":");

	$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c",
					 "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C",
					 "", "", "", "", "", "", "", "", "", "", "", "");

	$tags = str_replace($array1, $array2, utf8_decode($valor));
	$tags = strtolower($tags);
	$tags = str_replace(' ', '-', $tags);
	
	return $tags;
}
function bindFields($fields){
    end($fields);
    $lastField = key($fields);

    $bindString = ' ';
    foreach($fields as $field => $data){ 
            $bindString .= $field . '=:' . $field; 
            $bindString .= ($field === $lastField ? ' ' : ',');
    }
    return $bindString;
}
function bindFields2($fields){
    end($fields);
    $lastField = key($fields);

    $bindString = ' ';
    foreach($fields as $field => $data){ 
            $bindString .= ':' . $data; 
            $bindString .= ($field === $lastField ? ' ' : ',');
    }
    return $bindString;
}
function truncate( $string, $length, $truncateAfter = TRUE, $truncateString = '...' ) {
    if( strlen( $string ) <= $length ) {
        return $string;
    }
    $position = ( $truncateAfter == TRUE ? strrpos( substr( $string, 0, $length ), ' ' ) :
                                            strpos( substr( $string, $length ), ' ' ) + $length );
    return substr( $string, 0, $position ) . $truncateString;
}
function NormalizaURL($str){
    $str = strtolower(utf8_decode($str)); $i=1;
    $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
    $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
    while($i>0) $str = str_replace('--','-',$str,$i);
    if (substr($str, -1) == '-') $str = substr($str, 0, -1);
    return $str;
}
?>
<script language="javascript">
function ativaItem (id)
{
	if(jQuery("#item_check_"+id).is(':checked'))
	{
		jQuery("#item_"+id).removeAttr('disabled');
	}
	else
	{
		jQuery("#item_"+id).val('');
		jQuery("#item_"+id).attr('disabled', true);
	}
}
function alteraActionProduto(nt_id)
{
	jQuery("#form_cadastro_cursos").attr("action","cadastro_cursos.php?pagina=cadastro_cursos_editar&action=editar&nt_id="+nt_id+"<?php echo $autenticacao;?>");
	jQuery("#form_cadastro_cursos").submit();
}
jQuery(document).on('click','input.close_janela, .ui-dialog-titlebar-close',function() { 
	jQuery('#mask , .janela, .janelaAcao').fadeOut(100 , function() {
		jQuery('.janela, .janelaAcao').fadeOut(100 , function() {
		jQuery('#mask').remove();  
		jQuery('body').css({'overflow':'visible'});
		});
	}); 
	return false;
});

function alteraActionProduto(agnd_id)
{
	jQuery("#form_cadastro_agenda").attr("action","cadastro_agenda.php?pagina=cadastro_agenda_editar&action=editar&agnd_id="+agnd_id+"<?php echo $autenticacao;?>");
	jQuery("#form_cadastro_agenda").submit();
}
jQuery(document).on('click','input.close_janela, .ui-dialog-titlebar-close',function() { 
	jQuery('#mask , .janela, .janelaAcao').fadeOut(100 , function() {
		jQuery('.janela, .janelaAcao').fadeOut(100 , function() {
		jQuery('#mask').remove();  
		jQuery('body').css({'overflow':'visible'});
		});
	}); 
	return false;
});

jQuery(document).on('change','.fot_principal',function() 
{ 

	if(jQuery(this).val() == "Sim")
	{
		jQuery('.fot_principal').not(this).val("Não");
	}
});

jQuery(document).ready(function()
{
	jQuery("#bt_cadastro_fotos").click(function()
	{
		abreMask(
		'<img src=../imagens/carregando.gif><br>Aguarde, as imagens estão sendo enviadas.<br><br>');
	});
	
	/* DIV LOGOUT */
	jQuery('input.close_janela').on('click', function() { 
		jQuery('#mask , .janela').fadeOut(100 , function() {
			jQuery('.janela').fadeOut(100 , function() {
			jQuery('#mask').remove();  
			jQuery('body').css({'overflow':'visible'});
			});
		}); 
		return false;
	});
	/* FIM DIV LOGOUT */
	

	/*----------- VERIFICAÇÃO FORMULÁRIO --------------*/
	
	
	jQuery("select[name=fil_categoria]").change(function()
	{
		jQuery("div.noticias").html('Carregando...');
		jQuery.post("mod_includes/php/procura_agenda.php",
		{
			fil_categoria:jQuery(this).val()
			
		},
		function(valor) // Carrega o resultado acima para o campo catadm
		{
			jQuery("div.noticias").html(valor);
		});
	});
		
	jQuery("#bt_contato").click(function()
	{
		contato = 0;
		if(jQuery("#nome").val() == '')
		{
			contato++;
			jQuery("#nome").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#nome").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#email").val() == '')
		{
			contato++;
			jQuery("#email").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#email").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#telefone").val() == '')
		{
			contato++;
			jQuery("#telefone").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#telefone").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#mensagem").val() == '')
		{
			contato++;
			jQuery("#mensagem").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#mensagem").css({"border" : "1px solid #AAA"});
		}
		if(contato == 0)
		{
			jQuery("#form_contato").submit();
		}
		else
		{
			jQuery("#erro").html("Por favor verifique os campos obrigatórios em vermelho");
		}
	});
	jQuery("#bt_curriculo").click(function()
	{
		curriculo = 0;

		if(jQuery("#nome").val() == '')
		{
			curriculo++;
			jQuery("#nome").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#nome").css({"border" : "1px solid #AAA"});
		}

		if(jQuery("#cargo").val() == '')
		{
			curriculo++;
			jQuery("#cargo").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#cargo").css({"border" : "1px solid #AAA"});
		}

		if(curriculo == 0)
		{
			jQuery("#form_curriculo").submit();
		}
		else
		{
			jQuery("#erro").html("Por favor verifique os campos obrigatórios em vermelho");
		}
	});
	
	
	jQuery("#agendar").click(function()
	{
		agenda = 0;
		if(jQuery("#select").val() == 'Selecione uma Especialidade...')
		{
			agenda++;
			jQuery("#select").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#select").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#nome").val() == '')
		{
			agenda++;
			jQuery("#nome").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#nome").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#cpf").val() == '')
		{
			agenda++;
			jQuery("#cpf").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#cpf").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#dt_nasc").val() == '')
		{
			agenda++;
			jQuery("#dt_nasc").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#dt_nasc").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#telefone").val() == '')
		{
			agenda++;
			jQuery("#telefone").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#telefone").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#celular").val() == '')
		{
			agenda++;
			jQuery("#celular").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#celular").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#email").val() == '')
		{
			agenda++;
			jQuery("#email").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#email").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#tipo:checked").val() == '2')
		{
			if(jQuery("#cpf").val() == '')
			{
				agenda--;
				jQuery("#cpf").css({"border" : "1px solid #AAA"});
			}
			if(jQuery("#dt_nasc").val() == '')
			{
				agenda--;
				jQuery("#dt_nasc").css({"border" : "1px solid #AAA"});
			}
			
			if(jQuery("#nome_resp").val() == '')
			{
				agenda++;
				jQuery("#nome_resp").css({"border" : "1px solid #F90F00"});
			}
			else
			{
				jQuery("#nome_resp").css({"border" : "1px solid #AAA"});
			}
			
			if(jQuery("#cpf_resp").val() == '')
			{
				agenda++;
				jQuery("#cpf_resp").css({"border" : "1px solid #F90F00"});
			}
			else
			{
				jQuery("#cpf_resp").css({"border" : "1px solid #AAA"});
			}
		}
		
		
		if(agenda == 0)
		{
			jQuery("#form_cadastro_consulta").submit();
		}
		else
		{
			jQuery("#erro").html("Por favor verifique os campos obrigatórios em vermelho");
		}
	});
	
	jQuery("#bt_news").click(function()
	{
		news = 0;
		if(jQuery("#nome_news").val() == '')
		{
			news++;
			jQuery("#nome_news").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#nome_news").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#email_news").val() == '')
		{
			news++;
			jQuery("#email_news").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#email_news").css({"border" : "1px solid #AAA"});
		}
		if(news == 0)
		{
			jQuery("#form_news").submit();
		}
		else
		{
			jQuery("#erro_news").html("Por favor verifique os campos obrigatórios em vermelho");
		}
	});
	
	jQuery("#bt_orcamento").click(function()
	{
		orcamento = 0;
		if(jQuery("#noticia_selecionado").val() == '')
		{
			orcamento++;
			jQuery("#noticia_selecionado").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#noticia_selecionado").css({"border" : "1px solid #AAA"});
		}
		
		if(jQuery("#nome").val() == '')
		{
			orcamento++;
			jQuery("#nome").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#nome").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#email").val() == '')
		{
			orcamento++;
			jQuery("#email").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#email").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#telefone").val() == '')
		{
			orcamento++;
			jQuery("#telefone").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#telefone").css({"border" : "1px solid #AAA"});
		}
		if(jQuery("#mensagem").val() == '')
		{
			orcamento++;
			jQuery("#mensagem").css({"border" : "1px solid #F90F00"});
		}
		else
		{
			jQuery("#mensagem").css({"border" : "1px solid #AAA"});
		}
		if(orcamento == 0)
		{
			jQuery("#form_orcamento").submit();
		}
		else
		{
			jQuery("#erro").html("Por favor verifique os campos obrigatórios em vermelho");
		}
	});

/// CADASTRO_USUARIOS ///
	jQuery("#box_foto_perfil").click(function()
	{
		jQuery("#foto_perfil").dialog();
		jQuery('body').append('<div id="mask"></div>');
		jQuery('#mask').fadeIn(300);
	});
	jQuery("#bt_foto_perfil").click(function()
	{
		if(cont_usu_foto == 0 && cont_usu_foto_area == 0)
		{
			jQuery("#form_foto_perfil").submit();
		}
	});
	var cont_usu_foto=0;
	var cont_usu_foto_area=0;
	jQuery("#usu_foto").change(function(){
		
	if(jQuery("#usu_foto").val() != "")
	{
		jQuery.post("../mod_includes/php/valida_extensao_foto.php",
		{
			ext:jQuery("#usu_foto").val()	
		},
		function(valor) // Carrega o resultado acima para o campo
		{
			if(valor == 'true')
			{
				cont_usu_foto++;
				jQuery("#usu_foto").css({"border" : "1px solid #F00"});
				jQuery('#usu_foto_erro').html("A extensão \""+ jQuery("#usu_foto").val().substr(-4)  +"\" do arquivo não é válida.");
			}
			else
			{
				jQuery.post("../mod_includes/php/valida_tamanho.php",
				{
					tam:jQuery("#usu_foto")[0].files[0].size		
				},
				function(valor) // Carrega o resultado acima para o campo
				{
					if(valor == 'true')
					{
						cont_usu_foto++;
						jQuery("#usu_foto").css({"border" : "1px solid #F00"});
						jQuery("#usu_foto_erro").html("O tamanho do arquivo não pode ser maior do que 5MB.");
					}
					else
					{
						cont_usu_foto = 0;
						jQuery("#usu_foto").css({"border" : "1px solid #999"});
						jQuery('#usu_foto_erro').html("");
					}
				})
			}
		})
	}
	});
	jQuery("#img_perfil, #bt_foto_perfil").on("mouseover focus",function()
	{
		var dimensao = jQuery("#filedim_1").val().split("x");
		if(dimensao[0] < 250 || dimensao[1] < 250)
		{
			cont_usu_foto_area++;
			jQuery("#usu_foto").css({"border" : "1px solid #F00"});
			jQuery("#usu_foto_erro2").html("A imagem deve ter no mínimo 250x250px.");
			jQuery("#jcrop_perfil").remove();
			jQuery("#img_perfil").html("Nova Imagem:<br><center><img id='jcrop_perfil'/></center>");
		}
		else
		{
			if(jQuery("#w_1").val() < 250 || jQuery("#h_1").val() < 250)
			{
				cont_usu_foto_area++;
				jQuery("#usu_foto").css({"border" : "1px solid #F00"});
				jQuery('#usu_foto_erro').html("Selecione uma área de no mínimo 250x250 px.");
			}
			else
			{
				cont_usu_foto_area=0;
				jQuery("#usu_foto").css({"border" : "1px solid #999"});
				jQuery('#usu_foto_erro').html("");
				jQuery('#usu_foto_erro2').html("");
			}
			
		}
	});
	
	jQuery("#bt_admin_usuarios").click(function()
	{
		admin_usuarios=0;
		if(jQuery("#usu_setor").val() == ''){admin_usuarios++;jQuery("#usu_setor").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#usu_setor").css({"border" : "1px solid #AAA"});}
		if(jQuery("#usu_nome").val() == ''){admin_usuarios++;jQuery("#usu_nome").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#usu_nome").css({"border" : "1px solid #AAA"});}
		if(jQuery("#usu_login").val() == ''){admin_usuarios++;jQuery("#usu_login").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#usu_login").css({"border" : "1px solid #AAA"});}
		if(jQuery("#usu_senha").val() == ''){admin_usuarios++;jQuery("#usu_senha").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#usu_senha").css({"border" : "1px solid #AAA"});}
		if(admin_usuarios == 0)
		{
			jQuery("#form_admin_usuarios").submit();
		}

		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});

/// AUXILIAR - CATEG ///
	jQuery("#bt_aux_categorias").click(function()
	{
		aux_categorias=0;
		if(jQuery("#cat_descricao").val() == ''){aux_categorias++;jQuery("#cat_descricao").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#cat_descricao").css({"border" : "1px solid #AAA"});}
		if(aux_categorias == 0)
		{
			jQuery("#form_aux_categorias").submit();
		}
		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});

/// AUXILIAR - SUBCATEGORIAS ///
	jQuery("#bt_aux_subcategorias").click(function()
	{
		aux_categorias=0;
		if(jQuery("#subcat_descricao").val() == ''){aux_categorias++;jQuery("#subcat_descricao").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#subcat_descricao").css({"border" : "1px solid #AAA"});}
		if(aux_categorias == 0)
		{
			jQuery("#form_aux_subcategorias").submit();
		}
		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});
	
/// CADASTRO - NOTICIAS ///
	jQuery("#bt_cadastro_peixes, #bt_cadastro_peixes_sair").click(function()
	{
		cadastro_peixes=0;
		if(jQuery("#pex_nome_cientifico").val() == ''){cadastro_peixes++;jQuery("#pex_nome_cientifico").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#pex_nome_cientifico").css({"border" : "1px solid #AAA"});}
		if(jQuery("#portugues").val() == ''){cadastro_peixes++;jQuery("#portugues").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#portugues").css({"border" : "1px solid #AAA"});}

		if(cadastro_peixes == 0)
		{
			if(jQuery(this).val() == "Salvar")
			{
				jQuery("#form_cadastro_peixes").attr("action","cadastro_peixes.php?pagina=cadastro_peixes_editar&action=adicionar&nt_id=<?php echo $pex_id.$autenticacao;?>");
			}
			jQuery("#form_cadastro_peixes").submit();
		}
		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});
	
	/*------------------- FIM VERIFICAÇÃO FORMULÁRIO ----------------------*/
	
/// CADASTRO - VIDEOS ///
	jQuery("#bt_cadastro_videos, #bt_cadastro_videos_sair").click(function()
	{
		cadastro_videos=0;
		if(jQuery("#vid_link").val() == ''){cadastro_videos++;jQuery("#vid_link").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#vid_link").css({"border" : "1px solid #AAA"});}
		if(cadastro_videos == 0)
		{
			if(jQuery(this).val() == "Salvar")
			{
				jQuery("#form_cadastro_videos").attr("action","cadastro_videos.php?pagina=cadastro_videos_editar&action=adicionar&vid_id=<?php echo $nt_id.$autenticacao;?>");
			}
			jQuery("#form_cadastro_videos").submit();
		}
		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});
	/*------------------- FIM VERIFICAÇÃO FORMULÁRIO ----------------------*/
	
	
	/// CADASTRO - FOTOS ///
	jQuery("#bt_cadastro_albuns").click(function()
	{
		cadastro_albuns=0;
		if(jQuery("#alb_titulo").val() == ''){cadastro_albuns++;jQuery("#alb_titulo").css({"border" : "1px solid #F90F00"});}
		else{jQuery("#alb_titulo").css({"border" : "1px solid #AAA"});}
		if(cadastro_albuns == 0)
		{
			jQuery("#form_cadastro_albuns").submit();
		}
		else
		{
			jQuery('#erro').html("Por favor verifique os campos obrigatórios em vermelho");	
		}
	});

});

/* --------- FUNCOES GERAIS  ------------ */


function link_mask(url)
{
	document.location.href=url;
}

function abreMask (msg)
{	
	jQuery('body').append('<div id="mask"></div>');
	jQuery('#mask').fadeIn(300);
	jQuery('#janela').html(msg);
	jQuery("#janela").fadeIn(300);
	jQuery('#janela').css({"display":"table"});
	//jQuery('body').css({'overflow':'hidden'});
	
	var popMargTopJanela = (jQuery("#janela").height() + 24) / 2; 
	var popMargLeftJanela = (jQuery("#janela").width() + 24) / 2; 
	
	jQuery("#janela").css({ 
		'margin-top' : -popMargTopJanela,
		'margin-left' : -popMargLeftJanela
	});
}

function PrintDiv(div)
{
	$('#'+div).show().printElement();
}

function submitenter(myfield,e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if (keycode == 13)
	{
		jQuery("#form_newsletter").submit();
		return false;
	}
	else
	return true;
} 	
		
	function sleep(milliseconds)
	{
		setTimeout(function(){
		var start = new Date().getTime();
		while ((new Date().getTime() - start) < milliseconds){
		// Do nothing
		}
		},0);
	}
	
	function blink(selector)
	{
		jQuery(selector).fadeOut('slow', function() {
			jQuery(this).fadeIn('slow', function() {
				blink(this);
			});
		});
	}
	blink('.piscar');
	
	function validaCPF(cpf)
	{
		cpf = cpf.replace(".", "");
		cpf = cpf.replace(".", "");
		cpf = cpf.replace("-", "");
	
		  var numeros, digitos, soma, i, resultado, digitos_iguais;
		  digitos_iguais = 1;
		  if (cpf.length < 11)
				return false;
		  for (i = 0; i < cpf.length - 1; i++)
				if (cpf.charAt(i) != cpf.charAt(i + 1))
					  {
					  digitos_iguais = 0;
					  break;
					  }
		  if (!digitos_iguais)
				{
				numeros = cpf.substring(0,9);
				digitos = cpf.substring(9);
				soma = 0;
				for (i = 10; i > 1; i--)
					  soma += numeros.charAt(10 - i) * i;
				resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
				if (resultado != digitos.charAt(0))
					   return false;
				numeros = cpf.substring(0,10);
				soma = 0;
				for (i = 11; i > 1; i--)
					  soma += numeros.charAt(11 - i) * i;
				resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
				if (resultado != digitos.charAt(1))
					  return false;
				return true;
				}
		  else
				return false;
	}
	
	function validaCNPJ(cnpj)
	{
		//cpf = cpf.replace(".", "");
		//cpf = cpf.replace(".", "");
		//cpf = cpf.replace("-", "");
	
		 cnpj = cnpj.replace(/[^\d]+/g,'');
	 
		if(cnpj == '') return false;
		 
		if (cnpj.length != 14)
			return false;
	 
		// Elimina CNPJs invalidos conhecidos
		if (cnpj == "00000000000000" || 
			cnpj == "11111111111111" || 
			cnpj == "22222222222222" || 
			cnpj == "33333333333333" || 
			cnpj == "44444444444444" || 
			cnpj == "55555555555555" || 
			cnpj == "66666666666666" || 
			cnpj == "77777777777777" || 
			cnpj == "88888888888888" || 
			cnpj == "99999999999999")
			return false;
			 
		// Valida DVs
		tamanho = cnpj.length - 2
		numeros = cnpj.substring(0,tamanho);
		digitos = cnpj.substring(tamanho);
		soma = 0;
		pos = tamanho - 7;
		for (i = tamanho; i >= 1; i--) {
		  soma += numeros.charAt(tamanho - i) * pos--;
		  if (pos < 2)
				pos = 9;
		}
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(0))
			return false;
			 
		tamanho = tamanho + 1;
		numeros = cnpj.substring(0,tamanho);
		soma = 0;
		pos = tamanho - 7;
		for (i = tamanho; i >= 1; i--) {
		  soma += numeros.charAt(tamanho - i) * pos--;
		  if (pos < 2)
				pos = 9;
		}
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(1))
			  return false;
			   
		return true;
	}
	
	function validaRG(numero)
	{
		numero = numero.replace(".", "");
		numero = numero.replace(".", "");
		numero = numero.replace("-", "");
		/*
		##  Igor Carvalho de Escobar
		##    www.webtutoriais.com
		##   Java Script Developer
		*/
		var numero = numero.split("");
		tamanho = numero.length;
		vetor = new Array(tamanho);
	 
		if(tamanho>=1)
		{
		 vetor[0] = parseInt(numero[0]) * 2; 
		}
		if(tamanho>=2){
		 vetor[1] = parseInt(numero[1]) * 3; 
		}
		if(tamanho>=3){
		 vetor[2] = parseInt(numero[2]) * 4; 
		}
		if(tamanho>=4){
		 vetor[3] = parseInt(numero[3]) * 5; 
		}
		if(tamanho>=5){
		 vetor[4] = parseInt(numero[4]) * 6; 
		}
		if(tamanho>=6){
		 vetor[5] = parseInt(numero[5]) * 7; 
		}
		if(tamanho>=7){
		 vetor[6] = parseInt(numero[6]) * 8; 
		}
		if(tamanho>=8){
		 vetor[7] = parseInt(numero[7]) * 9; 
		}
		if(tamanho>=9){
			if(numero[8] == 'x')
			{
				vetor[8] = 10*100;
			}
			else
			{
				vetor[8] = parseInt(numero[8]) * 100;
			}
		}
		 
		 total = 0;
		 
		if(tamanho>=1){
		 total += vetor[0];
		}
		if(tamanho>=2){
		 total += vetor[1]; 
		}
		if(tamanho>=3){
		 total += vetor[2]; 
		}
		if(tamanho>=4){
		 total += vetor[3]; 
		}
		if(tamanho>=5){
		 total += vetor[4]; 
		}
		if(tamanho>=6){
		 total += vetor[5]; 
		}
		if(tamanho>=7){
		 total += vetor[6];
		}
		if(tamanho>=8){
		 total += vetor[7]; 
		}
		if(tamanho>=9){
		 total += vetor[8]; 
		}
		 
		 alert(total);
		 resto = total % 11;
		if(resto!=0){
		return false;
		}
		else{
		return true;
		}
	}
</script>