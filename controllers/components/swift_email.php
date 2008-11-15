<?php
/* SVN FILE: $Id$ */
/**
 * Short description for swift_email.php
 * 
 * Long description for swift_email.php
 * 
 * PHP versions 4 and 5
 * 
 * Copyright (c) 2008, Marcin Domanski
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @filesource
 * @copyright            Copyright (c) 2008, Marcin Domanski
 * @link                 www.kabturek.info
 * @link                 http://www.assembla.com/wiki/show/swift_email_component
 * @package              
 * @subpackage           projects.swift_email.controllers.components
 * @version              0.2
 * @modifiedBy           kabturek
 * @lastModified         Wed Jun 18 17:52:54 CEST 2008
 * @license              http://www.opensource.org/licenses/mit-license.php The MIT License
 */

//mime_content_type is deprecated
if (!function_exists('mime_content_type')) {
	function mime_content_type($filename) {
		$finfo    = finfo_open(FILEINFO_MIME);
		$mimetype = finfo_file($finfo, $filename);
		finfo_close($finfo);
		return $mimetype;
	}
}
/**
 * SwiftEmailComponent class
 * this is a drop in replacement for CakePHP EmailComponent using the excellent SwiftMailer library
 * 
 * @uses                 EmailComponent
 * @package              
 * @subpackage           controllers.components
 */

App::import('Component', 'Email');
App::import('Vendor', 'Swift', array('file' => 'Swift'.DS.'lib'.DS.'Swift.php')); 

