/**
Jojo
<?php var_dump($trackings); ?>
*/
function debug(elem) {
	if (typeof console != 'undefined') console.debug(elem);
}
function debugGroup(title) {
	if (typeof console != 'undefined') console.group(title);
}
function debugGroupClose() {
	if (typeof console != 'undefined') console.groupEnd();
}
var adminEmail = 'joaquin@aikon.com.ve';
function underscore(str) {
	str = str.replace(/.N/g,".");
	return str.replace(/\./g,"__");
}
var Scorm_2004 = function(){
	/* URL to where the scoes data is sent */ 
	this.serverside_url = webroot + 'scorm/scorm_attendee_trackings/store_data/';
	/* Allowed Children values */
	this.cmi_children = '_version, comments_from_learner, comments_from_lms, completion_status, credit, entry, exit, interactions, launch_data, learner_id, learner_name, learner_preference, location, max_time_allowed, mode, objectives, progress_measure, scaled_passing_score, score, session_time, success_status, suspend_data, time_limit_action, total_time';
//	this.comments_children = 'comment, timestamp, location';
	this.interactions_children = 'id, type, objectives, timestamp, correct_responses, weighting, learner_response, result, latency, description';
	this.score_children = 'max, raw, scaled, min';
	this.student_preference_children = 'audio_level, audio_captioning, delivery_speed, language';
	this.interactions_children = 'id, type, objectives, timestamp, correct_responses, weighting, learner_response, result, latency, description';
	this.objectives_children = 'progress_measure, completion_status, success_status, description, score, id';

	/* DataRanges */
	this.audio_range  = '0#*';
	this.progress_range = '0#1';
	this.scaled_range = '-1#1';
	this.speed_range  = '0#*';
	this.text_range   = '-1#1';

	/* Standard Data Type Definition */
	/* String */
	this.CMIString200 = '^.{0,200}$';
	this.CMIString250 = '^.{0,250}$';
	this.CMIString1000 = '^.{0,1500}$'; // ???
	this.CMIString4000 = '^.{0,4000}$';
	this.CMIString64000 = '^.{0,64000}$';
	this.CMIFeedback = this.CMIString200;  // ???

	/* Language */
	this.CMILang = '^([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?$|^$';
	this.CMILangString250 = '^(\{lang=([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?\})?([^\{].{0,250}$)?';
	this.CMILangString4000 = '^(\{lang=([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?\})?([^\{].{0,4000}$)?';

	/* Numbers */
	this.CMIInteger = '^\\d+$';
	this.CMISInteger = '^-?([0-9]+)$';
	this.CMIDecimal = '^-?([0-9]{1,4})(\\.[0-9]{1,18})?$';

	/* Identifiers */
	this.CMILongIdentifier = '^\\S{0,4000}[a-zA-Z0-9]$';
	//this.CMIIdentifier = '^\\S{0,200}[a-zA-Z0-9]$'; // Not used

	/* Time */
	this.CMITime = '^(19[7-9]{1}[0-9]{1}|20[0-2]{1}[0-9]{1}|203[0-8]{1})((-(0[1-9]{1}|1[0-2]{1}))((-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1}))(T([0-1]{1}[0-9]{1}|2[0-3]{1})((:[0-5]{1}[0-9]{1})((:[0-5]{1}[0-9]{1})((\\.[0-9]{1,2})((Z|([+|-]([0-1]{1}[0-9]{1}|2[0-3]{1})))(:[0-5]{1}[0-9]{1})?)?)?)?)?)?)?)?$';
	this.CMITimeInterval = '^P(\\d+Y)?(\\d+M)?(\\d+D)?(T(((\\d+H)(\\d+M)?(\\d+(\.\\d{1,2})?S)?)|((\\d+M)(\\d+(\.\\d{1,2})?S)?)|((\\d+(\.\\d{1,2})?S))))?$';

	/* Index */
	this.CMIIndex = '[._](\\d+).';
	//this.CMIIndexStore = '.N(\\d+).'; // Not used

	/* Vocabulary Data Type Definition */
	this.CMIExit = '^time-out$|^suspend$|^logout$|^normal$|^$';
	this.CMICStatus = '^completed$|^incomplete$|^not attempted$|^unknown$';
	this.CMISStatus = '^passed$|^failed$|^unknown$';
	this.CMIResult = '^correct$|^incorrect$|^unanticipated$|^neutral$|^-?([0-9]{1,4})(\\.[0-9]{1,18})?$';
	this.CMIType = '^true-false$|^choice$|^(long-)?fill-in$|^matching$|^performance$|^sequencing$|^likert$|^numeric$|^other$';
	//this.NAVTarget = '^previous$|^continue$|^choice.{target=\\S{0,200}[a-zA-Z0-9]}$'; //Not used
	this.NAVEvent = '^previous$|^continue$|^exit$|^exitAll$|^abandon$|^abandonAll$|^suspendAll$|^{target=\\S{0,200}[a-zA-Z0-9]}choice$';
	//this.NAVBoolean = '^unknown$|^true$|^false$'; // Not used

	this.datamodel = {
		/*'cmi._children' : {
			'defaultvalue': this.cmi_children,
			'mode':'r'
		},
		'cmi._version' : {
			'defaultvalue':'1.0',
			'mode':'r'
		},*/
		// cmi.comments_from_learner is a Collection of records of data
		'cmi.comments_from_learner._children':{
			'defaultvalue': 'comment, timestamp, location',
			'mode':'r'
		},
		'cmi.comments_from_learner._count':{
			'defaultvalue':'0',
			'mode':'r'
		},
		'cmi.comments_from_learner.n.comment':{
			'format': this.CMILangString4000,
			'mode':'rw'
		},
		'cmi.comments_from_learner.n.location':{
			'format': this.CMIString250,
			'mode':'rw'
		},
		'cmi.comments_from_learner.n.timestamp':{
			'format': this.CMITime,
			'mode':'rw'
		},/*
		// cmi.comments_from_lms is a Collection of records of data
		'cmi.comments_from_lms._children':{
			'defaultvalue': this.comments_children,
			'mode':'r'
		},
		'cmi.comments_from_lms._count':{
			'defaultvalue':'0',
			'mode':'r'
		},
		'cmi.comments_from_lms.n.comment':{
			'format': this.CMILangString4000,
			'mode':'r'
		},
		'cmi.comments_from_lms.n.location':{
			'format': this.CMIString250,
			'mode':'r'
		},
		'cmi.comments_from_lms.n.timestamp':{
			'format': this.CMITime,
			'mode':'r'
		},*/
		'cmi.completion_status':{
			'defaultvalue':'<?php echo isset($trackings['cmi__completion_status']) ? $trackings['cmi__completion_status']:'unknown' ?>',
			'format': this.CMICStatus,
			'mode':'rw'
		},/*
		'cmi.completion_threshold':{
//			'defaultvalue':<?php echo isset($userdata->threshold)?'\''.$userdata->threshold.'\'':'null' ?>,
			'mode':'r'
		},
		'cmi.credit':{
//			'defaultvalue':'<?php echo isset($userdata->credit)?$userdata->credit:'' ?>',
			'mode':'r'
		},*/
		'cmi.entry':{
			'defaultvalue':'<?php echo $trackings['entry']; ?>',
			'mode':'r'
		},
		'cmi.exit':{
//			'defaultvalue':'<?php echo isset($userdata->{'cmi.exit'})?$userdata->{'cmi.exit'}:'' ?>',
			'format': this.CMIExit,
			'mode':'w'
		},
		// cmi.interactions is a Collection of records of data	
		'cmi.interactions._children':{
			'defaultvalue': this.interactions_children,
			'mode':'r'
		},
		'cmi.interactions._count':{
			'mode':'r',
			'defaultvalue':'0'
		},
		'cmi.interactions.n.id':{
			'pattern': this.CMIIndex,
			'format': this.CMILongIdentifier,
			'mode':'rw'
		},
		'cmi.interactions.n.type':{
			'pattern': this.CMIIndex,
			'format': this.CMIType,
			'mode':'rw'
		},
		'cmi.interactions.n.objectives._count':{
			'pattern': this.CMIIndex,
			'mode':'r',
			'defaultvalue':'0'
		},
		'cmi.interactions.n.objectives.n.id':{
			'pattern': this.CMIIndex,
			'format': this.CMILongIdentifier,
			'mode':'rw'
		},
		'cmi.interactions.n.timestamp':{
			'pattern': this.CMIIndex,
			'format': this.CMITime,
			'mode':'rw'
		},
		'cmi.interactions.n.correct_responses._count':{
			'defaultvalue':'0',
			'pattern': this.CMIIndex,
			'mode':'r'
		},
		'cmi.interactions.n.correct_responses.n1.pattern':{
			'pattern': this.CMIIndex,
			'format':this.CMIFeedback,
			'mode':'rw'
		},
		'cmi.interactions.n.weighting':{
			'pattern': this.CMIIndex,
			'format':this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.interactions.n.learner_response':{
			'pattern': this.CMIIndex,
			'format': this.CMIFeedback,
			'mode':'rw'
		},
		'cmi.interactions.n.result':{
			'pattern': this.CMIIndex,
			'format': this.CMIResult,
			'mode':'rw'
		},
		'cmi.interactions.n.latency':{
			'pattern': this.CMIIndex,
			'format':this.CMITimeInterval,
			'mode':'rw'
		},
		'cmi.interactions.n.description':{
			'pattern': this.CMIIndex,
			'format': this.CMILangString250,
			'mode':'rw'
		},/*
		'cmi.launch_data':{
//			'defaultvalue':<?php echo isset($userdata->datafromlms)?'\''.$userdata->datafromlms.'\'':'null' ?>,
			'mode':'r'
		},
		'cmi.learner_id':{
//			'defaultvalue':'<?php echo $userdata->student_id ?>',
			'mode':'r'
		},*/
		'cmi.learner_name':{
			'defaultvalue':'<?php echo addslashes($user['name']) ?>',
			'mode':'r'
		},/*
		'cmi.learner_preference._children':{
			'defaultvalue': this.student_preference_children,
			'mode':'r'
		},
		'cmi.learner_preference.audio_level':{
			'defaultvalue':'1',
			'format': this.CMIDecimal,
			'range': this.audio_range,
			'mode':'rw'
		},
		'cmi.learner_preference.language':{
			'defaultvalue':'',
			'format': this.CMILang,
			'mode':'rw'
		},
		'cmi.learner_preference.delivery_speed':{
			'defaultvalue':'1',
			'format': this.CMIDecimal,
			'range': this.speed_range,
			'mode':'rw'
		},
		'cmi.learner_preference.audio_captioning':{
			'defaultvalue':'0',
			'format': this.CMISInteger,
			'range': this.text_range,
			'mode':'rw'
		},*/
		'cmi.location':{
			'defaultvalue':<?php echo isset($trackings['cmi__location']) ? '"'.$trackings['cmi__location'].'"':'null' ?>,
			'format': this.CMIString1000,
			'mode':'rw'
		},/*
		'cmi.max_time_allowed':{
//			'defaultvalue':<?php echo isset($userdata->maxtimeallowed)?'\''.$userdata->maxtimeallowed.'\'':'null' ?>,
			'mode':'r'
		},
		'cmi.mode':{
//			'defaultvalue':'<?php echo $userdata->mode ?>',
			'mode':'r'
		},
		// cmi.objectives is a Collection of records of data
		'cmi.objectives._children':{
			'defaultvalue': this.objectives_children,
			'mode':'r'
		},
		'cmi.objectives._count':{
			'defaultvalue':'0',
			'mode':'r'
		},
		'cmi.objectives.n.id':{
			'pattern': this.CMIIndex,
			'format': this.CMILongIdentifier,
			'mode':'rw'
		},
		'cmi.objectives.n.score._children':{
			'defaultvalue': this.score_children,
			'pattern': this.CMIIndex,
			'mode':'r'
		},
		'cmi.objectives.n.score.scaled':{
			'defaultvalue':null,
			'pattern': this.CMIIndex,
			'format': this.CMIDecimal,
			'range': this.scaled_range,
			'mode':'rw'
		},
		'cmi.objectives.n.score.raw':{
			'defaultvalue':null,
			'pattern': this.CMIIndex,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.objectives.n.score.min':{
			'defaultvalue':null,
			'pattern': this.CMIIndex,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.objectives.n.score.max':{
			'defaultvalue':null,
			'pattern': this.CMIIndex,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.objectives.n.success_status':{
		for (i=0;i<index_match.length;i++) {
					element = element.replace(index_match[i], '.n' + index_str + '.')
					index_str = i+1;
				}	'defaultvalue':'unknown',
			'pattern': this.CMIIndex,
			'format': this.CMISStatus,
			'mode':'rw'
		},
		'cmi.objectives.n.completion_status':{
			'defaultvalue':'unknown',
			'pattern': this.CMIIndex,
			'format': this.CMICStatus,
			'mode':'rw'
		},
		'cmi.objectives.n.progress_measure':{
			'defaultvalue':null,
			'format': this.CMIDecimal,
			'range': this.progress_range,
			'mode':'rw'
		},
		'cmi.objectives.n.description':{
			'pattern': this.CMIIndex,
			'format': this.CMILangString250,
			'mode':'rw'
		},
		'cmi.progress_measure':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.progess_measure'})?'\''.$userdata->{'cmi.progress_measure'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'range': this.progress_range,
			'mode':'rw'
		},
		'cmi.scaled_passing_score':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.scaled_passing_score'})?'\''.$userdata->{'cmi.scaled_passing_score'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'range': this.scaled_range,
			'mode':'r'
		},
		'cmi.score._children':{
			'defaultvalue': this.score_children,
			'mode':'r'
		},
		'cmi.score.scaled':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.score.scaled'})?'\''.$userdata->{'cmi.score.scaled'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'range': this.scaled_range,
			'mode':'rw'
		},
		'cmi.score.raw':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.score.raw'})?'\''.$userdata->{'cmi.score.raw'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.score.min':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.score.min'})?'\''.$userdata->{'cmi.score.min'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.score.max':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.score.max'})?'\''.$userdata->{'cmi.score.max'}.'\'':'null' ?>,
			'format': this.CMIDecimal,
			'mode':'rw'
		},
		'cmi.session_time':{
			'format': this.CMITimeInterval,
			'mode':'w',
			'defaultvalue':'PT0H0M0S'
		},
		'cmi.success_status':{
//			'defaultvalue':'<?php echo isset($userdata->{'cmi.success_status'})?$userdata->{'cmi.success_status'}:'unknown' ?>',
			'format': this.CMISStatus,
			'mode':'rw'
		},
		'cmi.suspend_data':{
//			'defaultvalue':<?php echo isset($userdata->{'cmi.suspend_data'})?'\''.$userdata->{'cmi.suspend_data'}.'\'':'null' ?>,
			'format': this.CMIString64000,
			'mode':'rw'
		},
		'cmi.time_limit_action':{
//			'defaultvalue':<?php echo isset($userdata->timelimitaction)?'\''.$userdata->timelimitaction.'\'':'null' ?>,
			'mode':'r'
		},
		'cmi.total_time':{
//			'defaultvalue':'<?php echo isset($userdata->{'cmi.total_time'})?$userdata->{'cmi.total_time'}:'PT0H0M0S' ?>',
			'mode':'r'
		},*/
		'adl.nav.request':{
			'defaultvalue':'_none_',
			'format': this.NAVEvent,
			'mode':'rw'
		}
	};
	
	this.errorCode = "0";
	this.Initialized = false;
	this.Terminated = false;

	this.Initialize = function(param) {
		this.errorCode = "0";
		if (param == "") {
			if ((!this.Initialized) && (!this.Terminated)) {
				this.Initialized = true;
				this.errorCode = "0";
				return "true";
			} else {
				if (this.Initialized) {
					this.errorCode = "103";
				} else {
					this.errorCode = "104";
				}
			}
		} else {
			this.errorCode = "201";
		}
		return "false";
	};
	
	this.CollectData = function(data, parent_str) {
		var datastring = '';
		for (property in data) {
			if (typeof data[property] == 'object') {
				datastring += this.CollectData(data[property],parent_str+'.'+property);
			} else {
				element = parent_str+'.'+property;
				expression = new RegExp(this.CMIIndexStore,'g');
				elementmodel = element.replace(expression,'.n.');
				if (this.datamodel[elementmodel] != null) {
					if (this.datamodel[elementmodel].mode != 'r') {
						elementstring = '&'+underscore(element)+'='+escape(data[property]);
						if (this.datamodel[elementmodel].defaultvalue != null) {
							if (this.datamodel[elementmodel].defaultvalue != data[property]) {
								datastring += elementstring;
							}
						} else {
							datastring += elementstring;
						}
					}
				}
			}
		}
		return datastring;
	}

	this.StoreData = function(data, storetotaltime) {
		var datastring = '';
		/*if (storetotaltime) {
			if (this.cmi.mode == 'normal') {
				if (this.cmi.credit == 'credit') {
					if ((this.cmi.completion_threshold != null) && (this.cmi.progress_measure != null)) {
						if (cmi.progress_measure >= cmi.completion_threshold) {
							cmi.completion_status = 'completed';
						} else {
							cmi.completion_status = 'incomplete';
						}
					}
					if ((cmi.scaled_passed_score != null) && (cmi.score.scaled != '')) {
						if (cmi.score.scaled >= cmi.scaled_passed_score) {
							cmi.success_status = 'passed';
						} else {
							cmi.success_status = 'failed';
						}
					}
				}
			}
			datastring += TotalTime();
		}*/
		datastring += this.CollectData(data, 'cmi');
		var navrequest = 
			(this.adl.nav.request != this.datamodel['adl.nav.request'].defaultvalue) ?
			'&' + underscore('adl.nav.request') + '=' + this.adl.nav.request : '';
		datastring += navrequest;
		//datastring += '&attempt=<?php echo $attempt ?>';
		//datastring += '&scoid=<?php echo $scoid ?>';
		debugGroup("Storing Data...");
		debug('Data: \n' + datastring);
		debug('URL: \n' + this.serverside_url);
		debugGroupClose();
		return jQuery.post(this.serverside_url + 'scorm:' + scorm_id + '/sco:' + sco_number, datastring);
	}

	//
	// Datamodel inizialization
	//
	this.cmi = {
		comments_from_learner : {
			elements : new Array()
		},
		comments_from_lms : {
			elements : new Array()
		},
		interactions : {
			elements : new Array()
		},
		learner_preference : new Object(),
		objectives : {
			elements : new Array()
		},
		score : new Object()
	};

	// Navigation Object
	this.adl = {
		nav : {
			request_valid : new Array(),
			request : this.datamodel['adl.nav.request'].defaultvalue
		}
	};
	
	this.Terminate = function(param) {
		debug("Terminando =)");
		this.errorCode = "0";
		if (param == "") {
			if ((this.Initialized) && (!this.Terminated)) {
				this.Initialized = false;
				this.Terminated = true;
				result = this.StoreData(this.cmi, true);
				if (this.adl.nav.request != '_none_') {
					switch (this.adl.nav.request) {
						case 'continue':
							debug("Show next SCO.");
							//setTimeout('top.nextSCO();',500);
						break;
						case 'previous':
							debug("Show previous SCO.");
							//setTimeout('top.prevSCO();',500);
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
					debug("Show next SCO (if auto next is enabled).");
					/*if (<?php //echo $scorm->auto ?> == 1) {
						setTimeout('top.nextSCO();',500);
					}*/
				}
				return "true";
			} else {
				if (this.Terminated) {
					this.errorCode = "113";
				} else {
					this.errorCode = "112";
				}
			}
		} else {
			this.errorCode = "201";
		}
		return "false";
	};
	
	/* Description: The function requests information from an LMS. It permits the SCO to
	request information from the LMS to determine among other things:
		Values for data model elements supported by the LMS.
		Version of the data model supported by the LMS.
		Whether or not specific data model elements are supported.
	*/
	this.GetValue = function(element){
		this.errorCode = "0";
		var indexes = new RegExp(this.CMIIndex,'g');
		var index_match = element.match(indexes);
		if (index_match!=null) index_match = index_match[0];
		element = element.replace(indexes,'.n.');
		
		if (this.datamodel[element]==null) { // Temporary: Catch unhandled element
			if (!element.match(/^adl.nav/))
				alert(element + " not found in datamodel. Report to: " + adminEmail);
			this.errorCode = "402";
			return "false";
		}
		
		if (index_match!=null) {
			index_match = index_match.replace(/\.(\d)+\./, "elements[$1]");
			element = element.replace('.n.', '.' + index_match + '.');
		}
		
		
		debugGroup("GetValue: '"+element+"'");
		debug(eval('this.' + element));
		debug(typeof eval('this.' + element));
		debugGroupClose();
		
		if (element.match('._count')!=null) {
			element = element.replace('._count', '.elements.length');
		}
		
		var value = eval('this.' + element);
		// Try to get the default value if none is set.
		if (value == null && this.datamodel[element]!=null && this.datamodel[element].defaultvalue!=null) {
			value = this.datamodel[element].defaultvalue;
		}
		return value;
		/*errorCode = "0";
		diagnostic = "";
		if ((this.Initialized) && (!this.Terminated)) {
			if (element !="") {
				var CMIIndex = '[._](\\d+).';
				expression = new RegExp(CMIIndex,'g');
				elementmodel = element.replace(expression,'.n.');
				
				if ((typeof eval('datamodel["'+elementmodel+'"]')) != "undefined") {
					if (eval('datamodel["'+elementmodel+'"].mod') != 'w') {

						element = element.replace(/\.(\d+)\./, ".N$1.");
						element = element.replace(/\.(\d+)\./, ".N$1.");

						elementIndexes = element.split('.');
						subelement = element.substr(0,3);
						i = 1;

						while ((i < elementIndexes.length) && (typeof eval(subelement) != "undefined")) {
							subelement += '.'+elementIndexes[i++];
						}

						if (subelement == element) {

							if ((typeof eval(subelement) != "undefined") && (eval(subelement) != null)) {
								errorCode = "0";
								return eval(element);
							} else {
								errorCode = "403";
							}
						} else {
							errorCode = "301";
						}
					} else {
						//errorCode = eval('datamodel["'+elementmodel+'"].readerror');
						errorCode = "405";
					}
				} else {
					childrenstr = '._children';
					countstr = '._count';
					if (elementmodel.substr(elementmodel.length-childrenstr.length, elementmodel.length) == childrenstr) {
						parentmodel = elementmodel.substr(0, elementmodel.length-childrenstr.length);
						if ((typeof eval('datamodel["'+parentmodel+'"]')) != "undefined") {
							errorCode = "301";
							diagnostic = "Data Model Element Does Not Have Children";
						} else {
							errorCode = "401";
						}
					} else if (elementmodel.substr(elementmodel.length-countstr.length, elementmodel.length) == countstr) {
						parentmodel = elementmodel.substr(0, elementmodel.length-countstr.length);
						if ((typeof eval('datamodel["'+parentmodel+'"]')) != "undefined") {
							errorCode = "301";
							diagnostic = "Data Model Element Cannot Have Count";
						} else {
							errorCode = "401";
						}
					} else {
						parentmodel = 'adl.nav.request_valid.';
						if (element.substr(0, parentmodel.length) == parentmodel) {
							if (element.substr(parentmodel.length).match(NAVTarget) == null) {
								errorCode = "301";
							} else {
								if (adl.nav.request == element.substr(parentmodel.length)) {
									return "true";
								} else if (adl.nav.request == '_none_') {
									return "unknown";
								} else {
									return "false";
								}
							}
						} else {
							errorCode = "401";
						}
					}
				}
			} else {
				errorCode = "301";
			}
		} else {
			if (this.Terminated) {				
				errorCode = "123";
			} else {
				errorCode = "122";
			}
		}*/
		return '';
	};
	
	this._validateDataModelElement = function(element, value) {
		var rules = this.datamodel[element];
		var formatRegex = new RegExp(rules.format);
		value = new String(value);
		var matches = value.match(formatRegex);
		debugGroup("validateDataModelElement " + element + " '" + value + "'");
		debug("Matches: '" + matches + "'");
		debug("Join: '" + matches.join('') + "'");
		debugGroupClose();
		if (matches==null) return false;
		return matches.join('').length != 0 || value.length == 0;
	}
	/* Description: The method is used to request the transfer to the LMS of the value of
	parameter_2 for the data element specified as parameter_1. This method allows the
	SCO to send information to the LMS for storage. The API Instance may be designed to
	immediately persist data that was set (to the server-side component) or store data in a
	local (client-side) cache.
	
	Return Value: The method can return one of two values. The return value shall be
	represented as a characterstring. The quotes ("") are not part of the characterstring
	returned; they are used purely to delineate the values returned.
	- "true"  The characterstring "true" shall be returned if the LMS accepts the
	   content of parameter_2 to set the value of parameter_1.
	- "false"  The characterstring "false" shall be returned if the LMS encounters
	   an error in setting the contents of parameter_1 with the value of parameter_2.
	   The SCO may call GetLastError() to determine the type of error. More detailed
	   information pertaining to the error may be provided by the LMS through the
	   GetDiagnostic() function.

	*/
	// TODO: hay que revisar que los element de las colecciones sean válidos. (ver por ejemplo cmi.comments_from_learner._children)
	this.SetValue = function(element, value){
		this.errorCode = "0";
		this.diagnostic = "";

		if ((this.Initialized) && (!this.Terminated)) {
			if (element=="") {
				this.errorCode = "351";
				return "false";
			}
			
			var indexes = new RegExp(this.CMIIndex,'g');
			var index_match = element.match(indexes);
			if (index_match!=null) {
				var index_str = '';
				for (i=0;i<index_match.length;i++) {
					element = element.replace(index_match[i], '.n' + index_str + '.')
					index_str = i+1;
				}
			}
			//index_match = index_match[0];
			element = element.replace(indexes,'.n.');
			
			if (this.datamodel[element]==null) { // Temporary: Catch unhandled element
				if (!element.match(/^adl.nav/))
					alert(element + " not found in datamodel. Report to: " + adminEmail);
				this.errorCode = "402";
				return "false";
			}
			debugGroup("Processing: " + element + " = '" + value + "'");
			var validates = this._validateDataModelElement(element, value);

			// If there was no match or if the match is empty (when value is not empty)
			if (!validates) {
				debug("!!Validates");
				this.errorCode = "406";
				return "false";
			}
			
			var elementPath = element.split('.');

			//if (this.errorCode == "0") {
				debugGroup("Type OF this.datamodel[element]");
				debug("ElementModel: " + element);
				debug("this.datamodel[element]");
				debug(this.datamodel[element]);
				debug("Type: " + (typeof this.datamodel[element]));
				debugGroupClose();
				if (typeof this.datamodel[element].range != 'undefined') {
					alert("Range not implemented.");
					/*range = this.datamodel[elementmodel].range;
					debug(range);
					ranges = range.split('#');
					value = value * 1.0;
					debugGroup("Ranges");
					debug(range);
					debug(ranges);
					debug(value);
					debugGroupClose();
					if (value >= ranges[0]) {
						if ((ranges[1] == '*') || (value <= ranges[1])) {
							eval(element+'="'+value+'";');
							errorCode = "0";
							debug("SetValue(" + element + ", " + value + ") -> OK");
							return "true";
						} else {
							errorCode = '407';
						}
					} else {
						errorCode = '407';
					}*/
				} 
				var element_parts = element.split('.');
				var obj_str_parent = 'this';
				
				for (i=0;i<element_parts.length;i++) {
					var collection_index = element_parts[i].match(/^n(\d*)$/);
					if (collection_index!=null) {
						if (eval(obj_str_parent) == null) {
							eval(obj_str_parent + ' = new Object()');
							eval(obj_str_parent + '.elements = new Array()');
						}
						collection_index[1] = (collection_index[1]=='') ? '0' : collection_index[1];
						var subindex = index_match[collection_index[1]];
						subindex = subindex.replace('.', '');
						if (eval(obj_str_parent + ".elements[" + subindex + "]") == null)
							eval(obj_str_parent + ".elements[" + subindex + "] = new Object();");
						obj_str_parent += '.elements[' + subindex + ']';
					} else {
						obj_str_parent += '.' + element_parts[i];
					}
				}
				eval(obj_str_parent + " = '" + value + "'");
				debugGroupClose();
				this.errorCode = "0"; 
				return "true";
			//}
		}
		return "";
	};
	
	/* Description: The method requests forwarding to the persistent data store any data from
	the SCO that may have been cached by the API Instance since the last call to
	Initialize("") or Commit(""); whichever occurred most recently. The LMS would
	then set the error code to 0 (No Error encountered) and return "true".
	
	If the API Instance does not cache values; Commit("") shall return "true" and set the
	error code to 0 (No Error encountered) and do no other processing.
	
	Cached data shall not be modified because of a call to the commit data method. For
	example; if the SCO sets the value of a data model element; then calls the commit data
	method; and then subsequently gets the value of the same data model element; the value
	returned shall be the value set in the call prior to invoking the commit data method. The
	Commit("") method can be used as a precautionary mechanism by the SCO. The method
	can be used to guarantee that data set by the SetValue() is persisted to reduce the
	likelihood that data is lost because the communication session is interrupted; ends
	abnormally or otherwise terminates prematurely prior to a call to Terminate("").
	*/
	this.Commit = function(empty){
		errorCode = "0";
		if (param == "") {
			if ((this.Initialized) && (!this.Terminated)) {
				result = StoreData(cmi,false);
				return "true";
			} else {
				if (this.Terminated) {
					errorCode = "143";
				} else {
					errorCode = "142";
				}
			}
		} else {
			errorCode = "201";
		}
		return "false";
	};
	
	/*Description: This method requests the error code for the current error state of the API
	Instance. If a SCO calls this method; the API Instance shall not alter the current error
	state; but simply return the requested information.
	A best practice recommendation is to check to see if a Session Method or Data-transfer
	Method was successful. The GetLastError() can be used to return the current error
	code. If an error was encountered during the processing of a function; the SCO may take
	appropriate steps to alleviate the problem.
		Return Value: The API Instance shall return the error code reflecting the current error
	state of the API Instance. The return value shall be a characterstring (convertible to an
	integer in the range from 0 to 65536 inclusive) representing the error code of the last
	error encountered.
	*/
	this.GetLastError = function(){
		return this.errorCode;
	};
	
	/*Description: The GetErrorString() function can be used to retrieve a textual
	description of the current error state. The function is used by a SCO to request the textual
	description for the error code specified by the value of the parameter. The API Instance
	shall be responsible for supporting the error codes identified in Section 3.1.7: API
	Implementation Error Codes. This call has no effect on the current error state; it simply
	returns the requested information.
		Return Value: The method shall return a textual message containing a description of the
	error code specified by the value of the parameter. The following requirements shall be
	adhered to for all return values:
	- The return value shall be a characterstring that has a maximum length of 255
	  characters.
	- SCORM makes no requirement on what the text of the characterstring shall
	  contain. The error codes themselves are explicitly and exclusively defined. The
	  textual description for the error code is LMS specific.
	- If the requested error code is unknown by the LMS; an empty characterstring ("")
	  shall be returned. This is the only time that an empty characterstring shall be
	  returned.

	*/
	this.GetErrorString = function(error_code){
		return this.GetErrorString(code);
	};
	
	/*Description: The GetDiagnostic() function exists for LMS specific use. It allows the
	LMS to define additional diagnostic information through the API Instance. This call has
	no effect on the current error state; it simply returns the requested information.
	*/
	this.GetDiagnostic = function(wtf){
		return '';
	};
	
	this.GetErrorString = function(param) {
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
					errorString = "Already this.Initialized";
				break;
				case "104":
					errorString = "Content Instance this.Terminated";
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
					errorString = "Data Model Element Value Not this.Initialized";
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
	};
	
	
}
var API_1484_11 = new Scorm_2004();
