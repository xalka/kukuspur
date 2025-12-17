<form method="POST" action="/user?action=suspend&id=<?=$_GET['id']?>" class="flex flex-col items-center justify-center">

    <!-- Title -->
    <h1 class="text-6xl font-extrabold text-yellow-600 mt-4 items-center justify-center">Warning</h1>

    <!-- SVG Illustration -->
    <div class="mt-6 items-center justify-center">
        <svg class="w-60 h-60 text-yellow-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
            <path fill="currentColor" d="M1 21h22L12 2zm12-3h-2v-2h2zm0-4h-2v-4h2z"/>
        </svg>
    </div>
    <input type="hidden" name="id" value="<?=$_GET['id']?>">


    <!-- Message -->
    <p class="text-2xl font-semibold text-yellow-700 mt-2"><?=$_GET['names']?></p>
    <p class=" mt-2 text-center max-w-md">
        You are about to suspend this user, are you sure ?
    </p>
    
    <div class="flex flex-row justify-end my-4 mx-2">
        <button type="submit" class="btn btn-success">
            Suspend
        </button>
    </div>

</form>
