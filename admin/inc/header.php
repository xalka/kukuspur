<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Kukuspur Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/public/css/quill.snow.css" rel="stylesheet" />
        <link href="/public/css/flatpickr.min.css" rel="stylesheet" /> 
        <link href="/public/css/style.css" rel="stylesheet">        
    </head>
    <body class="bg-gray-100">

    <!-- Topbar for mobile toggle -->
    <div class="md:hidden flex items-center justify-between bg-white p-4 shadow">
        <button id="toggleSidebar" class="text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="">
            <div class="flex items-center mb-6">
                <img src="/images/Kukuspur.jpeg" class="w-full mr-2" alt="Logo">
                <!-- <span class="text-xl font-bold text-blue-600">CMS Logo</span> -->
            </div>
            <ul class="space-y-0">
                <li><a href="/">Dashboard</a></li>
                <li><a href="/products">Products</a></li>
                <li><a href="/payments">Payments</a></li>
                <li><a href="/customers">Customers</a></li>
                <!-- <li><a href="/newsletters">News Letters</a></li> -->
                <!-- <li><a href="/payouts">Payouts</a></li> -->
                <li><a href="/users">Users</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <section class="main-content flex-1 p-6 overflow-auto">
            <!-- <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Posts</h2> -->