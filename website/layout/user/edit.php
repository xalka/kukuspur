<form method="POST" action="/user?action=edit&id=<?=$data['user']['_id']?>" class="space-y-4">

    <div class="grid grid-cols-2 gap-4 mb-4">

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">First name</label>
            <div class="form-control">
                <input type="text" name="fname" placeholder="First name" class="input-control" value="<?=$data['user']['fname'];?>" required/>
            </div>
            <div data-error="fname" class="text-red-500 text-xs w-full hidden"></div>
        </div>

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Last name</label>
            <div class="form-control">
                <input type="text" name="lname" placeholder="Last name" class="input-control" value="<?=$data['user']['lname'];?>" required/>
            </div>
            <div data-error="lname" class="text-red-500 text-xs text-left w-full hidden"></div>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Email</label>
            <div class="form-control">
                <input type="email" name="email" placeholder="Email Address" class="input-control" value="<?=$data['user']['email'];?>" required/>
            </div>
            <div data-error="email" class="text-red-500 text-xs text-left w-full hidden"></div>
            <input type="hidden" name="id" value="<?=$data['user']['_id'];?>">
        </div>

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Phone number</label>
            <div class="form-control">
                <input type="text" name="phone" placeholder="Phone number" class="input-control" value="<?=$data['user']['phone'];?>" required/>
            </div>
            <div data-error="phone" class="text-red-500 text-xs text-left w-full hidden"></div>
        </div>

    </div>

    <div class="field flex flex-col space-y-2.5">
        <label for="roleId" class="block text-sm font-semibold">Role</label>
        <div class="form-control">
            <select id="roleId" class="input-control capitalize" name="roleId">
            <?php foreach($data['roles'] as $role): ?>
                <option <?php if($role['_id'] == $data['user']['role']) echo 'selected'; ?> value="<?php echo $role['_id']; ?>"><?=$role['title'];?></option>
            <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="flex justify-end">
        <button class="btn btn-create">
            Update user
        </button>
    </div>

</form>