# ADONAI

==>
	habilitar mod rewrite
		sudo a2enmod rewrite
	reiniciar apache con cualquier linea
		sudo /etc/init.d/apache2 restart
		sudo service apache2 restart
		sudo systemctl restart apache2

==> contenido de .htaccess
	<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteRule ^(.*)$ index.php/$1 [L]
		ErrorDocument 404 index.php
	</IfModule>

==> para archivos csv habilitar fines de linea
	ir a /etc/php5/apache2/php.ini y borrar el ;
	(punto y coma) de la linea
	auto_detect_line_endings = On

--> en /etc/apache2/apache2.conf cambiar Allwoverride All
	<Directory /var/www/>
		Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
	</Directory>

