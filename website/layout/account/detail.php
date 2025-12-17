
<div class="tab-content space-y-4">

    <div>
        <label class="block text-sm font-medium text-gray-700">Template title</label>
        <input type="text" name="title" placeholder="Template title" class="input-control" value="<?=$data['template']['title']?>" disabled />
    </div>
    
    <div>
        <label class="block text-sm font-medium text-gray-700">Template</label>
        <!-- <textarea id="address" rows="4" name="message" class="block w-full rounded-lg bg-transparent p-2.5 text-sm text-gray-900 focus:border-none focus:outline-none"></textarea> -->
        <textarea class="input-control" placeholder="Template" name="message" rows="4" disabled><?=$data['template']['message']?></textarea>
    </div>

</div>