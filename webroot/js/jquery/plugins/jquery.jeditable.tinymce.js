$.editable.addInputType('mce', {
	element : function(settings, original) {
		var textarea = $('<textarea id="'+$(original).attr("id")+'_mce"/>');
		if (settings.rows) {
			textarea.attr('rows', settings.rows);
		} else {
			textarea.height(settings.height);
		}
		if (settings.cols) {
			textarea.attr('cols', settings.cols);
		} else {
			textarea.width(settings.width);
		}
		$(this).append(textarea);
			return(textarea);
		},
	plugin : function(settings, original) {
		tinyMCE.execCommand("mceAddControl", true, $(original).attr("id")+'_mce');
		},
	submit : function(settings, original) {
		tinyMCE.triggerSave();
		tinyMCE.execCommand("mceRemoveControl", true, $(original).attr("id")+'_mce');
		},
	reset : function(settings, original) {
		tinyMCE.execCommand("mceRemoveControl", true, $(original).attr("id")+'_mce');
		original.reset();
	}
});