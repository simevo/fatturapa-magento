efatt.zip:
	cd Efatt && zip -r9 ../efatt.zip app js

js:
	wget -O www/js/efatt/fatturaPA_1.2_schema.json https://github.com/simevo/fattura-elettronica-json/raw/master/fatturaPA_1.2_schema.json
	wget -O www/js/efatt/fatturaPA_1.2.hbs https://github.com/simevo/fattura-elettronica-json/raw/master/fatturaPA_1.2.hbs
	cp node_modules/vue/dist/vue.js www/js/efatt/.
	cp node_modules/vue/dist/vue.min.js www/js/efatt/.
	cp node_modules/json-schema/lib/validate.js www/js/efatt/.
	cp node_modules/handlebars/dist/handlebars.min.js www/js/efatt/.

clean:
	rm -f efatt.zip
