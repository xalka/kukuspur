<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Anonymous Voices | Real Stories, Unfiltered Truth</title>
        <meta name="description" content="Explore real, raw, and anonymous stories from people around the world. Share your truth. Read experiences that matter." />
        <meta name="keywords" content="anonymous blog, real stories, personal experiences, true stories, anonymous authors, mental health, life lessons" />
        <meta name="author" content="Anonymous Contributors" />
        <link rel="canonical" href="https://www.babutalk.com/" />
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Anonymous Voices | Real Stories, Unfiltered Truth" />
        <meta property="og:description" content="Read anonymous experiences and heartfelt stories shared by people just like you." />
        <meta property="og:url" content="https://www.babutalk.com/" />
        <meta property="og:image" content="https://www.babutalk.com/images/babutalk.jpeg" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Anonymous Voices | Real Stories, Unfiltered Truth" />
        <meta name="twitter:description" content="Discover anonymous stories and life lessons from people worldwide. Share yours too." />
        <meta name="twitter:image" content="https://www.babutalk.com/images/babutalk.jpeg" />
        <link href="/public/css/style.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 pt-12">

        <header class="bg-white shadow-md fixed top-0 w-full z-50">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex items-center justify-between h-16">

                    <!-- Left: Hamburger + Logo -->
                    <div class="flex items-center space-x-4">
                        <!-- Hamburger Icon -->
                        <button class="mobile-menu-toggle md:hidden focus:outline-none">
                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Logo -->
                        <div class="h-16 relative">
                            <a href="/">
                                <img src="/images/babutalk.jpeg" class="h-full"/>
                            </a>
                        </div>

                    </div>

                    <!-- Center: Desktop Menu -->
                    <nav class="hidden md:flex space-x-8 capitalize">
                        <a href="/">Home</a>
                    <?php foreach ($categories as $category): ?>
                        <a href="/category?id=<?=$category['categoryId']?>&category=<?=$category['title']?>"><?= $category['title']?></a>
                    <?php endforeach; ?>
                        <!-- <a href="/contact">Contact</a> -->
                    </nav>

                    <!-- Right: Auth -->
                    <div class="hidden md:flex items-center space-x-4 cursor-pointer">
                    <?php if(Authenticated()): ?>
                        <form action="/auth?action=logout" method="POST" data-loading="false">
                            <button type="submit" class="p-0 m-0 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-800" fill="none" 
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v8m5.657-5.657a8 8 0 11-11.314 0" />
                            </svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <span data-modal-href="/auth?action=login">Login</span>
                        <span data-modal-href="/subscribe" class="btn btn-create" data-modal-href="/subscribe">Subscribe</span>
                    <?php endif; ?>
                    </div>
                </div>
                
            </div>

        </header>

        <!-- Mobile Menu Slide-In -->
        <div class="mobile-menu fixed top-0 left-0 h-full w-64 bg-white shadow-xlg ease-in-out z-40 transform -translate-x-full transition-transform duration-300 md:hidden">
            <div class="p-10">
                <!-- Close Button -->
                <button class="mobile-menu-close mb-4 text-gray-600 hover:text-red-500">
                    ✕ Close
                </button>
                <nav class="flex flex-col space-y-4 capitalize">
                    <a href="/">Home</a>
                    <?php foreach ($categories as $category): ?>
                        <a href="/category?id=<?=$category['categoryId']?>&category=<?=$category['title']?>"><?= $category['title']?></a>
                    <?php endforeach; ?>                    
                    <!-- <a href="/contact">Contact</a> -->
                    <div class="hidden md:flex items-center space-x-4 cursor-pointer">
                    <?php if(Authenticated()): ?>
                        <form action="/auth?action=logout" method="POST" data-loading="false">
                            <button type="submit" class="p-0 m-0 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-800" fill="none" 
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v8m5.657-5.657a8 8 0 11-11.314 0" />
                            </svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <span data-modal-href="/auth?action=login">Login</span>
                        <span data-modal-href="/subscribe" class="btn btn-create">Subscribe</span>
                    <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">