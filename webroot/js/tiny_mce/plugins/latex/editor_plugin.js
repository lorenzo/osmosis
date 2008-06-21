(function(){
	tinymce.PluginManager.requireLangPack('latex');
	
	tinymce.create('tinymce.plugins.LatexPlugin',{
		
		init: function(ed,url){
			ed.addCommand('latex',function(){
				
				ed.windowManager.open(
					{
						file : url + '/editor.html',
						width : 550 + ed.getLang('latex.delta_width', 0),
						height : 350 + ed.getLang('latex.delta_height', 0),
						inline : 1
					}, {
						plugin_url : url
					});
			});
			
			ed.onInit.add(function() {

				if (ed.settings.content_css !== false)
					ed.dom.loadCSS(url + "/css/content.css");
			});
			
			ed.onBeforeSetContent.add(function(ed, o) {
				var h = o.content;
				h = h.replace(/<span class="mceTempLatex"[^><]*>|<\/span[^><]*>/gi,"");
				h = h.replace(/\[tex\](.*?)\[\/tex\]/gi, '<img class="mceItemLatex" alt="$1"src="http://www.codecogs.com/eq.latex?$1" />');
				o.content = h;
			});
			
			ed.onPreProcess.add(function(ed, o) {
				if (o.get) {
					tinymce.each(ed.dom.select('IMG', o.node), function(n) {
						if (n.className == 'mceItemLatex') {
							
							ed.dom.replace(ed.dom.create('span',{class:'mceTempLatex'},'[tex]'+ed.dom.encode(n.alt)+'[/tex]'),n);
						}
					});
				}		
			});
			
			ed.addButton('latex',{title:'latex.desc',cmd:'latex',image:url+'/img/latex.gif'});
		},
		
		createControl: function(n,cm){
			return null;
		},
		
		getInfo: function(){
			return { 
				longname:'LaTeX plugin',
				author:'Ósmosis Team. Modified from original plugin from Renato Mendes Coutinho',
				authorurl:'http://osmosislms.org',
				infourl:'',
				version:"1.0"
				};
		}
	});
tinymce.PluginManager.add('latex',tinymce.plugins.LatexPlugin);})();