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
              $xml .= '<IdPaese>' . $store->merchant_country . '</IdPaese>'; //questo si potrebbe prendere dai dati dello store magento?
              $xml .= '<IdCodice>' . $store->merchant_vat_number . '</IdCodice>'; //codice fiscale del trasmittente
            $xml .= '</IdTrasmittente>';
            $xml .= '<ProgressivoInvio>' . $invoice->entity_id . '</ProgressivoInvio>';
            $xml .= '<FormatoTrasmissione>FPA12</FormatoTrasmissione>'; //versione del tracciato con cui è stato predisposto il documento fattura
            $xml .= '<CodiceDestinatario>AAAAAA</CodiceDestinatario>'; //deve corrispondere al campo Codice Ufficio riportato nella rubrica Indice PA
          $xml .= '</DatiTrasmissione>';   

          $xml .= '<CedentePrestatore>';
            $xml .= '<DatiAnagrafici>';
              $xml .= '<IdFiscaleIVA>';
              $xml .= '<IdPaese>' . $store->merchant_country . '</IdPaese>';
              $xml .= '<IdCodice>' . $store->merchant_vat_number . '</IdCodice>'; //codice fiscale prestatore
              $xml .= '</IdFiscaleIVA>';
              $xml .= '<Anagrafica>';
              $xml .= '<Denominazione>' . $store->name . '</Denominazione>';
              $xml .= '</Anagrafica>';
              $xml .= '<RegimeFiscale>RF01</RegimeFiscale>'; // ??
              $xml .= '</DatiAnagrafici>';
              $xml .= '<Sede>';
              $xml .= '<Indirizzo>' . $store->address . '</Indirizzo>';
              $xml .= '<CAP></CAP>';
              $xml .= '<Comune></Comune>';
              $xml .= '<Provincia></Provincia>';
              $xml .= '<Nazione>' . $store->merchant_country . '</Nazione>';
            $xml .= '</Sede>';
          $xml .= '</CedentePrestatore>';
/** questo serve solo se c'è un concesionario 
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
**/
        $xml .= '</FatturaElettronicaHeader>';

        $xml .= '<FatturaElettronicaBody>';
          $xml .= '<DatiGenerali>';
            $xml .= '<DatiGeneraliDocumento>';
              $xml .= '<TipoDocumento>TD01</TipoDocumento>'; // fattura, acconto, anticipo su fattura, nota di credito, parcella
              $xml .= '<Divisa>EUR</Divisa>'; // questo va preso da magento
              $xml .= '<Data>' . $order->updated_at . '</Data>';
              $xml .= '<Numero>123</Numero>';
              $xml .= '<Causale>LA FATTURA FA RIFERIMENTO AD UNA OPERAZIONE AAAA BBBBBBBBBBBBBBBBBB CCC DDDDDDDDDDDDDDD E FFFFFFFFFFFFFFFFFFFF GGGGGGGGGG HHHHHHH II LLLLLLLLLLLLLLLLL MMM NNNNN OO PPPPPPPPPPP QQQQ RRRR SSSSSSSSSSSSSS</Causale>';
              $xml .= '<Causale>SEGUE DESCRIZIONE CAUSALE NEL CASO IN CUI NON SIANO STATI SUFFICIENTI 200 CARATTERI AAAAAAAAAAA BBBBBBBBBBBBBBBBB</Causale>';
            $xml .= '</DatiGeneraliDocumento>';



          $xml .= '</DatiGenerali>';
        $xml .= '</FatturaElettronicaBody>';



      // $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
      $xml=simplexml_load_string($xml);

      libxml_use_internal_errors(true);
      if ($xml === false) {
          $errors = libxml_get_errors();
          print_r($errors);
      }

      echo "<pre>";
      print_r($xml);
      echo "</pre>";
    exit();
    }
}
?>