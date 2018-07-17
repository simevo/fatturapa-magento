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

        /* store info */
        $store = Mage::getStoreConfig('general/store_information');

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

        echo "<h1>Store info</h1>"; 

        echo "<pre>";
        var_dump($store);
        echo "</pre>";

       	/* genero la fattura xml */

       	echo "<h1>Oggetto fattura</h1>";

       	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
       	$xml .= '<FatturaElettronicaHeader>';
          $xml .= '<DatiTrasmissione>';
            $xml .= '<IdTrasmittente>';
              $xml .= '<IdPaese>IT</IdPaese>'; //questo si potrebbe prendere dai dati dello store magento?
              $xml .= '<IdCodice>01234567890</IdCodice>'; //codice fiscale del trasmittente
            $xml .= '</IdTrasmittente>';
            $xml .= '<ProgressivoInvio>';
            $xml .= $invoice->entity_id;
            $xml .= '</ProgressivoInvio>';
            $xml .= '<FormatoTrasmissione>FPA12</FormatoTrasmissione>'; //versione del tracciato con cui è stato predisposto il documento fattura
            $xml .= '<CodiceDestinatario>AAAAAA</CodiceDestinatario>'; //deve corrispondere al campo Codice Ufficio riportato nella rubrica Indice PA
          $xml .= '</DatiTrasmissione>';   

          $xml .= '<CedentePrestatore>';
            $xml .= '<DatiAnagrafici>';
              $xml .= '<IdFiscaleIVA>';
              $xml .= '<IdPaese>IT</IdPaese>';
              $xml .= '<IdCodice>01234567890</IdCodice>'; //codice fiscale prestatore
              $xml .= '</IdFiscaleIVA>';
              $xml .= '<Anagrafica>';
              $xml .= '<Denominazione>ALPHA SRL</Denominazione>'; //questo si potrebbe prendere dai dati dello store magento?
              $xml .= '</Anagrafica>';
              $xml .= '<RegimeFiscale>RF01</RegimeFiscale>';
              $xml .= '</DatiAnagrafici>';
              $xml .= '<Sede>';
              $xml .= '<Indirizzo>VIALE ROMA 543</Indirizzo>';
              $xml .= '<CAP>07100</CAP>';
              $xml .= '<Comune>SASSARI</Comune>';
              $xml .= '<Provincia>SS</Provincia>';
              $xml .= '<Nazione>IT</Nazione>';
            $xml .= '</Sede>';
          $xml .= '</CedentePrestatore>';

          $xml .= '<CessionarioCommittente>';
            $xml .= '<DatiAnagrafici>';
              $xml .= '<CodiceFiscale>09876543210</CodiceFiscale>';
              $xml .= '<Anagrafica>';
                $xml .= '<Denominazione>AMMINISTRAZIONE BETA</Denominazione>';
              $xml .= '</Anagrafica>';
            $xml .= '</DatiAnagrafici>';
            $xml .= '<Sede>';
              $xml .= '<Indirizzo>VIA TORINO 38-B</Indirizzo>';
              $xml .= '<CAP>00145</CAP>';
              $xml .= '<Comune>ROMA</Comune>';
              $xml .= '<Provincia>RM</Provincia>';
              $xml .= '<Nazione>IT</Nazione>';
            $xml .= '</Sede>';
          $xml .= '</CessionarioCommittente>';

        $xml .= '</FatturaElettronicaHeader>';


	    $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
	    echo "<pre>";
  		print_r($xml);
  		echo "</pre>";
		exit();

       	
    }
}
?>