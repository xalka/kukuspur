<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 6
    ];
    $subs = Proc(Customer($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Subscriptions
            </h1>
        </div>
        <?php require __dir__.'/../inc/user-nav.php'; ?>
    </header>        

    <main>

        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Plan</th>
                    <th>Price</th>
                    <th>Period start</th>
                    <th>Period end</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($subs as $sub) { ?>
                <tr>
                    <td class="capitalize"><?=$sub['fname'].' '.$sub['lname']?></td>
                    <td class="capitalize"><?=$sub['plan']?></td>
                    <td><?=$sub['price']?></td>
                    <td><?=datetime('H:i d M,y',$sub['periodStart'])?></td>
                    <td><?=datetime('H:i d M,y',$sub['periodEnd'])?></td>
                    <td><?=$sub['status']?></td>
                    <td><?=datetime('H:i d M,y',$sub['created'])?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>