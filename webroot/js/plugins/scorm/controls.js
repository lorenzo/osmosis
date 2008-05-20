/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
