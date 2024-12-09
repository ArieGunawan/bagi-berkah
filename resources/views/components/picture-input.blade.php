<div class="flex items-center" x-data="picturePreview()">
    <div class="mr-2 bg-gray-200 rounded-md">
        <img id="preview" src="" alt="" class="object-cover w-24 h-24 rounded-md">
    </div>
    <div>
        <x-primary-button @click="document.getElementById('picture').click()" class="relative">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                </svg>
                Upload Picture
            </div>
            <input @change="showPreview(event)" type="file" name="picture" id="picture" class="absolute inset-0 opacity-0 -z-10">
        </x-primary-button>
    </div>
    <script>
        function picturePreview(){
            return {
                showPreview: (event) => {
                    if(event.target.files.length > 0){
                        var src = URL.createObjectURL(event.target.files[0]);
                        document.getElementById('preview').src = src;
                    }
                }
            }
        }
    </script>
</div>
