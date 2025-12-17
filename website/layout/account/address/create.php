<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[2rem] mb-[1.5rem] tracking-[0.8px] hidden">
                  <!-- <span class="font-bold">Category </span> -->
                  Address / Create
                </h2>

                <form class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg" action="/account?view=address&action=create" method="POST">

                  <h2 class="text-xl md:text-[2rem] mb-[1.5rem] tracking-[0.8px]">Address</h2>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <div>
                      <label>First Name</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="fname" placeholder="First Name" class="input"/>
                      </div>
                    </div>

                    <div>
                      <label>Last Name</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="lname" placeholder="Last Name" class="input"/>
                      </div>
                    </div>

                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <div>
                      <label>Phone</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="phone" placeholder="Phone number" class="input"/>
                      </div>
                    </div>

                    <div>
                      <label>Email</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="email" placeholder="Email" class="input"/>
                      </div>
                    </div>

                  </div>                  
                  

                  <div class="mb-4">
                    <label>Location</label>
                    <div class="flex items-center rounded-lg normal-input shadow">
                      <input type="text" name="locale" placeholder="Name of your location" class="input"/>
                    </div>
                  </div>

                  <div class="mb-6">
                    <label>Goog Map</label>
                    <!-- <div id="map" data-latitude="<?//=$data['addresses']['latitude']?>" data-longitude="<?//=$data['addresses']['longitude']?>" class="border border-light-gray-border col-span-full h-60 rounded-md"></div> -->
                    <div id="map" data-latitude="" data-longitude="" class="border border-light-gray-border col-span-full h-60 rounded-md"></div>
                  </div>                  

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <div>
                      <label>Latitude</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="latitude" placeholder="Latitude" class="input" readonly/>
                      </div>
                    </div>

                    <div>
                      <label>Longitude</label>
                      <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="text" name="longitude" placeholder="Longitude" class="input" readonly/>
                      </div>
                    </div>

                  </div> 
                  
                  <div class="flex items-start space-x-2 mt-4">
                    <input id="defaultAddress" type="checkbox" name="default" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"/>
                    <label for="defaultAddress" class="text-sm text-gray-700 cursor-pointer">
                      Default location
                    </label>
                  </div>

                  <button type="submit" class="primary-button text-center w-full my-6">
                    Submit
                  </button>                  
                  
                </form>
                
            </section>
            
        </div>
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>