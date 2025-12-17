<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

<div class="w-full">

    <div class="flex flex-row justify-between mb-2">

        <div class="flex flex-row items-center">
            <h1>Individual Profile</h1>
        </div>

        <div class="flex gap-2">

            <button class="btn btn-create group" data-modal-href="/template?view=modal&action=create" data-title="template">
                <div class="flex flex-row items-center gap-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </span>
                    <span>Edit</span>
                </div>
            </button>

        </div>

    </div>

</div>

<div class="w-full gap-2 flex flex-row">

    <div class="p-4 bg-white w-1/4">
        <img src="/public/img/profile-picture.jpg" class="w-full">
    </div>

    <div class="p-4 bg-white w-3/4"></div>

</div>


<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>