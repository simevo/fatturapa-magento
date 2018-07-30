<div id="fattura">
	<form id = "efattForm">
	<input type="text" name="FatturaElettronica.versione">
	<input type="text" name="FatturaElettronica.versione.keaa">
	    <button type="button" onclick="toJson();">Genera JSON</button>
    <button type="button" v-on:click="generateXml();">Genera XML</button>
    <button type="button" v-on:click="validateJson();">Valida JSON</button>    

<!-- outside #fattura to avoid JSON circularity -->
<input id="json" name="json" type="text" />
<input id="xml" name="xml" type="text" />
<input id="result" name="result" type="text" />
</form>
</div>

<script type= "text/javascript">
function toJson() {

}

</script>

<script type="text/javascript">
    // configuration for jshint
    /* jshint browser: true, devel: true */
    /* global Vue, Handlebars, jsonSchema */
    
    "use strict";
    
    var app = new Vue({
      el: '#fattura',
      created: function () {
          // TODO ?
      },
      data: <?php echo $json; ?>,
      methods: {
        validateJson: function() {
            var request = new XMLHttpRequest();
            request.open("GET", "<?php echo $fJsonUrl; ?>");
            request.onload = function() {
                if (request.status == 200) {
                    if (request.responseText) {
                        var schema = request.responseText;
                        var json = JSON.stringify(this);
                        var result = jsonSchema.validate(json, schema);
                        document.getElementById("result").value = JSON.stringify(result);
                    }
                }
            };
            request.send();
        },
        generateJson: function() {
            var json = JSON.stringify(this.FatturaElettronica);
            console.log(json);
            document.getElementById("json").value = json;
        },
        generateXml: function() {
            var request = new XMLHttpRequest();
            request.open("GET", "<?php echo $fXmlUrl; ?>");
            request.onload = function() {
                if (request.status == 200) {
                    if (request.responseText) {
                        var source = request.responseText;
                        var template = Handlebars.compile(source);
                        var context = this;
                        var xml = template(context);
                        document.getElementById("xml").value = xml;
                    }
                }
            };
            request.send();
        },
      }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
      console.log("DOM fully loaded and parsed");
    });
    
</script>