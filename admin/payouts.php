<?php

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';
require __dir__.'/core/mysql.php';
require __dir__.'/core/procs.php';

if(!Authenticated()) redirect('/auth');

$_GET['action'] = $_GET['action'] ?? 'view';

require __dir__.'/_payment/'.$_GET['action'].'.php';

//  196.201.213.29/196.201.213.30 for prod and 196.201.213.55 for testbed.