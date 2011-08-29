<?php
class EavEntityBehavior extends ModelBehavior{
        var $settings = array();

        function setup(&$Model, $settings = array()) 
        {
                foreach ($Model->hasMany as $assoc => $option) 
                {
                        $base[$Model->$assoc->name] = array('schema' => $Model->$assoc->schema(),'with' => $assoc, 'foreignKey' => $Model->hasMany[$assoc]['foreignKey']);                      
                        $this->settings[$Model->alias] = am($base, !empty($settings) ? $settings : array());
                }
                
                return $this->settings;
        }
        
        function afterSave(&$Model)
        {
                App::import('Model','EavAttribute');
                $eavAttribute = new EavAttribute();
                foreach($this->settings[$Model->alias] as $assoc)
                {
                        $attributes = $eavAttribute->find('all', array('conditions' => array('backend_model =' => $assoc['with'])));    
                        if(!empty($attributes))
                        {
                                $i = 0;
                                foreach($attributes as $attribute)
                                {
                                        $Model->{$assoc['with']}->create(false);
                                        extract($attributes[$i][$eavAttribute->alias],EXTR_OVERWRITE);                                  
                                        if(isset($Model->data[$assoc['with']][$attribute_code]))
                                        {
                                                $attributeExists = $Model->{$assoc['with']}->find('all',
                                                        array('conditions' => array(
                                                                array('attribute_id ='=>$attribute_id),
                                                                array('AND ' => array('entity_id'=>$Model->data[$Model->alias]['entity_id'])))));              
                                                if(!empty($attributeExists))
                                                {
                                                        $Model->{$assoc['with']}->set('id',$attributeExists[0][$Model->{$assoc['with']}->alias]['id']);
                                                }
                                                $Model->{$assoc['with']}->set('attribute_id',$attribute_id);
                                                $Model->{$assoc['with']}->set('entity_id',$Model->data[$Model->alias]['entity_id']);
                                                $Model->{$assoc['with']}->set('value',$Model->data[$assoc['with']][$attribute_code]);
                                                
                                                $Model->{$assoc['with']}->save();
                                        }
                                $i++;
                                }
                        }                       
                }
        }
}
?>
