<div class="space-y-4">

    <div class="grid grid-cols-2 gap-4 mb-4">

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">First name</label>
            <div class="form-control">
                <p class="input-control"><?=$data['user']['fname'];?></p>
            </div>
        </div>

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Last name</label>
            <div class="form-control">
                <p class="input-control"><?=$data['user']['lname'];?></p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Role</label>
            <div class="form-control">
                <p class="input-control"><?=$data['user']['role'];?></p>
            </div>
        </div>

        <div class="field">
            <label for="roleId" class="block text-sm font-semibold pb-2">Phone number</label>
            <div class="form-control">
                <p class="input-control"><?=$data['user']['phone'];?></p>
            </div>
        </div>

    </div>

    <div class="field flex flex-col space-y-2.5">
        <label for="roleId" class="block text-sm font-semibold">Email</label>
        <div class="form-control">
            <p class="input-control"><?=$data['user']['email'];?></p>
        </div>
    </div>

</div>