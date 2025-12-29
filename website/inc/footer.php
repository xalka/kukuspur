    </main>
    
    <footer class="bg-gray-900 text-white py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Newsletter -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Stay Updated</h3>
                    <p class="text-sm text-gray-400 mb-4">Subscribe to our newsletter and never miss out on top stories and updates.</p>
                    <form method="post" action="/subscribe?action=newsletter">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="text" placeholder="Enter your email or phone number" name="phonemail" class="w-full px-4 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 bg-white" required/>
                            <button type="submit" class="btn btn-submit">Subscribe</button>
                        </div>
                    </form>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                    <p class="text-sm text-gray-400 mb-4">Join our community and stay connected.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i> Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube"></i> YouTube</a>
                    </div>
                </div>

            </div>

            <!-- Navigation links -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-sm text-gray-400 mb-10">

                <div>
                    <h4 class="text-white font-semibold mb-2">About</h4>
                    <ul>
                        <li><a href="#" class="hover:text-white">Our Story</a></li>
                        <li><a href="#" class="hover:text-white">Team</a></li>
                        <li><a href="#" class="hover:text-white">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-2">Explore</h4>
                    <ul>
                        <li><a href="#" class="hover:text-white">Categories</a></li>
                        <li><a href="#" class="hover:text-white">Trending Posts</a></li>
                        <li><a href="#" class="hover:text-white">Archives</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-2">Support</h4>
                    <ul>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">Terms of Use</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-2">Tools</h4>
                    <ul>
                        <li><a href="#" class="hover:text-white">Write for Us</a></li>
                        <li><a href="#" class="hover:text-white">Submit a Tip</a></li>
                        <li><a href="#" class="hover:text-white">RSS Feed</a></li>
                    </ul>
                </div>

            </div>

            <!-- Bottom -->
            <div class="border-t border-gray-700 pt-4 text-center text-gray-500 text-sm">
            © <?=date('Y')?> Babutalk. All rights reserved.
            </div>
            
        </div>

    </footer>

    <?php require_once __dir__.'/modal.php'; ?>

    <script src="/public/js/jquery-3.7.1.min.js"></script>
    <script src="/public/js/script.js"></script>

    </body>
</html>
