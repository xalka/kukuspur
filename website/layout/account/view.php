<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>


<div class="w-full">

    <div class="flex flex-row justify-between mb-2">

        <div class="flex flex-row items-center">
            <h1>Templates</h1>
        </div>

        <div class="flex gap-2">

            <div class="flex flex-row items-center">

                <div class="relative">
                    
                    <button class="export-btn btn-export group">
                        <svg class="group-hover:animate-bounce w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3zm-1-4l-1.41-1.41L13 12.17V4h-2v8.17L8.41 9.59L7 11l5 5z"/></svg>
                        Export
                    </button>
                    
                    <div class="export-dropdown opacity-0 scale-y-0">
                        <a href="#">
                            <svg class="excel" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16v16H4V4zm8 8l-2.5-4h-2l2.5 4-2.5 4h2l2.5-4zM16 8h-1.5v8H16V8z"></path>
                            </svg>
                            Excel
                        </a>
                        <a href="#">
                            <svg class="csv" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16v16H4V4zm4 8v4h2v-4H8zm4 0v4h2v-4h-2zm4 0v4h2v-4h-2z"></path>
                            </svg>
                            CSV
                        </a>
                        <a href="#">
                            <svg class="pdf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16v16H4V4zm8 8l-2.5-4h-2l2.5 4-2.5 4h2l2.5-4zM16 8h-1.5v8H16V8z"></path>
                            </svg>
                            PDF
                        </a>
                    </div>
                </div>

            </div>    

            <button class="btn btn-create group" data-modal-href="/template?view=modal&action=create" data-title="template">
                <div class="flex flex-row items-center gap-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 group-hover:animate-spin transition-transform duration-300 ease-in-out">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                    <span>New</span>
                </div>
            </button>

        </div>

    </div>

    <form method="GET" class="p-2 bg-white rounded-lg shadow-md space-y-1">
        
        <div class="flex xs:flex-col sm:flex-col md:flex-row md:justify-end md:gap-3 w-full">

            <div class="flex flex-row gap-3 md:w-4/6 lg:w-1/2">

                <!-- Search Input -->
                <div class="flex xs:flex-col xs:w-3/4 sm:flex-col sm:w-3/4 md:flex-row lg:flex-row md:w-4/6 lg:w-4/6">
                    <input type="text" id="search" name="search" placeholder="Search..." class="input-control">
                </div>

                <!-- Status Dropdown -->
                <div class="flex xs:flex-col xs:w-1/4 sm:flex-col sm:w-1/4 md-flex-row lg-flex-row md:w-2/6 lg:w-2/6">
                    <select id="status" name="status" class="input-control">
                        <option value="">All</option>
                        <option value="active">Sent</option>
                        <option value="inactive">Failed</option>
                    </select>
                </div>

            </div>

            <div class="flex flex-row gap-3 xs:w-full sm:w-full md:w-2/4 lg:w-1/2">

                <!-- Start Date -->
                <div class="flex xs:flex-col xs:w-1/2 sm:flex-col sm:w-1/2 md:flex-row">
                    <input type="text" class="datepicker input-control" name="startdate" placeholder="Select Date">
                </div>

                <!-- End Date -->
                <div class="flex xs:flex-col xs:w-1/2 sm:flex-col sm:w-1/2 md:flex-row">
                    <input type="text" class="datepicker input-control" name="enddate" placeholder="Select Date">
                </div>

            </div>

            <button class="btn-filter group xs:mt-2 sm:mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:rotate-180" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14"/></svg>
                <span class="text-sm">Filter</span>
            </button>


        </div>

    </form>


</div>

<div class="table-div">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Characters</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['templates'] as $template) { ?>
            <tr>
                <td><?=$template['title']?></td>
                <td><?=$template['strlen']?></td>
                <td><?=$template['date']?></td>
                <td><?=$template['time']?></td>
                <td class="table-action">
                    <div class="inline-block relative group">
                        <span>&#x22EE;</span>
                        <div class="action-dropdown group-hover:visible group-hover:opacity-100">
                            <ul class="py-1 text-left">
                                <li class="view" data-modal-href="/template?view=modal&action=view&id=<?=$template['_id']?>" data-title="view template">View</li>
                                <li class="update" data-modal-href="/template?view=modal&action=edit&id=<?=$template['_id']?>" data-title="update template">Update</li>
                                <!-- <li class="suspend">Suspend</li> -->
                                <li class="delete" data-modal-href="/template?view=modal&action=delete&id=<?=$template['_id']?>" data-title="delete template">Delete</li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="pagination">
    <!-- Previous Button -->
    <button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Page Numbers -->
    <!-- div class="flex space-x-2">
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-400 hover:text-white transition duration-200">1</button>
        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md transition duration-300 transform hover:scale-110 ring-2 ring-blue-300">
            2
        </button>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-400 hover:text-white transition duration-200">3</button>
        <span class="px-3 py-2 text-gray-500">...</span>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-400 hover:text-white transition duration-200">10</button>
    </div-->

    <!-- Next Button -->
    <button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>


<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>