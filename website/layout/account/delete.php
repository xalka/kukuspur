<form method="POST" action="/template?action=delete&id=<?=$data['template']['_id']?>" class="flex flex-col items-center justify-center">

    <!-- Title -->
    <h1 class="text-6xl font-extrabold text-red-600 mt-4 items-center justify-center">Warning</h1>

    <!-- SVG Illustration -->
    <div class="mt-6 items-center justify-center">
        <svg class="w-60 h-60 text-red-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
            <path fill="currentColor" d="M1 21h22L12 2zm12-3h-2v-2h2zm0-4h-2v-4h2z"/>
        </svg>
    </div>
    <input type="hidden" name="id" value="<?=$data['template']['_id']?>">


    <!-- Message -->
    <p class="text-2xl font-semibold text-yellow-700 mt-2"><?=$data['template']['title']?></p>
    <p class=" mt-2 text-center max-w-md">
        You are about to delete this template, are you sure ?
    </p>
    
    <div class="flex flex-row justify-end my-4 mx-2">
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </div>

</form>
