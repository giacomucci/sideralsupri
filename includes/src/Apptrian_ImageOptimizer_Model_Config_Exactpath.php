<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2016 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Model_Config_Exactpath extends Mage_Core_Model_Config_Data
{
    
    public function _beforeSave()
    {
    
        $result = $this->validate();
        
        if ($result !== true) {
            
            Mage::throwException(implode("\n", $result));
            
        }
        
        return parent::_beforeSave();
        
    }
    
    public function validate()
    {
        
        $errors = array();
        $helper = Mage::helper('apptrian_imageoptimizer');
        $value  = $this->getValue();
        
        if (!Zend_Validate::is($value, 'Regex', array('pattern' => '/^[\p{L}\p{N}_,;:!&#\+\*\$\?\|\'\.\-\ \/\\\\]*$/iu'))) {
            $errors[] = $helper->__('One or more of Utility Exact Path fields are invalid.');
        }
        
        if (empty($errors)) {
            return true;
        }
        
        return $errors;
        
    }
    
}