# Agrosty
[TOC]

## Requisitos del servidor
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension


## Instalacion
1.  Clonar el repositorio
```bash
git clone https://github.com/wdevmaster/test-agrosty.git
```
2.  Luego aceder a la carpeta del proyecto 
```bash
cd pathTo/test-agrosty
```
3.  Ejecutar los siguientes comandos:
```bash
cp .env.example .env
```

### Configuracion
Para configurar el proyecto en un LAMP o otro entornno local solo debes tener [composer](https://getcomposer.org/download/ "composer") installado y ejecutar los siguientes comandos:
```bash
composer install
php artisan key:generate
```

##### Apache
Para ello puede usar el siguiente codigo para un ***.htaccess*** si usas [apache](https://httpd.apache.org/ "apache") en la carpeta raiz ( **/** ) del proyecto:
```bash
<IfModule mod_rewrite.c>
	RewriteEngine on
	RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
##### Nginx
Si usas [nginx](https://www.nginx.com/ "nginx") solo deberas cambiar la configuracion del archivo */etc/nginx/conf.d/default.conf*  por el siguiente codigo:
```bash
server {
    listen 80;
    index index.php index.html;
    root /var/www/public; # <-----
	#Aqui cambias la ruta por donde este el proyecto

    location / {
        try_files $uri /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
```

#### Permisos
Es necesario que le de permisos a la carpeta `storage/` y a la `bootstrap/cache` ejecutando en el siquiente comando en la bash
```bash
sudo chmod 777 -R storage/ bootstrap/cache/
```

#### Base de datos
En el archivo `.env` configura la base de datos en las siguientes lineas:
```bash
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Migraciones y Seeders
Luego de configurar las credenciales de la base de datos es necesario ejecutando en el siquiente lineas
de comando:
```bash
php artisan migrate --seed
```