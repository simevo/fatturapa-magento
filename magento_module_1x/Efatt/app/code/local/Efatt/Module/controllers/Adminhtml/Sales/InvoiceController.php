<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'InvoiceController.php';
class Efatt_Module_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{   
    public function viewinvoicespageAction() {

        $invoiceIds = $this->getRequest()->getParam('invoice_ids');

        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceIds);

        echo "<h1>Invoice data</h1>"; 

        echo "<pre>";
       	var_dump($invoice);
       	echo "</pre>";

        $order = Mage::getModel('sales/order')->load($invoice->order_id);

        echo "<h1>Order data</h1>"; 

        echo "<pre>";
       	var_dump($order);
       	echo "</pre>";
       	

       	
    }
}
?>