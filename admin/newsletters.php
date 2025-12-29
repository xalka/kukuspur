<?php

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';
require __dir__.'/core/mysql.php';
require __dir__.'/core/procs.php';

if(!Authenticated()) redirect('/auth');

$_GET['action'] = $_GET['action'] ?? 'view';

require __dir__.'/_newletter/'.$_GET['action'].'.php';