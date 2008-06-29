OsmosisChat = {
	timestamp: 0,
	chat_box : null,
	wait_msg : null,
	container: null,
	labels : {
		me : 'me',
		close : 'close',
		minimize : 'minimize'
	},
	
	drawChatContainer: function () {
		$('body').createPrepend(
		    'div', { id : 'chat_container'}
		);
		OsmosisChat.container = $('#chat_container');
		OsmosisChat.container.height($(window).height());
		$(window).wresize(function() {
			OsmosisChat.container.height($(window).height());
		});
	},
	
	connect: function() {
		OsmosisChat.chat_box = $('#chat.boxed');
		OsmosisChat.chat_box.createAppend('p', {className : 'wait'}, 'Wait...');
		OsmosisChat.chat_box.createAppend('ul', {}, '');
		OsmosisChat.wait_msg = $('#chat p.wait');
		OsmosisChat.startWaiting();
		$.get(webroot + 'chat/chats/connect.xml', null, function(xml) {
			if ($('status', xml).text() == 1) {
				OsmosisChat.timestamp = $('time',xml).text();
			}
		}, 'xml');
	},
	
	init : function(labels) {
		OsmosisChat.labels = $.merge(labels, OsmosisChat.labels);
		OsmosisChat.drawChatContainer();
		OsmosisChat.connect();
		OsmosisChat.updateContactList();
		OsmosisChat.updateMessages();
	},	

	updateContactList : function() {
		$.ajax({
			type : 'GET',
			url  : webroot + 'members/online/course_id:' + active_course + '.xml',
			dataType : 'xml',
			error : function(xml) {
				// Unhandled
			},
			success : function(xml) {
				OsmosisChat.stopWaiting();
				var list = $('ul', OsmosisChat.chat_box).html('');
				$(xml).children().children().each(function() {
					var status = this.nodeName;
					$(this).children().each(function() {
						OsmosisChat.addContact($(this), status, list);
					});
				});
				setTimeout('OsmosisChat.updateContactList()', 10000);
			}
		});
	},
	
	addContact : function(member, status, list) {
		var member_id = member.attr('id'),
			full_name = member.attr('full_name');
		list.createAppend('li', {},
			[
				'a', {className : status, href : '#', rel : 'member_id:' + member_id + ',member_name:' + full_name}, full_name
			]
		);
		$('a', list).click(function(evt) {
			evt.preventDefault();
			var rel = this.rel;
			rel = rel.split(',');
			var member_id = rel[0].replace('member_id:', ''),
				member_name = rel[1].replace('member_name:', '');
			OsmosisChat.begin(member_id, member_name, true);
		})
	},
	
	begin: function(member_id, member_name, forceFocus) {
		var win = OsmosisChat.getWindow(member_id, member_name);
		$('.chat_head', win).click(OsmosisChat.onBoxRestore)
			.find('.chat_close').click(OsmosisChat.onBoxClose)
			.parent()
			.find('.chat_minimize').click(OsmosisChat.onBoxMinimize)
			.parents('.chat_window')
			.find('.chat_sendbox textarea').bind(
				'keyup',
				{member_id: member_id},
				OsmosisChat.onBoxKeyPress
			)
			.focus(OsmosisChat.onBoxFocus)
			.blur(OsmosisChat.onBoxBlur);
		if (forceFocus) $('#chat_window_'+user+' .chat_sendbox textarea', container).focus();
		return win;
	},

	onBoxRestore: function() {
		$(this).parents('.chat_window_container')
			.find('a.chat_minimize').removeClass('chat_restore')
		.parents('.chat_window_container')
			.find('.chat_canvas').slideDown('fast', function() {
				$(this).find('textarea').focus();
			})
	},

	onBoxMinimize: function(evt) {
		evt.preventDefault();
		var isMinimized = $(this).hasClass('chat_restore');
		var win = $(this)
			.toggleClass('chat_restore')
			.blur()
			.parents('.chat_window');
		win.find('.chat_canvas')
			.slideToggle('fast');
		if (isMinimized) {
			win.find('.chat_sendbox textarea').focus();
		} else {
			win.find('.chat_sendbox textarea').blur();
		}
		return false;
	},

	onBoxClose : function(evt) {
		evt.preventDefault();
		$(this).parents('.chat_window_container').hide('fast')
			.find('.chat_window').hide('fast', function() {
				$(this).find('textarea').blur()
			});
	},

	onBoxFocus: function() {
		$(this).addClass('focused')
			.parents('.chat_window').removeClass('chat_new_message');
	},
	
	onBoxBlur: function() {
		$(this).removeClass('focused')
			.parents('.chat_window').removeClass('chat_new_message');
	},

	onBoxKeyPress : function(evt) {
		switch(evt.keyCode) { 
			case 13 : //ENTER
				var box = evt.target;
				if (evt.shiftKey || box.value.match(/^[\n]+$/)) {
					return;
				}
				OsmosisChat.sendMessage(evt.data.member_id, box.value);
				box.value = '';
			break;
		}
	},

	sendMessage: function(member_id, message) {
		var container = $('#chat_window_' + member_id + ' .chat_messages');
		$.post(
			webroot + 'chat/messages/send/' + member_id +'.xml',
			{'data[Message][text]': message},
			function(xml) {
				OsmosisChat.confirmSend(container, xml);
			}
		);
		OsmosisChat.appendMessage(container, OsmosisChat.labels.me , message)
	},

	appendMessage : function(list, member_name, message) {
		list.createAppend(
		    'div', { className: 'chat_message' }, [
				'strong', {className: 'chat_nick'} , member_name + ': ',
				'span', {className: 'chat_message_text'} , message
			]
		);
		list.scrollTo('.chat_message:last-child');
	},

	confirmSend: function(container, xml) {
		if ($('status',xml).text() != 1) {
			container.createAppend(
			    'div', { className: 'chat_error'},
				[
					'span', {className: 'chat_message_error'}, $('error', xml).text()
				]
			);	
		}
	},
 	
	updateMessages :  function() {
		$.ajax({
			url : webroot + 'chat/messages/receive/' + OsmosisChat.timestamp + '.xml',
			success : function(xml) {
				OsmosisChat.addIncomingMessages(xml);
			 },
			timeout: 30000
		});
	},

	addIncomingMessages: function(xml) {
		OsmosisChat.timestamp = $('time',xml).text();
		$('message', xml).each(function() {
			var sender_id = this.getAttribute('sender_id'),
				sender_name = this.getAttribute('sender_name');
				
			var win = OsmosisChat.begin(sender_id, sender_name);
			var container = $('.chat_messages', win);
			OsmosisChat.appendMessage(container, this.getAttribute('sender_name'), $(this).text())
			
			var isFocused = container.parent().find('.chat_sendbox textarea').hasClass('focused');
			if(!isFocused) {
				container.parents('.chat_window').addClass('chat_new_message')
			}
			
		});
		setTimeout('OsmosisChat.updateMessages()', 2500);
	},

	getWindow : function(member_id, member_name) {
		var win = $('#chat_window_' + member_id);
		if (win.length==1) {
			if (win.css('display') == 'none') {
				win.parents('.chat_window_container').css('display', 'inline-block')
					.find('.chat_window').css('display', 'inline-block');
			}
			console.debug(win.find('.chat_canvas'));
			if (win.find('.chat_canvas').css('display') == 'none') {
				win.find('.chat_canvas').each(OsmosisChat.onBoxRestore);
			}
			win.find('textarea').focus();
			console.debug(win);
			return win;
		}
		OsmosisChat.container.createAppend(
			'div', {id : 'chat_window_container' + member_id, className: 'chat_window_container'},
				[
			    	'div', {className: 'chat_window', id : 'chat_window_' + member_id},
						[
							'div', {className: 'chat_head'},
								[
									'span', {className: 'chat_peername'}, member_name,
									'a', {className: 'chat_minimize' , href: '#', title: OsmosisChat.labels.minimize}, '',
									'a', {className: 'chat_close' , href: '#', title: OsmosisChat.labels.close}, '',
								],
							'div', {className: 'chat_canvas'},
								[
									'div', {className: 'chat_messages'} , '',
									'div', {className: 'chat_sendbox'} , ['textarea'],
								]
						]
				]
		);
		var container = $('#chat_window_' + member_id);
		container.parents('.chat_window_container').css('display', 'inline-block')
			.find('.chat_window').css('display', 'inline-block');
		
		container.find('textarea').autogrow().focus();
		container.find('.chat_messages').minmax();
		return container;
	},
	
	startWaiting : function() {
		OsmosisChat.wait_msg.show();
	},
	
	stopWaiting : function()  {
		OsmosisChat.wait_msg.hide();
	}
}