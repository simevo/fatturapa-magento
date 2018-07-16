<?php 
class Efatt_Module_Model_Observer
{
    public function adminhtmlWidgetContainerHtmlBefore($event)
    {   
        
        $paramsarray = Mage::app()->getRequest()->getParams('invoice_id');
        $invoicesid = $paramsarray["invoice_id"];
        $block = $event->getBlock();


        if ($block instanceof Mage_Adminhtml_Block_Sales_Order_Invoice_View) {

            $lUrl = "*/sales_invoice/viewinvoicespage/invoice_ids/" . $invoicesid;

            $block->addButton('test', array(
                'label'     => "Formato elettronico",
                'onclick'   => "setLocation('" . $block->getUrl($lUrl) . "')",
                'class'     => 'go'
                
            ));    

      
        }

        
    }
}
?>