(function(){
	tinymce.PluginManager.requireLangPack('latex');
	
	tinymce.create('tinymce.plugins.LatexPlugin',{
		
		init: function(ed,url){
			ed.addCommand('latex',function(){
				ed.execCommand('mceReplaceContent',false,'[tex]{$selection}[/tex]');
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