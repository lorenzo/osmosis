<script type="text/javascript">
OsmosisChat = {
	timestamp: 0,
	
	connect: function() {
		$.get(webroot + 'chat/chats/connect.xml',null,function(xml) {
			if ($('status',xml).text() == 1) OsmosisChat.timestamp = $('time',xml).text();
		});
	},
	
	drawChatContainer: function () {
		$('body').createAppend(
		    'div', { id : 'chat_container'}
		);
	},
	
	setPeerDisplayName: function(user) {
		$.get(webroot + 'chat/chats/user/'+user+'.xml',null,function(xml) {
			if ($('status',xml).text() == 1){
				var name = $('user name',xml).text();
				if (name.length > 0) {
					$('#chat_window_'+user+' .chat_peername')[0].innerHTML = name;
				}
			}
		});
	},
	
	begin: function(user,forceFocus) {
		var container = $('#chat_container');
		var win =  $('#chat_window_'+user,container);
		if (win.length == 1) {
			win.show('fast').find('.chat_canvas').slideDown("fast").find('.chat_sendbox textarea').focus();
			return;
		} else {
			container.createAppend(
			    'div', { className: 'chat_window', id : 'chat_window_'+user }, [
					'div', {className: 'chat_head'} , [
						'span', {className: 'chat_peername'}, '',
						'a', {className: 'chat_minimize' , href: '#', title: '<?php __("minimize")?>'}, '',
						'a', {className: 'chat_close' , href: '#', title: '<?php __("close")?>'}, '',
					],
					'div', {className: 'chat_canvas'} , [
						'div', {className: 'chat_messages'} , '',
						'div', {className: 'chat_sendbox'} , ['textarea'],
					]
				]
			); 
			win =  $('#chat_window_'+user,container);
		}
		OsmosisChat.setPeerDisplayName(user);

		$('.chat_head',win).click(OsmosisChat.onBoxRestore)
		.find('.chat_close').click(OsmosisChat.onBoxClose)
		.parent()
		.find('.chat_minimize').click(OsmosisChat.onBoxMinimize)
		.parents('.chat_window')
		.find('.chat_sendbox textarea').bind('keyup',{user: user},OsmosisChat.onBoxKeyPress).scroll(function(){alert('hola')})
		.focus(OsmosisChat.onBoxFocus).blur(OsmosisChat.onBoxFocus);
		if (forceFocus) $('#chat_window_'+user+' .chat_sendbox textarea',container).focus();
	},
	
	onBoxRestore: function() {
		$(this).parents('.chat_window').find('a.chat_minimize').removeClass('chat_restore').parents('.chat_window')
		.find('.chat_canvas')
		.slideDown('fast')
	},
	
	onBoxMinimize: function() {
		$(this).toggleClass('chat_restore').parents('.chat_window')
		.find('.chat_canvas')
		.slideToggle("fast")
		.find('.chat_sendbox textarea')
		.focus();
		return false;
	},
	
	onBoxClose : function(){
		$(this).parents('.chat_window').hide("fast"); return false;
	},
	
	onBoxFocus: function() {
		$(this).toggleClass('focused').parents('.chat_window').find('.chat_head').removeClass('chat_new_message');
	},
	
	onBoxKeyPress: function(event){
		switch(event.keyCode) { 
			case 13 : //ENTER
				var box = event.target;
				if (event.shiftKey || box.value.match(/^[\n]+$/)) return;
				OsmosisChat.sendMessage(event.data.user,box.value);
				box.value = '';
				break;
		}
	},
	
	sendMessage: function(user,message) {
		$.post(webroot + 'chat/messages/send/' + user +'.xml',{ "data[Message][text]":message }, function(xml) {
		  OsmosisChat.confirmSend($('#chat_window_'+user+' .chat_messages'),message,xml);
		 });
		$('#chat_window_'+user+' .chat_messages').createAppend(
		    'div', { className: 'chat_message' }, [
				'strong', {className: 'chat_nick'} , '<?php echo __("me")?>: ',
				'span', {className: 'chat_message_text'} , message
			]
		);
		$('#chat_window_'+user+' .chat_messages').scrollTo('div.chat_message:last-child');
	},
	
	confirmSend: function(container,message,xml) {
		if ($('status',xml).text() != 1) {
		$('#chat_window_'+user+' .chat_messages').createAppend(
			    'div', { className: 'chat_errir' }, [
					'span', {className: 'chat_message_error'} , $('error',xml).text()
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
		$('message',xml).each(function() {
			var sender = this.getAttribute('sender_id');
			var container = $('#chat_window_'+ sender + ' .chat_messages');
			if (container.length < 1) {
				OsmosisChat.begin(sender);
				container = $('#chat_window_'+ sender + ' .chat_messages');
			} 
			container.createAppend(
			    'div', { className: 'chat_message' }, [
					'strong', {className: 'chat_nick'} , this.getAttribute('sender_name') + ': ',
					'span', {className: 'chat_message_text'} , $(this).text()
				]
			);
			if(!container.parent().find('.chat_sendbox textarea').hasClass('focused')) {
				container.parents('.chat_window').find('.chat_head').addClass('chat_new_message')
			}
			container.scrollTo('div.chat_message:last-child');
		});
		setTimeout('OsmosisChat.updateMessages()', 2500);
	}
}

$(document).ready(function(){
	OsmosisChat.connect();
	OsmosisChat.drawChatContainer();
   //setTimeout('OsmosisChat.updateMessages()', 2500);
   });
</script>
<div id="chat" class="boxed">
	<strong class="title"><?php __('Chat')?></strong>
	<ul>
		<li class="even"><a class="online" href="#" onclick="OsmosisChat.begin(1,true); return false;">José Lorenzo Rodríguez</a></li>
		<li class="odd"><a class="busy" href="#" onclick="OsmosisChat.begin(2,true); return false;">Joaquín Windmuller</a></li>
		<li class="even"><a class="offline" href="#" onclick="OsmosisChat.begin(3,true); return false;">María Gabriela Días</a></li>
	</ul>
</div>