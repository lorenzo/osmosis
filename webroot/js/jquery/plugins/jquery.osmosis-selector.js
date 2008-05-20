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

/**
 * jQuery plugin: osmosisSelector (Convert MultiSelect boxes into facebook style multi selector)
 * @requires jQuery 1.2.2b2 or later 
 * @requires Flydom [dohpaz at gmail dot com]
 * @requires FieldSelection (http://blog.0xab.cd)
 * using plugin:jquery.autocomplete.js
 *
 * Copyright (c) 2008 Joaquín Windmüller <joaquin@aikon.com.ve>, http://aikon.com.ve/
 * Licensed under the MIT license:
 * 		http://www.opensource.org/licenses/mit-license.php
 **/
jQuery.fn.osmosisSelector = function(settings) {
	
	function OsmosisMultiselect(select, settings) {
		var self = this;
		var params = {
			urlLookup  : [],
			acOptions  : {
				formatItem : function(item) {
					return item.text;
				}
			},
			width	   : '300px'
		};
		var selectionsUl	= null;
		this.selected		= null;
		this.mainInput		= null;

		configure(select, settings);

		function configure(select, settings) {
			if(settings) jQuery.extend(params, settings);
			params.name = select.get(0).name;
			params.base_name = params.name.replace(/\[|\]/g, '');
			params.acOptions.attachTo = '#' + params.base_name + '_attach';
			if (params.urlLookup.length == 0) {
				options = select.children();
				options.each(function() {
					option = $(this);
					params.urlLookup.push({text : option.text(), value : this.value});
				});
			}
			prepareDOM(select);
			prepareAutocomplete();
		};

		function prepareDOM(select) {
			$(document).keydown(keyHandler).click(function() {blur();});
			parent = select.parent();
			select.remove();
			parent.createAppend(
				'div', {className : 'selector-wrapper', 'style' : 'width:' + params.width},
				[
					'ul', {id : params.base_name + '_selection', className : 'selections'}, ['input', {id : params.base_name, type : 'text'}],
					'div', {id : params.acOptions.attachTo.replace('#', ''), style : 'width:100%;position:relative;clear:both'}, ''
				]
			);
			selectionsUl = $('#' + params.base_name + '_selection');
			selectionsUl.click(function(event) {
					event.preventDefault();
					event.stopPropagation();
					self.mainInput.focus();
					self.selected = self.mainInput;
				});
		}

		function prepareAutocomplete() {
			self.mainInput = $('#' + params.base_name);
			self.mainInput
				.css('width', '30px')
				.focus(function(e) {
					if (self.selected != undefined && self.selected.get(0).className == 'selected') {
						self.selected.removeClass('selected');
					}
					self.selected = $(this);
				})
				.autocomplete(params.urlLookup, params.acOptions)
				.result(function(event, data, formatted) {
					item = '<li>';
					item += '<span>' + formatted + '</span><a class="close" href="#"></a>';
					item += '<input type="hidden" name="' + params.name + '" value="' + data.value + '" />';
					item +='</li>';
					$(self.mainInput).before(item).val('');
					console.debug($('li a.close', selectionsUl));
					$('li a.close', selectionsUl).click(function() {
						$(this).parent().remove();
					}).focus(function() {
						a = $(this);
						self.selected = a.parent();
						self.selected.addClass('selected');
					}).blur(function(event) {
						blur();
					});
					reFocus();
				});
		}

		function getInput() {
			ret = new Object();
			ret.position = 0;
			ret.input_box = self.selected;
			ret.caret = $(self.mainInput).getSelection();
			if (self.selected.get(0).nodeName == 'INPUT') {
				return ret;
			} else {
				input_box = self.selected.next();
				ret.position = 1;
				if (input_box.length == 1 && input_box[0].nodeName=='INPUT') {
					ret.input_box = input_box;
				} else {
					ret.position = -1;
					ret.input_box = self.selected.prev();
				}
			}
			return ret;
		}

		function keyHandler(event) {
			if (self.selected==undefined) return;
			switch (event.keyCode) {
				case 37:
					move('left');
				break;
				case 39:
					move('right');
				break;
				case 46: //Delete
					if (self.selected.get(0).nodeName == 'INPUT') {
						deleteKey();
						break;
					}
				case 8: //Backspace
					backspace(event);
				break;
				case 9: // Tab
					blur();
				break;
				case 38: // Up
				case 40: // Down
					break;
				case 27: // Scape
					blur();
				break;
			}
		}

		function move(direction) {
			input_box = getInput();
			if (self.selected.get(0).className=='selected') {
				self.selected.removeClass('selected');
			}
			switch (input_box.position) {
				case 0:
					moveFromInput(direction, input_box);
				break;
				case 1:
				case -1:
					moveFromItem(direction, input_box);
				break;
			}
		}

		function moveFromInput(direction, input_box) {
			if (direction=='left' && input_box.caret.start >= 1) {
				return;
			}
			if (direction=='right' && input_box.caret.start < input_box.input_box.get(0).value.length) {
				return;
			}
			check = (direction=='left') ? self.selected.prev() : self.selected.next();
			if (check.length==0) {
				return;
			}
			check.addClass('selected');
			self.mainInput.blur();
			self.selected = check;
		}

		function moveFromItem(direction, input_box) {
			if (direction=='left') {
				switchElements(input_box.input_box, self.selected);
			} else {
				switchElements(self.selected, input_box.input_box);
			}
			self.selected = input_box.input_box;
			reFocus();
		}

		function deleteKey() {
			if (self.selected.get(0).nodeName=='INPUT') {
				input_box = getInput()
				caret_start = input_box.caret.start;
				content_length = input_box.input_box.get(0).value.length;
				text_selected = input_box.caret.size > 0;
				if (self.selected.next().length == 0 || caret_start < content_length || text_selected) {
					return;
				}
				if (input_box.caret.start==input_box.input_box[0].value.length) {
					move('right');
				}
			} else if (self.selected.get(0).nodeName == 'LI') {
				self.selected.remove();
				self.mainInput.focus();
			}

		}

		function backspace(event) {
			isInput = self.selected.get(0).nodeName=='INPUT';
			input_box = getInput();
			prev = self.selected.prev();
			if (isInput) {
				if (prev.length == 0 || input_box.caret.start>1 || input_box.caret.size > 0) {
					return;
				}
				if (input_box.caret.start==0) {
					event.preventDefault();
					event.stopPropagation();
					move('left');
				}
			} else if (self.selected.get(0).nodeName == 'LI') {
				event.preventDefault();
				event.stopPropagation();
				self.selected.remove();
				self.mainInput.focus();
			}
		}

		function blur() {
			console.debug(self.selected);
			if (self.selected==null) return;
			if (self.selected.get(0).className=='selected') {
				self.selected.removeClass('selected');
			}
			self.selected = null;
			self.mainInput.blur();
		}

		function reFocus() {
			input = self.mainInput.get(0);
			value = input.value;
			input.value = '';
			input.value = value;
			setTimeout(doFocus, 10);
		}

		function doFocus() {
			self.mainInput.focus();
		}

		function switchElements(right, left) {
			right.after(left);
		}
	}
	
	return this.each(function() {
		new OsmosisMultiselect($(this), settings);
	}) 
}