<div id="modal" class="fixed hidden inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 px-4">
    <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-6xl p-6 overflow-y-auto max-h-[90vh]">

    <!-- Close Icon -->
    <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-xl font-bold focus:outline-none">
      &times;
    </button>

    <!-- Header -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Article</h2>

    <!-- Form -->
    <form action="#" method="POST" enctype="multipart/form-data">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Column -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="title" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 mb-4" required>

          <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
          <input type="text" name="subtitle" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 mb-4">

          <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
          <textarea name="content" rows="10" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 resize-none" required></textarea>
        </div>

        <!-- Right Column -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
          <select name="category" class="w-full border border-gray-300 rounded px-4 py-2 mb-4 focus:ring-2 focus:ring-blue-500">
            <option value="">Select Category</option>
            <option>News</option>
            <option>Tech</option>
            <option>Lifestyle</option>
          </select>

          <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
          <input type="text" name="tags" placeholder="e.g. tech, innovation" class="w-full border border-gray-300 rounded px-4 py-2 mb-4 focus:ring-2 focus:ring-blue-500">

          <label class="block text-sm font-medium text-gray-700 mb-1">Publish Date & Time</label>
          <input type="datetime-local" name="publish_at" class="w-full border border-gray-300 rounded px-4 py-2 mb-4 focus:ring-2 focus:ring-blue-500">

          <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
          <input type="file" name="image" class="w-full mb-4 text-sm file:py-2 file:px-4 file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:font-semibold">
        </div>
      </div>

      <!-- Actions -->
      <div class="flex justify-end mt-6 space-x-4">
        <button type="button" class="bg-gray-100 text-gray-800 px-5 py-2 rounded hover:bg-gray-200">
          Save as Draft
        </button>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          Save & Publish
        </button>
      </div>
    </form>
  </div>
</div>






<script>
    document.getElementById('closeModal').addEventListener('click', function () {
        document.getElementById('articleModal').classList.add('hidden');
    });
</script>