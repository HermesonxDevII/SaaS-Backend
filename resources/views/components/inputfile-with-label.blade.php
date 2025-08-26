<div
    x-data="{
        files: [],
        addFiles(event) {
            let newFiles = [...event.target.files];

            let combined = [...this.files, ...newFiles];

            const uniqueFiles = Array.from(new Map(combined.map(file => [file.name, file])).values());

            this.files = uniqueFiles;

            const dataTransfer = new DataTransfer();
            this.files.forEach(file => dataTransfer.items.add(file));
            this.$refs.fileInput.files = dataTransfer.files;
        },
        removeFile(fileName) {
            this.files = this.files.filter(f => f.name !== fileName);

            const dataTransfer = new DataTransfer();
            this.files.forEach(file => dataTransfer.items.add(file));
            this.$refs.fileInput.files = dataTransfer.files;
        }
    }"
>
    <div class="flex items-center justify-center w-full">
        <label
            for="dropzone-file"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50"
        >
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg
                    class="w-8 h-8 mb-4 text-gray-500"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 16"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                    />
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                    <span class="font-semibold">Clique ou Arraste</span> um ou mais arquivos
                </p>
                <p class="text-xs text-gray-500">
                    SVG, PNG, JPG or GIF (MAX. 800x400px)
                </p>
            </div>

            <input
                id="dropzone-file"
                type="file"
                name="attachments[]"
                multiple
                class="hidden"
                x-ref="fileInput"
                @change="addFiles(event)"
            />
        </label>
    </div>

    <div class="mt-4" x-show="files.length > 0">
        <h3 class="text-sm font-medium text-gray-700">Arquivos Selecionados:</h3>
        <ul class="mt-2 border border-gray-200 rounded-md divide-y divide-gray-200">
            <template x-for="file in files" :key="file.name">
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                    <div class="w-0 flex-1 flex items-center">
                        <svg
                            class="flex-shrink-0 h-5 w-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a3 3 0 00-3 3v4a3 3 0 003 3h4a3 3 0 003-3V7a3 3 0 00-3-3H8zm-1 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="ml-2 flex-1 w-0 truncate" x-text="file.name"></span>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <button
                            type="button"
                            @click="removeFile(file.name)"
                            class="font-medium text-red-600 hover:text-red-500"
                        >
                          X
                        </button>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>