class SwiftEmailComponent extends EmailComponent {

/**
 * the Swift class instance
 *
 * 
 * @var mixed
 * @access public
 */
	var $Swift;
/**
 * the Swift Message instance
 * 
 * @var mixed
 * @access public
 */
	var $Message;

/**
 * Send an email using the specified content, template and layout
 *
 * @param mixed $content Either an array of text lines, or a string with contents
 * @param string $template Template to use when sending email
 * @param string $layout Layout to use to enclose email body
 * @return boolean Success
 * @access public
 */
	function send($content = null, $template = null, $layout = null) {
		$number_sent = 0;
		try {
			$__method = '__'.$this->delivery;
			$this->$__method();

			$this->Message =& new Swift_Message($this->subject); 
			if(!empty($this->return)){
				$this->Message->setReturnPath($this->return);
			}


			if ($template) {
				$this->template = $template;
			}

			if ($layout) {
				$this->layout = $layout;
			}

			if (is_array($content)) {
				$message = null;
				foreach ($content as $key => $value) {
					$message .= $value . $this->_newLine;
				}
			} else {
				$message = $content;
			}

			if ($template === null && $this->template === null) {
				$this->Message->attach(new Swift_Message_Part($message, "text/plain")); 
			} else {
				$this->__message = $this->__renderTemplate($message);
			}

			if (!empty($this->attachments)) {
				$this->__attachFiles();
			}

			if ($this->_debug) {
				return $this->__debug();
			}
			$recipients = $this->_formatRecipients();
			$from = $this->__formatAddress($this->from);

			$number_sent = $this->Swift->send($this->Message, $recipients, new Swift_Address($from[0][0], $from[0][1]));
		} catch (Swift_ConnectionException $e) {
			debug( "There was a problem communicating with SMTP: " . $e->getMessage());
		} catch (Swift_Message_MimeException $e) {
			debug( "There was an unexpected problem building the email:" . $e->getMessage());
		}

		return $number_sent;
	}
/**
 * formatRecipients function
 * formats the recipients (to,cc,bcc) from cake format ('name <email>') to swift array format
 * 
 * @access protected
 * @return void
 */
	function _formatRecipients(){
		$recipients =& new Swift_RecipientList();
		foreach(array('to','cc','bcc') as $type){
			${$type} = $this->__formatAddress($this->{$type});
			foreach(${$type} as $address){
				$recipients->add($address[0], $address[1], $type);
			}
		}
		return $recipients;

	}
/**
 * Format a string as an email address
 *
 * @param array $addresses array of email addresses to format 
 * @return array email addreses in the format of array(array('email@domain', 'name'), ...)
 * @access private
 */
	function __formatAddress($addresses) {
		if(!is_array($addresses)){
			$addresses = array($addresses);
		}
		$formated = array();
		foreach($addresses as $address){
			if(!is_array($address)){
				if (strpos($address, '<') !== false) {
					$value = explode('<', $address);
					$formated[] = array(str_replace('>', '',$value[1]), $value[0]);
				} else {
					$formated[] = array($address, null);
				}
			}
		}
		return $formated;
		
	}
/**
 * Attach files
 *
 * @access private
 */
	function __attachFiles() {
		$files = array();
		foreach ($this->attachments as $attachment) {
			$file = $this->__findFiles($attachment);
			if (!empty($file)) {
				$files[] = $file;
			}
		}

		foreach ($files as $file) {
			$handle = fopen($file, 'rb');
			$data = fread($handle, filesize($file));
			$this->Message->attach(new Swift_Message_Attachment($data, $file));

			fclose($handle);
		}
	}


/**
 * Render the contents using the current layout and template.
 *
 * @param string $content Content to render
 * @return string Email ready to be sent
 * @access private
 */
	function __renderTemplate($content) {
		$viewClass = $this->Controller->view;

		if ($viewClass != 'View') {
			if (strpos($viewClass, '.') !== false) {
				list($plugin, $viewClass) = explode('.', $viewClass);
			}
			$viewClass = $viewClass . 'View';
			App::import('View', $this->Controller->view);
		}
		$View = new $viewClass($this->Controller, false);
		$View->layout = $this->layout;
		$msg = null;

		if ($this->sendAs === 'both') {
			$htmlContent = $content;

			$content = $View->element('email' . DS . 'text' . DS . $this->template, array('content' => $content), true);
			$View->layoutPath = 'email' . DS . 'text';
			$this->Message->attach(new Swift_Message_Part($View->renderLayout($content)));


			$content = $View->element('email' . DS . 'html' . DS . $this->template, array('content' => $htmlContent), true);
			$View->layoutPath = 'email' . DS . 'html';
			$this->Message->attach(new Swift_Message_Part($View->renderLayout($content), 'text/html'));
			return true;

		}


		$content = $View->element('email' . DS . $this->sendAs . DS . $this->template, array('content' => $content), true);
		$View->layoutPath = 'email' . DS . $this->sendAs;
		if($this->sendAs == 'text'){
			$mime = 'text/plain';
		}else{
			$mime = 'text/html';
		}
		$this->Message->attach(new Swift_Message_Part($View->renderLayout($content), $mime));
		return true;
	}

/**
 * mail function
 * sending using the Swift_Connection_NativeMail
 * 
 * @access private
 * @return void
 */
	function __mail() {
		App::import('Vendor', 'Swift_Connection_NativeMail', array('file' => 'Swift'.DS.'lib'.DS.'Swift'.DS.'Connection'.DS.'NativeMail.php'));

		// Return the swift mailer object.
		$this->Swift = new Swift(new Swift_Connection_NativeMail()); 
	}

/**
 * smtp function
 * sending using the Swift_Connection_SMTP class
 * 
 * @access private
 * @return void
 */
	function __smtp() {
		App::import('Vendor', 'Swift_Connection_SMTP', array('file' => 'Swift'.DS.'lib'.DS.'Swift'.DS.'Connection'.DS.'SMTP.php'));

		// Detect SMTP host if not provided.
		if (empty($this->smtpOptions['host'])) {
			$this->smtpOptions['host'] = Swift_Connection_SMTP::AUTO_DETECT;
		}

		// Detect SMTP port if not provided.
		if (empty($this->smtpOptions['port'])) {
			$this->smtpOptions['port'] = Swift_Connection_SMTP::AUTO_DETECT;
		}

		// Determine what type of connection to use (open, ssl, tls).
		if(empty($this->smtpOptions['type'])){
			$this->smtpOptions['type'] = 'open';
		}
		switch ($this->smtpOptions['type']) {
		case 'ssl':
			$smtpType = Swift_Connection_SMTP::ENC_SSL; 
			break;
		case 'tls':
			$smtpType = Swift_Connection_SMTP::ENC_TLS; 
			break;
		case 'open': 
		default:
			$smtpType = Swift_Connection_SMTP::ENC_OFF;
		}

		// Create the swift mailer object, and prepare authentication if required.
		$smtp =& new Swift_Connection_SMTP($this->smtpOptions['host'], $this->smtpOptions['port'], $smtpType);
		$smtp->setTimeout($this->smtpOptions['timeout']);

		if (!empty($this->smtpOptions['username'])) {
			$smtp->setUsername($this->smtpOptions['username']);
			$smtp->setPassword($this->smtpOptions['password']);
		}

		// Return the swift mailer object.
		$this->Swift = new Swift($smtp); 
		return $this->Swift;
	}

}
?>
