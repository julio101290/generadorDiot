# CodeIgniter 4 Generador DIOT

## Que es CodeIgniter 4 Generador DIOT?

CodeIgniter 4 Generador DIOT es un programa que nos permitira generar el txt de la DIOT y como origen de datos sera un layout en excel que el mismo programa proporciona para que el usuario lo pueda llenar y posteriormente subirlo  [sitio oficial](https://cesarsystems.com.mx/).


## Instalación y actualizaciones

`composer create-project julio101290/generadordiot` y `composer update` cuando existan versiones nuevas del programa, framework o alguno de sus componentes

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copie `env` a `.env` y personalícelo para su aplicación, específicamente la baseURL
y cualquier configuración de la base de datos.

Como base de datos por default el programa utiliza SQLite3 pero igual funciona con MariaDB,SQL Server o PostgressSQL

Para finalizar es necesario correr el comando 
`php spark install`


## Requerimientos del servidor

Se requiere PHP versión 8.0 o superior, con las siguientes extensiones instaladas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [zip](https://www.php.net/manual/en/zip.installation.php)
- [SQLite3](https://www.php.net/manual/en/sqlite3.installation.php)



Además, asegúrese de que las siguientes extensiones estén habilitadas en su PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) si planea usar la biblioteca HTTP\CURLRequest
