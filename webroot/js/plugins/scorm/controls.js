var ScormControl = new function(){
	this.updateUI = function(link) {
		debugGroup("Activado el link " + link.id);
		debug(link.href);
		debugGroupClose();
		id = link.id;
		id_data = id.match(/(.*)(\d+)/);
		sco_id = id_data[1];
		sco_number =  parseInt(id_data[2]);
		this.updateLinks(sco_number-1, sco_number+1, sco_id);
		return true;
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
