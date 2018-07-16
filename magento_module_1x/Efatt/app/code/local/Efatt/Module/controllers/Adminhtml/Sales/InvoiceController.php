<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'InvoiceController.php';
class Efatt_Module_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{   
    public function viewinvoicespageAction() {

        $invoiceIds = $this->getRequest()->getParam('invoice_ids');

        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceIds);
       	
       	echo "<pre>";
       	var_dump($invoice);
       	echo "</pre>";
    }
}
?>