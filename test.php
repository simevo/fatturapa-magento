
<textarea id="debug">{
   "valid":false,
   "errors":[
      {
         "property":"FatturaElettronica.versione",
         "message":"does not match the regex pattern ^FP(A|R)12$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaHeader.DatiTrasmissione.ProgressivoInvio",
         "message":"must be at least 1 characters long"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaHeader.DatiTrasmissione.FormatoTrasmissione",
         "message":"does not match the regex pattern ^FP(A|R)12$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaHeader.DatiTrasmissione.CodiceDestinatario",
         "message":"does not match the regex pattern ^[A-Z0-9]{6,7}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiGenerali.DatiGeneraliDocumento.TipoDocumento",
         "message":"does not match the regex pattern ^TD[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiGenerali.DatiGeneraliDocumento.Numero",
         "message":"must be at least 1 characters long"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DettaglioLinee[0].AliquotaIVA",
         "message":"does not match the regex pattern ^[0-9]{1,2}\\.[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DettaglioLinee[1].AliquotaIVA",
         "message":"does not match the regex pattern ^[0-9]{1,2}\\.[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DettaglioLinee[2].AliquotaIVA",
         "message":"does not match the regex pattern ^[0-9]{1,2}\\.[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DatiRiepilogo[0].AliquotaIVA",
         "message":"does not match the regex pattern ^[0-9]{1,2}\\.[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DatiRiepilogo[0].ImponibileImporto",
         "message":"does not match the regex pattern ^-?[0-9]{1,11}\\.[0-9]{2}$"
      },
      {
         "property":"FatturaElettronica.FatturaElettronicaBody[0].DatiBeniServizi.DatiRiepilogo[0].Imposta",
         "message":"does not match the regex pattern ^-?[0-9]{1,11}\\.[0-9]{2}$"
      }
   ]
}</textarea>

<input type="string" id="FatturaElettronica-FatturaElettronicaBody-0-DatiBeniServizi-DatiRiepilogo-0-Imposta">
<div id="FatturaElettronica-FatturaElettronicaBody-0-DatiBeniServizi-DatiRiepilogo-0-Imposta-error"></div>

<input type="string" id="FatturaElettronica-FatturaElettronicaBody-0-DatiBeniServizi-DatiRiepilogo-0-ImponibileImporto">
<div id="FatturaElettronica-FatturaElettronicaBody-0-DatiBeniServizi-DatiRiepilogo-0-ImponibileImporto-error"></div>

<script type="text/javascript">
	var json = document.getElementById("debug").innerHTML;

	var obj 	= JSON.parse(json);
	var errors 	= obj.errors;

	for (i = 0; i < arr.length; i++) { 
  		console.log(arr[i])
	}

	console.log(obj.errors.length);
	/*
	var c = 0;
	var obj = JSON.parse(json, function (key, value) {
    
    	
		if(key == 'property') {
			var elId = value;
			elId = elId.replace(/\]./g, "-");
			elId = elId.replace(/\[/g, "-");
			elId = elId.replace(/\./g, "-");

			if(document.getElementById(elId)) {
				document.getElementById(elId).style.border = "1px solid red";
				var err = 1;
			}

		}
		
		c++;

    });
    */
</script>

