<?php
// informations de connexion à la base données :
define("DSN",'mysql:dbname=hospitale2n;host=127.0.0.1');
define("USER",'hospitale2n_user');
define("PASSWORD",'0*ULh.MKMJtR3422');


// regex :
define('REGEX_NAME', '^[a-zA-Z éèêë\'\-]{2,32}$');
define('REGEX_EMAIL', '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
define('REGEX_PASSWORD', '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$');
define('REGEX_DATE', '^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$');
define('REGEX_PHONENUMBER', '^(0[1-9]{1}[0-9]{8}|\+?33[1-9][0-9]{8})$');
define('REGEX_HOUR', '^(0[9]|[1][0-7])$');
define('REGEX_MINUT', '^[0,3][0]$');