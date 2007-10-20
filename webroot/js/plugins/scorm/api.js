function Scorm_2004 (){
	var errorCode;
	var Initialized;
	var Terminated;
	
	function Initialize(param) { alert('holk');
		errorCode = "0";
		if (param == "") {
			if ((!Initialized) && (!Terminated)) {
				Initialized = true;
				errorCode = "0";
				return "true";
			} else {
				if (Initialized) {
					errorCode = "103";
				} else {
					errorCode = "104";
				}
			}
		} else {
			errorCode = "201";
		}
		return "false";
	}
	
	//
	// Datamodel inizialization
	//
		var cmi = new Object();
			cmi.comments_from_learner = new Object();
			cmi.comments_from_learner._count = 0;
			cmi.comments_from_lms = new Object();
			cmi.comments_from_lms._count = 0;
			cmi.interactions = new Object();
			cmi.interactions._count = 0;
			cmi.learner_preference = new Object();
			cmi.objectives = new Object();
			cmi.objectives._count = 0;
			cmi.score = new Object();
	
		// Navigation Object
		var adl = new Object();
			adl.nav = new Object();
			adl.nav.request_valid = new Array();
	
	function Terminate (param) {
		errorCode = "0";
		if (param == "") {
			if ((Initialized) && (!Terminated)) {
				Initialized = false;
				Terminated = true;
				result = StoreData(cmi,true);
				if (adl.nav.request != '_none_') {
					switch (adl.nav.request) {
						case 'continue':
							setTimeout('top.nextSCO();',500);
						break;
						case 'previous':
							setTimeout('top.prevSCO();',500);
						break;
						case 'choice':
						break;
						case 'exit':
						break;
						case 'exitAll':
						break;
						case 'abandon':
						break;
						case 'abandonAll':
						break;
					}
				} else {
					/*if (<?php //echo $scorm->auto ?> == 1) {
						setTimeout('top.nextSCO();',500);
					}*/
				}
				return "true";
			} else {
				if (Terminated) {
					errorCode = "113";
				} else {
					errorCode = "112";
				}
			}
		} else {
			errorCode = "201";
		}
		return "false";
	}
	
	/* Description: The function requests information from an LMS. It permits the SCO to
	request information from the LMS to determine among other things:
	    Values for data model elements supported by the LMS.
	    Version of the data model supported by the LMS.
	    Whether or not specific data model elements are supported.
	*/
	function GetValue(element){
		return '';
	}
	
	/* Description: The method is used to request the transfer to the LMS of the value of
	parameter_2 for the data element specified as parameter_1. This method allows the
	SCO to send information to the LMS for storage. The API Instance may be designed to
	immediately persist data that was set (to the server-side component) or store data in a
	local (client-side) cache.
	*/
	function SetValue(element, value){
		return '';
	}
	
	/* Description: The method requests forwarding to the persistent data store any data from
	the SCO that may have been cached by the API Instance since the last call to
	Initialize("") or Commit(""), whichever occurred most recently. The LMS would
	then set the error code to 0 (No Error encountered) and return "true".
	
	If the API Instance does not cache values, Commit("") shall return "true" and set the
	error code to 0 (No Error encountered) and do no other processing.
	
	Cached data shall not be modified because of a call to the commit data method. For
	example, if the SCO sets the value of a data model element, then calls the commit data
	method, and then subsequently gets the value of the same data model element, the value
	returned shall be the value set in the call prior to invoking the commit data method. The
	Commit("") method can be used as a precautionary mechanism by the SCO. The method
	can be used to guarantee that data set by the SetValue() is persisted to reduce the
	likelihood that data is lost because the communication session is interrupted, ends
	abnormally or otherwise terminates prematurely prior to a call to Terminate("").
	*/
	function Commit(empty){
		return '';	
	}
	
	/*Description: This method requests the error code for the current error state of the API
	Instance. If a SCO calls this method, the API Instance shall not alter the current error
	state, but simply return the requested information.
	A best practice recommendation is to check to see if a Session Method or Data-transfer
	Method was successful. The GetLastError() can be used to return the current error
	code. If an error was encountered during the processing of a function, the SCO may take
	appropriate steps to alleviate the problem.
	*/
	function GetLastError(){
		return '0';
	}
	
	/*Description: The GetErrorString() function can be used to retrieve a textual
	description of the current error state. The function is used by a SCO to request the textual
	description for the error code specified by the value of the parameter. The API Instance
	shall be responsible for supporting the error codes identified in Section 3.1.7: API
	Implementation Error Codes. This call has no effect on the current error state; it simply
	returns the requested information.
	*/
	function GetErrorString(error_code){
		return '';	
	}
	
	/*Description: The GetDiagnostic() function exists for LMS specific use. It allows the
	LMS to define additional diagnostic information through the API Instance. This call has
	no effect on the current error state; it simply returns the requested information.
	*/
	function GetDiagnostic(wtf){
		return '';	
	}
	
	function GetErrorString (param) {
		if (param != "") {
			var errorString = "";
			switch(param) {
				case "0":
					errorString = "No error";
				break;
				case "101":
					errorString = "General exception";
				break;
				case "102":
					errorString = "General Inizialization Failure";
				break;
				case "103":
					errorString = "Already Initialized";
				break;
				case "104":
					errorString = "Content Instance Terminated";
				break;
				case "111":
					errorString = "General Termination Failure";
				break;
				case "112":
					errorString = "Termination Before Inizialization";
				break;
				case "113":
					errorString = "Termination After Termination";
				break;
				case "122":
					errorString = "Retrieve Data Before Initialization";
				break;
				case "123":
					errorString = "Retrieve Data After Termination";
				break;
				case "132":
					errorString = "Store Data Before Inizialization";
				break;
				case "133":
					errorString = "Store Data After Termination";
				break;
				case "142":
					errorString = "Commit Before Inizialization";
				break;
				case "143":
					errorString = "Commit After Termination";
				break;
				case "201":
					errorString = "General Argument Error";
				break;
				case "301":
					errorString = "General Get Failure";
				break;
				case "351":
					errorString = "General Set Failure";
				break;
				case "391":
					errorString = "General Commit Failure";
				break;
				case "401":
					errorString = "Undefinited Data Model";
				break;
				case "402":
					errorString = "Unimplemented Data Model Element";
				break;
				case "403":
					errorString = "Data Model Element Value Not Initialized";
				break;
				case "404":
					errorString = "Data Model Element Is Read Only";
				break;
				case "405":
					errorString = "Data Model Element Is Write Only";
				break;
				case "406":
					errorString = "Data Model Element Type Mismatch";
				break;
				case "407":
					errorString = "Data Model Element Value Out Of Range";
				break;
				case "408":
					errorString = "Data Model Dependency Not Established";
				break;
			}
			return errorString;
		} else {
			return "";
		}
	}
}
 var API_1484_11 = new Scorm_2004();