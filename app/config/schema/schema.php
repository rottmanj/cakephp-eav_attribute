<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2011-09-01 01:09:32 : 1314865472*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $eav_attributes = array(
		'attribute_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'attribute_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'backend_model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'frontend_input' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'frontend_label' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'is_required' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'is_user_defined' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'is_unique' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'attribute_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
}
?>