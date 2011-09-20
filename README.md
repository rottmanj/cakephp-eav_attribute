Overview
========

Provides a method of EAV data storage for models

Install
=======
* Copy the `app/models` directory into your project
* Import the provided `app/config/schema` schema file 


Requirements
============

* Top level entity model has an hasMany association to the child attribute models
* Top level associations require an attribute in the association definition named `isEav`
* Child attribute models have an belongsTo association to the top level entity model
* Child attribute models have an hasOne association to the `EavAttribute` model

Usage Example
========

* Top level Entity Model (UserEntity)
		
		<?php
			class UserEntity extends AppModel {
		        var $name = 'UserEntity';
		        var $primaryKey = 'entity_id';
		        var $actsAs = array('EavEntity');
		        
		        var $hasMany = array(
	                'UserEntityVarchar' => array(
	                        'className' => 'UserEntityVarchar',
	                        'isEav' => 'true',
	                        'foreignKey' => 'entity_id',
	                        'dependent' => false,
	                        'conditions' => '',
	                        'fields' => '',
	                        'order' => '',
	                        'limit' => '',
	                        'offset' => '',
	                        'exclusive' => '',
	                        'finderQuery' => '',
	                        'counterQuery' => ''
	                )
		        );
			}
			?>
			
* Child Attribute Model (UserEntityVarchar)		
		<?php
			class UserEntityVarchar extends AppModel {
		        var $name = 'UserEntityVarchar';
		        var $primaryKey = 'value_id';
		        
		        var $belongsTo = array(
		                'UserEntity'=>array(
		                'foreignKey' => 'entity_id'
		                ));
		        var $hasOne = array(
		                'EavAttribute' => array(
		                'foreignKey' => 'attribute_id'
		                ));
			
			}
		?>
	
