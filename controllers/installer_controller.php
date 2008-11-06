<?php
App::import('core', 'ConnectionManager');
class InstallerController extends Controller {
	var $uses = null;
    var $components = null;

	function beforeFilter() {
		$this->components = array('Session');
		App::import('Component','Session');
		$this->Session = new SessionComponent();
	}
	
	function beforeRender() {}
	function afterFilter() {}

	function index($step = 'start') {
		$valid_steps = array(
			'database_info',
			'configure_users'
		);
		if (!in_array($step, $valid_steps)) {
			$this->redirect(array('action' => 'index', $valid_steps[0]));
		}
		$this->{$step}();
		$this->render($step, 'install');
	}
	
	function database_info() {
		$config_file_location = CONFIGS . 'database.php';
		if (file_exists($config_file_location)) {
			$this->redirect(array('action' => 'index', 'configure_users'));
		}
		if (!empty($this->data)) {
			@$db = &ConnectionManager::create('test',
				array(
					'driver'		=> $this->data['Installer']['driver'],
					'persistent'	=> false,
					'host'			=> $this->data['Installer']['host'],
					'port'			=> $this->data['Installer']['port'],
					'login'			=> $this->data['Installer']['dbusername'],
					'password'		=> $this->data['Installer']['dbpassword'],
					'database'		=> $this->data['Installer']['name'],
					'schema'		=> '',
					'prefix'		=>  $this->data['Installer']['prefix'],   
					'encoding'		=> 'UTF-8'
				)
			);
			if ($db->connected) {
				$randomtablename='deleteme'.rand(100,100000);    
			    $result = $db->execute("CREATE TABLE $randomtablename (a varchar(10))"); 
			    if (!isset($db->error)) {
					$result = $db->execute("drop TABLE $randomtablename"); 
			    }
			    if (!isset($db->error)) {
					$dbconfig = $db->config;
					unset($dbconfig['connect']);
					unset($dbconfig['schema']);
					$config = 'var $default = ' . var_export($dbconfig, true);
					$config = str_replace("\n", "\n\t", $config);
					$config = "<?php\nclass DATABASE_CONFIG {\n\t$config;\n}\n?>";
					App::import('core', 'File');
					$config_file = new File($config_file_location);
					if ($config_file->create()) {
						$config_file->write($config);
						$config_file->close();
						$this->redirect(array('action' => 'step', 'configure_users'));
					} else {
						$this->set('dbFileNotWritable', $config);
						$this->set('dbConfigFile', $config_file_location);
					}
				}
				if(isset($db->error) && !empty($db->error))
					$this->set('dberror', true);
			} else {
				$this->set('dberror', true);
			}
		}
		$drivers =	array(
			'mysql' => 'MySQL',
			'postgres' => 'PostgreSQL'
		);
		$this->set(compact('drivers'));
	}

	function configure_users() {
		if (!file_exists(CONFIGS . 'database.php')) {
			$this->redirect(array('action' => 'index'));
		}
		App::import('Component', 'Installer');
		$installer = new InstallerComponent();
		$installer->startup(&$this);
		$installer->createSchema();
		// die;
	}
}
?>
