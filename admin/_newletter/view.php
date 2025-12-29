<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 7
    ];
    $letters = Proc(Customer($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                News letters
            </h1>
        </div>
        <?php require __dir__.'/../inc/user-nav.php'; ?>
    </header>        

    <main>

        <table>
            <thead>
                <tr>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($letters as $sub) { ?>
                <tr>
                    <td><?=$sub['phone']?></td>
                    <td><?=$sub['email']?></td>
                    <td><?=$sub['active']?'Active':'Inactive'?></td>
                    <td><?=datetime('H:i d M,y',$sub['created'])?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>