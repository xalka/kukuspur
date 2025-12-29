<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 6
    ];
    $users = Proc(User($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Users
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
            <?php  foreach ($users as $user) { ?>
                <tr>
                    <td class="capitalize"><?=$user['fname']?></td>
                    <td class="capitalize"><?=$user['lname']?></td>
                    <td><?=$user['phone']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['active'] ? 'Yes' : 'No'?></td>
                    <td><?=datetime('H:i d M,y',$user['created'])?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>