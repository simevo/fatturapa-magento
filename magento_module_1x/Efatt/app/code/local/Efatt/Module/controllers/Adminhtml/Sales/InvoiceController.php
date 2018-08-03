<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'InvoiceController.php';
class Efatt_Module_Adminhtml_Sales_InvoiceController extends Mage_Adminhtml_Sales_InvoiceController
{   

    protected function _isAllowed()
    {
      //return Mage::getSingleton('admin/session')->isAllowed('module/modulebackend');
      return true;
    }

    public function editinvoiceAction()
    {

        $invoiceId          = $this->getRequest()->getParam('invoice_id');
        $invoice            = Mage::getModel('sales/order_invoice')->load($invoiceId);
        $config             = Mage::getStoreConfig('efatt');
        $order              = Mage::getModel('sales/order')->load($invoice->order_id);
        $orderItems         = $order->getAllItems();
        $bAddress           = $order->getBillingAddress();
        $currencies         = $this->getCurrencies();
         
        Mage::register('efatt-invoice-id', $invoiceId);
        Mage::register('efatt-order', $order);
        Mage::register('efatt-items', $orderItems);
        Mage::register('efatt-config', $config);
        Mage::register('efatt-cessionario-committente', $bAddress);
        Mage::register('efatt-currencies', $currencies);


        $this->loadLayout();
        $this->_title($this->__("Edit invoice"));
        $this->renderLayout();
    }


    public function viewinvoicespageAction() 
    {

        $invoiceId = $this->getRequest()->getParam('invoice_id');

        echo $invoice_id;
        die;

    }


    public function getCurrencies()
    {

      return array(
          "USD" => "United States Dollars",
          "EUR" => "Euro",
          "GBP" => "United Kingdom Pounds",
          "DZD" => "Algeria Dinars",
          "ARP" => "Argentina Pesos",
          "AUD" => "Australia Dollars",
          "ATS" => "Austria Schillings",
          "BSD" => "Bahamas Dollars",
          "BBD" => "Barbados Dollars",
          "BEF" => "Belgium Francs",
          "BMD" => "Bermuda Dollars",
          "BRR" => "Brazil Real",
          "BGL" => "Bulgaria Lev",
          "CAD" => "Canada Dollars",
          "CLP" => "Chile Pesos",
          "CNY" => "China Yuan Renmimbi",
          "CYP" => "Cyprus Pounds",
          "CSK" => "Czech Republic Koruna",
          "DKK" => "Denmark Kroner",
          "NLG" => "Dutch Guilders",
          "XCD" => "Eastern Caribbean Dollars",
          "EGP" => "Egypt Pounds",
          "FJD" => "Fiji Dollars",
          "FIM" => "Finland Markka",
          "FRF" => "France Francs",
          "DEM" => "Germany Deutsche Marks",
          "XAU" => "Gold Ounces",
          "GRD" => "Greece Drachmas",
          "HKD" => "Hong Kong Dollars",
          "HUF" => "Hungary Forint",
          "ISK" => "Iceland Krona",
          "INR" => "India Rupees",
          "IDR" => "Indonesia Rupiah",
          "IEP" => "Ireland Punt",
          "ILS" => "Israel New Shekels",
          "ITL" => "Italy Lira",
          "JMD" => "Jamaica Dollars",
          "JPY" => "Japan Yen",
          "JOD" => "Jordan Dinar",
          "KRW" => "Korea (South) Won",
          "LBP" => "Lebanon Pounds",
          "LUF" => "Luxembourg Francs",
          "MYR" => "Malaysia Ringgit",
          "MXP" => "Mexico Pesos",
          "NLG" => "Netherlands Guilders",
          "NZD" => "New Zealand Dollars",
          "NOK" => "Norway Kroner",
          "PKR" => "Pakistan Rupees",
          "XPD" => "Palladium Ounces",
          "PHP" => "Philippines Pesos",
          "XPT" => "Platinum Ounces",
          "PLZ" => "Poland Zloty",
          "PTE" => "Portugal Escudo",
          "ROL" => "Romania Leu",
          "RUR" => "Russia Rubles",
          "SAR" => "Saudi Arabia Riyal",
          "XAG" => "Silver Ounces",
          "SGD" => "Singapore Dollars",
          "SKK" => "Slovakia Koruna",
          "ZAR" => "South Africa Rand",
          "KRW" => "South Korea Won",
          "ESP" => "Spain Pesetas",
          "XDR" => "Special Drawing Right (IMF)",
          "SDD" => "Sudan Dinar",
          "SEK" => "Sweden Krona",
          "CHF" => "Switzerland Francs",
          "TWD" => "Taiwan Dollars",
          "THB" => "Thailand Baht",
          "TTD" => "Trinidad and Tobago Dollars",
          "TRL" => "Turkey Lira",
          "VEB" => "Venezuela Bolivar",
          "ZMK" => "Zambia Kwacha",
          "XCD" => "Eastern Caribbean Dollars",
          "XDR" => "Special Drawing Right (IMF)",
          "XAG" => "Silver Ounces",
          "XAU" => "Gold Ounces",
          "XPD" => "Palladium Ounces",
          "XPT" => "Platinum Ounces",
        );
    }

}
?>