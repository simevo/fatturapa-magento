<?php
class Efatt_Module_Model_System_Config_Source_View 
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'RF01', 'label' => Mage::helper('adminhtml')->__('RF01')),
            array('value' => 'RF02', 'label' => Mage::helper('adminhtml')->__('RF02')),
            array('value' => 'RF03', 'label' => Mage::helper('adminhtml')->__('RF03')),
        );


    }

}