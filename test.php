
<textarea id="debug">{
   "valid":false,
   "errors":[
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

<input type="string" id="FatturaElettronica-FatturaElettronicaBody-0-DatiBeniServizi-DatiRiepilogo-0-ImponibileImporto">

<script type="text/javascript">
	var json = document.getElementById("debug").innerHTML;
	var obj = JSON.parse(json, function (key, value) {
    
		if(key == 'property') {
			var elId = value;
			elId = elId.replace(/\]./g, "-");
			elId = elId.replace(/\[/g, "-");
			elId = elId.replace(/\./g, "-");

			document.getElementById(elId).style.border = "1px solid red";

			console.log(elId);
		}

    });
</script>

