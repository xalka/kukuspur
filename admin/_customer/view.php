<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 5
    ];
    $customers = Proc(Customer($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Customers
            </h1>
        </div>
        <?php require __dir__.'/../inc/user-nav.php'; ?>
    </header>        

    <main>

        <table>
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($customers as $customer) { ?>
                <tr>
                    <td class="capitalize"><?=$customer['fname']?></td>
                    <td class="capitalize"><?=$customer['lname']?></td>
                    <td><?=$customer['phone']?></td>
                    <td><?=$customer['email']?></td>
                    <td><?=$customer['verified'] ? 'Yes' : 'No'?></td>
                    <td><?=datetime('H:i d M,y',$customer['created'])?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>