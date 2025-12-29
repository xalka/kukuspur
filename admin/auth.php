<?php

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';
require __dir__.'/core/mysql.php';
require __dir__.'/core/procs.php';

if(Authenticated()) redirect('/');

$_GET['action'] = $_GET['action'] ?? 'login';

require __dir__.'/_auth/'.$_GET['action'].'.php';