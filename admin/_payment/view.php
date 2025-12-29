<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 5,
        // 'authorId' => base64_decode($_SESSION[SESSION_KEY]['authorId'])
    ];
    $payments = Proc(Payment($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Payments
            </h1>
        </div>
        <?php require __dir__.'/../inc/user-nav.php'; ?>
    </header>        

    <main>

        <table>
            <thead>
                <tr>
                    <th>Payee</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <!-- <th>Plan</th> -->
                    <th>Status</th>
                    <th>Mode</th>
                    <th>Phone</th>
                    <th>Reference</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($payments as $payment) { ?>
                <tr>
                    <td class="capitalize"><?=$payment['payee']?></td>
                    <td class="capitalize"><?=$payment['fname'].' '.$payment['lname']?></td>
                    <td><?=$payment['amount']?></td>
                    <!-- <td class="capitalize"><?//=$payment['plan']?></td> -->
                    <td class="capitalize td-<?=$payment['status']?>"><?=$payment['status']?></td>
                    <td><?=$payment['mode']?></td>
                    <td><?=$payment['phone']?></td>
                    <td><?=$payment['reference']?></td>
                    <td><?=datetime('H:i d M,y',$payment['created'])?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>