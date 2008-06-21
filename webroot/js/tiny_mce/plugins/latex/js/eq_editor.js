/* 
 Copyright CodeCogs 2007-2008
 Written by Will Bateman.
	
 GNU General Public License Agreement
 Copyright (C) 2004-2007 CodeCogs, Zyba Ltd, Broadwood, Holford, TA5 1DU, England.
 This program is free software; you can redistribute it and/or modify it under
 the terms of the GNU General Public License as published by CodeCogs
 (www.codecogs.com/cart-3.htm). You must retain a copy of this licence in all copies.
 This program is distributed in the hope that it will be useful, but WITHOUT ANY
 WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/

var changed=false;

// Clears the main editor window
function cleartext()
{ 
 var id=document.getElementById('latex_formula');
 id.value = "";
 id.focus(); 
 changed=false;
}

function textchanged()
{
	changed=true;
}

// Tries to inserts text at the cursor position of text area
//  wind = document                <- when inserting text into the current equation editor box  
//  wind = window.opener.document  <- when inserting text into a parent window box
function addText(wind, textbox, txt) 
{
	myField = wind.getElementById(textbox);
  // IE 
  if (wind.selection) 
  {
    myField.focus();
    sel = wind.selection.createRange();
    sel.text = txt;
  }
  // MOZILLA
  else 
  {
		var scrolly=myField.scrollTop;
	  if (myField.selectionStart || myField.selectionStart == '0') 
    {
      var startPos = myField.selectionStart;
      var endPos = myField.selectionEnd;
			var cursorPos = startPos + txt.length;
      myField.value = myField.value.substring(0, startPos) + txt 
					+ myField.value.substring(endPos, myField.value.length);
			pos = txt.length + endPos - startPos;

			myField.selectionStart = cursorPos;
			myField.selectionEnd = cursorPos;
	
			myField.focus();
			myField.setSelectionRange(startPos + pos,startPos + pos);	
    } 
    else 
      myField.value += txt;
			
	  myField.scrollTop=scrolly;
  }
}

function insertText( txt, pos )
{
	textchanged()
	
	// pos = optional parameter defining where in inserted text to put the caret
	// if undefined put at end of inserted text
	// if pos=1000 then using style options and move to just before final }
	// startPos = final position of caret in complete text
	if (pos==1000) {pos=txt.length-1};
	if (pos==undefined) { txt+=' '; pos=txt.length;}; // always insert a space after
	
	// my textarea is called latex_formula
	myField = document.getElementById('latex_formula');
	if (document.selection) 	{
		// IE
		myField.focus();
		var sel = document.selection.createRange();
		// find current caret position
			
		var i = myField.value.length+1; 
		theCaret = sel.duplicate(); 
		while (theCaret.parentElement()==myField 
		&& theCaret.move("character",1)==1) --i; 
	
		// take account of line feeds
		var startPos = i - myField.value.split('\n').length + 1 ; 
	
		if ((txt.substring(1,5) == "left" || txt.substring(pos-1,pos)=='{') && sel.text.length)	{ 
			// allow highlighted text to be bracketed
			if(txt.substring(1,5) == "left")
			  ins_point=7;
			else
			  ins_point=pos;
				
			pos = txt.length + sel.text.length + 1;
			sel.text = txt.substring(0,ins_point) + sel.text + txt.substr(ins_point);	     
		} else {
			sel.text = txt;
		}
		// put caret in correct position to start editing
		var range = myField.createTextRange();
		range.collapse(true);
		range.moveEnd('character', startPos + pos);
		range.moveStart('character', startPos + pos);
		range.select();
	}
	else
	{
		// MOZILLA
		if (myField.selectionStart || myField.selectionStart == '0')	{
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			var cursorPos = startPos + txt.length;
			if ((txt.substring(1,5) == "left" || txt.substr(pos-1,1)=='{') && endPos > startPos)	{ 
				// allow highlighted text to be bracketed
				
				if(txt.substring(1,5) == "left")
				  ins_point=7;
				else
				  ins_point=pos;
				
				pos = txt.length + endPos - startPos + 1;
				txt = txt.substring(0,ins_point) + myField.value.substring(startPos, endPos) + txt.substr(ins_point);			
			}
			myField.value = myField.value.substring(0, startPos) + txt 
							+ myField.value.substring(endPos, myField.value.length);
		
			myField.selectionStart = cursorPos;
			myField.selectionEnd = cursorPos;
					
						// put caret in correct position to start editing
			myField.focus();
			myField.setSelectionRange(startPos + pos,startPos + pos);	
		}
		else	
			myField.value += txt;
	}
	myField.focus();
}

/* ----------- Handle rendering example equation --------------------------- */

