 public function viewinvoicespageAction() {
        $invoiceIds = $this->getRequest()->getParam('invoice_ids');
        /* estraggo l'oggetto fattura */
        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceIds);
        /* estraggo l'oggetto order */
        $order = Mage::getModel('sales/order')->load($invoice->order_id);
        /* estraggo il billing address */
        $bAddress = $order->getBillingAddress();
        /* store info */
        $store = Mage::getStoreConfig('efatt/efatt');
        /* product info */
        $ordered_items = $order->getAllItems();
        foreach($ordered_items as $item){  
          $desc = '<li><span>ID: '.$item->getItemId().'</span>'; //product id
          $desc .= '<span>Sku: '.$item->getSku().'</span>';
          $desc .= '<span>Quantità: '.$item->getQtyOrdered().'</span>'; //ordered qty of item
          $desc .= '<span>Prodotto: '.$item->getName().'</span></li>';
        }
    /* mostro per sviluppo i dati degli oggettti */
        echo "<h2>Invoice data</h2>"; 
        echo "<pre>";
        var_dump($invoice);
        echo "</pre>";
        echo "<h2>Order data</h2>"; 
        echo "<pre>";
        var_dump($order);
        echo "</pre>";
        echo "<h2>Billing address</h2>"; 
        echo "<pre>";
        var_dump($bAddress);
        echo "</pre>";
        echo "<h2>Store info</h2>"; 
        echo "<pre>";
        var_dump($store);
        echo "</pre>";
        echo "<h2>Product info</h2>"; 
        echo "<pre>";
        var_dump($product);
        echo "</pre>";        
        /* genero la fattura xml */
        echo "<h1>Oggetto fattura</h1>";
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<p:FatturaElettronica versione="FPA12" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" 
xmlns:p="http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2 http://www.fatturapa.gov.it/export/fatturazione/sdi/fatturapa/v1.2/Schema_del_file_xml_FatturaPA_versione_1.2.xsd">';
        $xml .= '<FatturaElettronicaHeader>';
          $xml .= '<DatiTrasmissione>';
            $xml .= '<IdTrasmittente>';
              $xml .= '<IdPaese>'.$store->merchant_country.'</IdPaese>'; //questo si potrebbe prendere dai dati dello store magento
              $xml .= '<IdCodice>'.$store->merchant_vat_number.'</IdCodice>'; //codice fiscale del trasmittente
            $xml .= '</IdTrasmittente>';
            $xml .= '<ProgressivoInvio>'.$invoice->entity_id.'</ProgressivoInvio>';
            $xml .= '<FormatoTrasmissione>FPA12</FormatoTrasmissione>'; //versione del tracciato con cui è stato predisposto il documento fattura
            $xml .= '<CodiceDestinatario>AAAAAA</CodiceDestinatario>'; //deve corrispondere al campo Codice Ufficio riportato nella rubrica Indice PA
          $xml .= '</DatiTrasmissione>';   
          $xml .= '<CedentePrestatore>';
            $xml .= '<DatiAnagrafici>';
              $xml .= '<IdFiscaleIVA>';
              $xml .= '<IdPaese>'.$store->merchant_country.'</IdPaese>';
              $xml .= '<IdCodice>'.$store->merchant_vat_number . '</IdCodice>'; //codice fiscale prestatore
              $xml .= '</IdFiscaleIVA>';
              $xml .= '<Anagrafica>';
              $xml .= '<Denominazione>'.$store->name.'</Denominazione>';
              $xml .= '</Anagrafica>';
              $xml .= '<RegimeFiscale>RF01</RegimeFiscale>'; // ??
              $xml .= '</DatiAnagrafici>';
              $xml .= '<Sede>';
              $xml .= '<Indirizzo>'.$store->address.'</Indirizzo>';
              $xml .= '<CAP></CAP>';
              $xml .= '<Comune></Comune>';
              $xml .= '<Provincia></Provincia>';
              $xml .= '<Nazione>'.$store->merchant_country.'</Nazione>';
            $xml .= '</Sede>';
          $xml .= '</CedentePrestatore>';
        $xml .= '</FatturaElettronicaHeader>';
        $xml .= '<FatturaElettronicaBody>';
          $xml .= '<DatiGenerali>';
            $xml .= '<DatiGeneraliDocumento>';
              $xml .= '<TipoDocumento>TD01</TipoDocumento>'; // fattura, acconto, anticipo su fattura, nota di credito, parcella
              $xml .= '<Divisa>'.$invoice->store_currency_code.'</Divisa>'; // questo va preso da magento
              $xml .= '<Data>'.$order->updated_at.'</Data>';
              $xml .= '<Numero>'.$invoice->entity_id.'</Numero>';
              $xml .= '<Causale></Causale>'; // ??
              $xml .= '<Causale></Causale>'; // ??
            $xml .= '</DatiGeneraliDocumento>';
            $xml .= '<DatiOrdineAcquisto>';
              $xml .= '<RiferimentoNumeroLinea>1</RiferimentoNumeroLinea>';
              $xml .= '<IdDocumento>66685</IdDocumento>';
              $xml .= '<NumItem>'.$order->total_qty_ordered.'</NumItem>';
              $xml .= '<CodiceCUP>123abc</CodiceCUP>'; //Il CUP  è un codice che identifica un progetto di investimento pubblico 
            $xml .= '<CodiceCIG>456def</CodiceCIG>';
            $xml .= '</DatiOrdineAcquisto>';
          $xml .= '</DatiGenerali>';
        $xml .= '</FatturaElettronicaBody>';
        $xml .= '</p:FatturaElettronica>';
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