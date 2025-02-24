# Govern-soft-projekt
Az alkalmazás PHP és MariaDB segítségével készült.
az adatbázis beállításához írok egy kis segítséget, hogy csak be kelljen másolnotok :)
CREATE DATABASE bejegyzesek_db; USE bejegyzesek_db; CREATE TABLE bejegyzesek (id INT AUTO_INCREMENT PRIMARY KEY, nev VARCHAR (30) NOT FULL, cim VARCHAR(200) NOT FULL, tartalom TEXT NOT NULL, datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
PHP indítása:
php -S localhost:8000
Böngésző indítása:
http://localhost:8000/index.php
