dist:
	mkdir -p dist/app/code
	rsync -r magento_module_1x/Efatt/app/code/local dist/app/code
	mkdir -p dist/app/design/adminhtml/default/default/layout
	cp magento_module_1x/Efatt/app/design/adminhtml/default/default/layout/module.xml dist/app/design/adminhtml/default/default/layout/.
	mkdir -p dist/app/design/adminhtml/default/default/template
	rsync -r magento_module_1x/Efatt/app/design/adminhtml/default/default/template/module dist/app/design/adminhtml/default/default/template/.
	mkdir dist/js 
	rsync -r magento_module_1x/Efatt/js/efatt dist/js
	cd dist && tar cf ../efatt.tar * && cd ..
	gzip efatt.tar

clean:
	rm -rf dist
	rm -f efatt.tar
	rm -f efatt.tar.gz