// Returns the complete string that describes this particular equation with font sizes etc.
function getEquationStr()
{
	var val=document.getElementById('latex_formula').value;
	val=val.replace(/^\s+|\s+$/g,"");
	var size = document.getElementById('fontsize');
	if(size)
	{
		var txt=size.options[size.selectedIndex].value;
		if(txt!='')
  		val=txt+' '+val; //.replace(/\+/g,"&plus;");
	}
	return val;
}



/* Turns off the wait message, once and equation is loaded */
var initmessage=true;
updateparent=null;
function processEquationChange() 
{
	if(initmessage) 
	  initmessage=false;
	else
	{
    var div = document.getElementById('equationcomment');
	  div.innerHTML = "";	
	}
	if(updateparent!=null) { updateparent(); }
 	updateparent=null;
}

// Triggers the rendering of the equations within the iframe
function renderEqn(callback)
{
	/* Display wait message */
	if(changed)
	{
		var div = document.getElementById('equationcomment');
		div.innerHTML = "Rendering Equation";	
			
		updateparent=callback;
			
		/* Set render button to disabled, since we're now rendering.. */
		document.getElementById('renderbutton').disabled='disabled';
	
		var val=document.getElementById('latex_formula').value;
		
		/* Add to history */
		var sel=document.getElementById('history');
		var j=sel.length;
		sel.length=j+1;
		sel.options[j].text=val.substr(0,15);
		sel.options[j].value=val;
		sel.options[j].title=val;
		
		/* This sytem works by changing the image source to the new LaTeX equation. A seperate file, renders from a url the image, which is then presented here. The image on the main page already has
		an onload event which calls processEquationChange, which merely turns off the wait message. */
		var img = document.getElementById('equationview');
		val=getEquationStr();
		img.src='http://www.codecogs.com/eq.latex?' + val;
		changed=false;
		document.getElementById('renderbutton').disabled='';
	}
}

/* Help to generate a Matrix */
// generate a set of aligned equations - thornahawk
// isNumbered: switches between numbered and not numbered equations
function makeEquationsMatrix(type, isNumbered, isConditional)
{
	if (isNumbered==undefined) isNumbered=false;
	if (isConditional==undefined) isNumbered=false;

  var eqns="\\begin{"+type+((isNumbered)?"":"*")+"}";
	var eqi="\n &"+((isNumbered)?" ":"= ")+((isConditional)?"\\text{ if } x=  ":"");
	var eqEnd="\n\\end{"+type+((isNumbered)?"":"*")+"}";
	var i=0;

	var dim = prompt('Enter the number of lines:', '');

	if (dim != '' && dim != null)	{
		n=parseInt(dim);
		if (!isNaN(n)) {
			for (i=1;i<=n-1;i++)
				eqns=eqns+(eqi+"\\\\ ");
			eqns=(eqns+eqi)+eqEnd;
			
			insertText(eqns,type.length+((isNumbered)?0:1)+9);
		}
	}
}

// generate an array of specified dimensions - thornahawk
// type: sets the type of array, e.g. pmatrix
function makeArrayMatrix( type, start, end )
{
	var matr=start+'\\begin{'+type+'matrix}';
	var row="\n";
	var mend="\n\\end{"+type+"matrix}"+end;
	var i=0

	var dim = prompt('Enter the array dimensions separated by a comma (e.g. "2,3" for 2 rows and 3 columns):', '')

	if (dim!='' && dim!=null)	
	{
		dim=dim.split(',');
		m=parseInt(dim[0]);
		n=parseInt(dim[1]);
		
		if (!isNaN(m) && !isNaN(n)) 
		{
			for (i=2;i<=n;i++)
				row=row+' & ';
			
			for (i=1;i<=m-1;i++)
				matr=matr+row+'\\\\ ';
		
			matr=matr+row+mend;
			insertText(matr,type.length+start.length+15);
		}
	}
}

function insertLatex() {
	var formula = document.getElementById('latex_formula') .value;
	var node = ed.selection.getNode();
	if (node != null && /mceItemLatex/.test(ed.dom.getAttrib(node, 'class'))) {
		node.alt = formula;
		node.src = 'http://www.codecogs.com/eq.latex?' + formula;
		ed.execCommand('mceRepaint');
	} else {
		var h = '<img class="mceItemLatex" alt="'+ formula +'"src="http://www.codecogs.com/eq.latex?' + formula + '" />'
		ed.execCommand('mceInsertContent', false, h);
	}
	
	tinyMCEPopup.close();
}
