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

jQuery.fn.lockerItem = function(params) {
	var active = null;
	var lockerItemSetting = {
		updating		: 'Updating...',
		ok				: 'OK',
		cancel			: 'Cancel',
		urlFolders		: window.location,
		urlDocuments	: window.location
	};
	lockerItemSetting = jQuery.merge(params, lockerItemSetting);
	
	function makeEditable(ct, c, selector, inputType, field) {
		var editableSelector = selector + '-1';
		$(editableSelector, ct[0]).remove();
		var element = $(selector, ct[0]),
			content = element.text(),
			parent = element.parent(),
			url = lockerItemSetting.urlFolders,
			model = 'LockerFolder';
		var oldValue = element.text();
		parent.createPrepend(element.get(0).nodeName, {id : editableSelector.replace('#', '')}, content);
		if ($(active).hasClass('document')) {
			url = lockerItemSetting.urlDocuments;
			model = 'LockerDocument';
		}
		var options = {type : inputType};
		if (inputType=='autogrow') {
			console.debug('jo');
			options.submit = lockerItemSetting.ok;
			options.cancel = lockerItemSetting.cancel;
			options.height = 'auto';
			options.autogrow = {
	           lineHeight : 16,
	           minHeight  : 32
	        };
			options.onblur = 'ignore';
		}
		$(editableSelector, ct[0]).editable(
			function(value, settings) {
				var data = new Object();
				data['data[' + model + '][id]'] = active.rev;
				data['data[' + model + '][' + field + ']'] = value;
				$.post(url, data,
					function(data) {
						if (data.response.status == 'error') {
							alert(data.flash.message);
							$(editableSelector).text(oldValue);
							return;
						}
						var shortened = value
							ext = '';
						if (value.length > 20) {
							var plus = 0;
							ext = '[...]';
							shortened = shortened.split('.');
							if (shortened.length == 1) {
								shortened = value;
							} else {
								plus = -4;
								ext += '.' + shortened.pop();
								shortened = shortened.join('.');
							}
							shortened = shortened.replace(' ', '^').substr(0, 15 + plus);
						}
						if (field=='name')
							$(active)
								.html(shortened.wordWrap(10, "<br />", 2).replace('^', ' ') + ext)
								.attr('title', value)
								.lockerItem(lockerItemSetting);
						$(editableSelector).text(value);
					},'json'
				);
				return lockerItemSetting.updating;
			}, options
		);
	}
	
	return $(this).cluetip({
		sticky: true,
		positionBy : 'fixed',
		topOffset : 0,
		ajaxCache : false,
		closePosition: 'bottom',
		closeText : '',
		leftOffset : -290,
		topOffset : 60,
		clickThrough : true,
		cursor : 'hand',
		fx : {
			open : 'fadeIn',
			openSpeed:  'fast'
		},
		width : 200,
		cluezIndex : 10000,
		arrows : true,
		dropShadow : false,
		onActivate : function(e) {
			active = e[0];
			return true;
		},
		onShow : function(ct, c) {
			console.debug('jojojojo');
			makeEditable(ct, c, '#cluetip-title', 'text', 'name');
			if (!$(active).hasClass('folder')) {
				makeEditable(ct, c, '#document-description', 'autogrow', 'description');
			}
			$('body').block({message : null, overlayCSS: {backgroundColor: '#f00', color: '#fff', cursor : 'dafault'}});
			$('#cluetip-inner a').click(function(evt) {
				window.location = this.href;
				// console.debug(this);
			});
		}
	})
}

String.prototype.wordWrap = function(m, b, c){
    var i, j, s, r = this.split("\n");
    if(m > 0) for(i in r){
        for(s = r[i], r[i] = ""; s.length > m;
            j = c ? m : (j = s.substr(0, m).match(/\S*$/)).input.length - j[0].length
            || m,
            r[i] += s.substr(0, j) + ((s = s.substr(j)).length ? b : "")
        );
        r[i] += s;
    }
    return r.join("\n");
};

$(document).ready(function() {
	$(document).click(function(evt) {
		var x = evt.pageX;
		var y = evt.pageY;
		var tip_x = parseInt($('#cluetip').css('left').replace('px',''));
		var tip_y = parseInt($('#cluetip').css('top').replace('px',''));
		var height = $('#cluetip').height();
		// console.debug('x:= ' + x + ' y:= ' + y + ' tip_x:= ' + tip_x + ' tip_y:=' + tip_y + ' height:= ' + height);
		if (x>0 && y>0 && !(x>tip_x && x<tip_x+200 && y > tip_y && y < tip_y + height)) {
			$('#cluetip').fadeOut();
			$('body').unblock();
		}
	})
});