<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'InvoiceController.php';
class Efatt_Module_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{   
    public function viewinvoicespageAction() {

        $invoiceIds = $this->getRequest()->getParam('invoice_ids');

        /* estraggo l'oggetto fattura */
        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceIds);

        /* estraggo l'oggetto order */
        $order = Mage::getModel('sales/order')->load($invoice->order_id);

        /* estraggo il billing address */
        $address = Mage::getModel('customer/address')->load($order->billing_address_id);

		/* mostro per sviluppo i dati di entrambi gli oggettti */
        echo "<h1>Invoice data</h1>"; 

        echo "<pre>";
       	var_dump($invoice);
       	echo "</pre>";

        echo "<h1>Order data</h1>"; 

        echo "<pre>";
       	var_dump($order);
       	echo "</pre>";

       	echo "<h1>Billing address</h1>"; 

        echo "<pre>";
       	var_dump($address);
       	echo "</pre>";

       	/* genero la fattura xml */

       	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
       	$xml .= '<FatturaElettronicaHeader>';
       	$xml .= '<CedentePrestatore>';
        $xml .= '<DatiAnagrafici>';
        $xml .= '<Anagrafica>';



	    header('Content-type: text/xml');
		header('Content-Disposition: attachment; filename="text.xml"');

		echo $xmlString;
		exit();

       	
    }
}
?>