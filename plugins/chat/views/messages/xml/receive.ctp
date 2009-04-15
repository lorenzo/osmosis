<response>
<?php echo $xml->elem('time',array(),$timestamp); ?>
	<messages>
		<?php foreach($messages as $message) :?>
			<?php echo $xml->elem('message',array(
				'sender_id' => $message['Message']['sender_id'],
				'sender_name' => $message['Sender']['full_name']
				)
				,$message['Message']['text']) ?>
		<?php endforeach;?>
	</messages>
</response>