
/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('latex', 'en,pt_br'); // <- Add a comma separated list of all supported languages

// Singleton class
var TinyMCE_LatexPlugin = {
	/**
	 * Returns information about the plugin as a name/value array.
	 * The current keys are longname, author, authorurl, infourl and version.
	 *
	 * @returns Name/value array containing information about the plugin.
	 * @type Array 
	 */
	getInfo : function() {
		return {
			longname : 'LaTeX plugin',
			author : 'Renato Mendes Coutinho',
			authorurl : 'http://stoa.usp.br/renato',
			infourl : 'http://pccepa3.if.usp.br/trac/demi/browse',
			version : "1.0"
		};
	},

	/**
	 * Gets executed when a TinyMCE editor instance is initialized.
	 *
	 * @param {TinyMCE_Control} Initialized TinyMCE editor control instance. 
	 */
	initInstance : function(inst) {
		// You can take out plugin specific parameters
		//alert("Initialization parameter:" + tinyMCE.getParam("Latex_someparam", false));

		// Register custom keyboard shortcut
		//inst.addShortcut('ctrl', 't', 'lang_Latex_desc', 'mceLatex');
	},

	/**
	 * Returns the HTML code for a specific control or empty string if this plugin doesn't have that control.
	 * A control can be a button, select list or any other HTML item to present in the TinyMCE user interface.
	 * The variable {$editor_id} will be replaced with the current editor instance id and {$pluginurl} will be replaced
	 * with the URL of the plugin. Language variables such as {$lang_somekey} will also be replaced with contents from
	 * the language packs.
	 *
	 * @param {string} cn Editor control/button name to get HTML for.
	 * @return HTML code for a specific control or empty string.
	 * @type string
	 */
	getControlHTML : function(cn) {
		switch (cn) {
			case "latex":
				return tinyMCE.getButtonHTML(cn, 'lang_Latex_desc', '{$pluginurl}/images/Latex.gif', 'mceLatex', true);
		}

		return "";
	},

	/**
	 * Executes a specific command, this function handles plugin commands.
	 *
	 * @param {string} editor_id TinyMCE editor instance id that issued the command.
	 * @param {HTMLElement} element Body or root element for the editor instance.
	 * @param {string} command Command name to be executed.
	 * @param {string} user_interface True/false if a user interface should be presented.
	 * @param {mixed} value Custom value argument, can be anything.
	 * @return true/false if the command was executed by this plugin or not.
	 * @type
	 */
	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			// Remember to have the "mce" prefix for commands so they don't intersect with built in ones in the browser.
			case "mceLatex":
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, '[tex] [/tex]');
				
				return true;
		}

		// Pass to next handler in chain
		return false;
	},
};

// Adds the plugin class to the list of available TinyMCE plugins
tinyMCE.addPlugin("latex", TinyMCE_LatexPlugin);
