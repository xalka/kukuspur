<?php

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';
require __dir__.'/core/mysql.php';
require __dir__.'/core/procs.php';

if(!Authenticated()) redirect('/auth');

?>


<?php if(!ReqAjax()) require __dir__.'/inc/header.php'; ?>

    <header>

        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Dashboard
            </h1>
        </div>

        <?php require __dir__.'/inc/user-nav.php'; ?>


    </header>        


    <main>

        <div class="form-alert form-alert-info">
            Coming soon - Dashboard with graphs
        </div>

    </main>


<?php if(!ReqAjax()) require __dir__.'/inc/footer.php'; ?>