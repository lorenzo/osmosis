var ScormControl = new function(){
	this.updateUI = function(link) {
		debugGroup("Activado el link " + link.id);
		debug(link.href);
		debugGroupClose();
		var href = link.href;
		var id = link.id;
		var id_data = id.match(/(.*)(\d+)/);
		var local_sco_id = id_data[1];
		var local_sco_number =  parseInt(id_data[2]);
		this.updateLinks(local_sco_number-1, local_sco_number+1, local_sco_id);
		//alert('Luego de cerrar esta ventana, espere un momento... ' +href);
		var className = link.className;
		debug('ClassName' + className);
		id_data = className.match(/(.*)(\d+)/);
		var sco_id = parseInt(id_data[2]);		

		$('script#api').remove();
		debug('<h1><img src="' + webroot + 'img/loading.gif" /> Cargando...</h1>');
		$.blockUI('<h1><img src="' + webroot + '/img/loading.gif" /> Cargando...</h1>'); 
		$('head').createAppend(
			'script',
			{
				'id' : 'api',
				'src' : webroot + 'scorm/scos/api/' + sco_id + '.js',
				'type' : 'text/javascript',
				'onload' : function() {
					$('iframe#viewport')[0].src = href;
					$.unblockUI();
				}
			}
		);

		
		return false;
	}
	
	this.setupLinks = function() {
		
	}
	
	this.updateLinks = function(prev, next, id) {
		this.updateLink(id+prev, 'previous');
		this.updateLink(id+next, 'next');
	}

	this.updateLink = function(id, which) {
		link_id = 'scorm_control_' + which;
		if (document.getElementById(id)!=null) {
			var link_element = document.getElementById(link_id);
			link_element.href = document.getElementById(id).href;
			debugGroup("LE PONGO: " + id);
			debugGroupClose();
			link_element.className = id;
			link_element.style.display = "inline";
			link_element.onclick = function() {
				var className = this.className;
				var id_data = className.match(/(.*)(\d+)/);
				debugGroup('Aja: ' + className);
				debug(id_data);
				debug(id_data[1] + (id_data[2]))
				debugGroupClose();
				var link = document.getElementById(id_data[1] + (id_data[2]));
				ScormControl.updateUI(link);
			}
		} else {
			document.getElementById(link_id).style.display = "none";
		}
	}
}
