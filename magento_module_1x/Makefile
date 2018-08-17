efatt.zip:
	cd Efatt && zip -r9 ../efatt.zip app js

js:
	wget -O Efatt/js/efatt/fatturaPA_1.2_schema.json https://github.com/simevo/fattura-elettronica-json/raw/master/fatturaPA_1.2_schema.json
	wget -O Efatt/js/efatt/fatturaPA_1.2.hbs https://github.com/simevo/fattura-elettronica-json/raw/master/fatturaPA_1.2.hbs
	cp node_modules/vue/dist/vue.js Efatt/js/efatt/.
	cp node_modules/vue/dist/vue.min.js Efatt/js/efatt/.
	cp node_modules/json-schema/lib/validate.js Efatt/js/efatt/.
	cp node_modules/handlebars/dist/handlebars.min.js Efatt/js/efatt/.

clean:
	rm -f efatt.zip
