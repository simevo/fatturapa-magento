<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'InvoiceController.php';
class Efatt_Module_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{   
    public function viewinvoicespageAction() {
        $invoiceIds = $this->getRequest()->getParam('invoice_ids');
       	
       	echo $invoiceIds;
    }
}
?>