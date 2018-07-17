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
		$bAddress = $order->getBillingAddress();

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
       	var_dump($bAddress);
       	echo "</pre>";

       	/* genero la fattura xml */

       	echo "<h1>Oggetto fattura</h1>";

       	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
       	$xml .= '<FatturaElettronicaHeader>';
       	$xml .= '<CedentePrestatore>';
        $xml .= '<DatiAnagrafici>';
        $xml .= '<Anagrafica>';
        $xml .= '<Denominazione>';
        $xml .= $bAddress->firstname . " " . $bAddress->lastname;
        $xml .= '</Denominazione>';
        $xml .= '</Anagrafica>';
        $xml .= '</DatiAnagrafici>';
        $xml .= '</CedentePrestatore>';
        $xml .= '</FatturaElettronicaHeader>';


	    $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
	    echo "<pre>";
		print_r($xml);
		echo "</pre>";
		exit();

       	
    }
}
?>