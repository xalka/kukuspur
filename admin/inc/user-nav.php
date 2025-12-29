<div class="relative group">
    
    <!-- User Button -->
    <button class="flex items-center space-x-2 text-gray-400 hover:text-gray-800 focus:outline-none">
        <span class="font-medium capitalize"><?=$_SESSION[SESSION_KEY]['fname']?></span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown Menu (visible on hover) -->
    <div class="hidden group-hover:block absolute right-0 mt-0 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-modal-href="/profile" data-modal-title="profile">Profile</a>
        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-modal-href="/profile?action=settings" data-modal-title="Settings">Settings</a>
        <form action="/profile?action=logout" method="POST" data-loading="false">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 cursor-pointer">Logout</button>
        </form>
    </div>

</div>