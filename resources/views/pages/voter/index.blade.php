<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Voter Data') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">User</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Voter Data</a></div>
        </div>
    </x-slot>

    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <a href="#" class="btn btn-primary mb-5" data-toggle="modal" data-target="#detailModal">
                <i class="fa fa-upload" aria-hidden="true"></i> Upload Excel Voter
            </a>
            <a href="{{route('voter.export')}}" class="btn btn-success mb-5">
                <i class="fa fa-download" aria-hidden="true"></i> Donwload Excel Voter
            </a>
            <div class="overflow-x-auto">
                <table class="min-w-full" id="crudTable">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Access Pass</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi tabel disini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            ajax: {
                url: '{!! url()->current() !!}'
            , }
            , columns: [{
                    data: 'id'
                    , name: 'id'
                    , width: '5%'
                }
                , {
                    data: 'name'
                    , name: 'name'
                    , width: '15%'
                }
                , {
                    data: 'username'
                    , name: 'username'
                }
                , {
                    data: 'access_password'
                    , name: 'access_password'
                }
                , {
                    data: 'batch'
                    , name: 'batch'
                }
                , {
                    data: 'time'
                    , name: 'time'
                }
                , {
                    data: 'status'
                    , name: 'status'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                    , width: '15%'
                }
            , ]
        , });

    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/create-file-list"></script>
    <script>
        function dataFileDnD() {
            return {
                files: []
                , fileDragging: null
                , fileDropping: null
                , humanFileSize(size) {
                    const i = Math.floor(Math.log(size) / Math.log(1024));
                    return (
                        (size / Math.pow(1024, i)).toFixed(2) * 1 +
                        " " + ["B", "kB", "MB", "GB", "TB"][i]
                    );
                }
                , remove(index) {
                    let files = [...this.files];
                    files.splice(index, 1);

                    this.files = createFileList(files);
                }
                , drop(e) {
                    let removed, add;
                    let files = [...this.files];

                    removed = files.splice(this.fileDragging, 1);
                    files.splice(this.fileDropping, 0, ...removed);

                    this.files = createFileList(files);

                    this.fileDropping = null;
                    this.fileDragging = null;
                }
                , dragenter(e) {
                    let targetElem = e.target.closest("[draggable]");

                    this.fileDropping = targetElem.getAttribute("data-index");
                }
                , dragstart(e) {
                    this.fileDragging = e.target
                        .closest("[draggable]")
                        .getAttribute("data-index");
                    e.dataTransfer.effectAllowed = "move";
                }
                , loadFile(file) {
                    const preview = document.querySelectorAll(".preview");
                    const blobUrl = URL.createObjectURL(file);

                    preview.forEach(elem => {
                        elem.onload = () => {
                            URL.revokeObjectURL(elem.src); // free memory
                        };
                    });

                    return blobUrl;
                }
                , addFiles(e) {
                    const files = createFileList([...this.files], [...e.target.files]);
                    this.files = files;
                    this.form.formData.files = [...files];
                }
            };
        }

    </script>

    @endpush

</x-app-layout>
<!-- Modal Stisla -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Candidate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('voter.import')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white p-7 rounded w-9/12 mx-auto mt-4">
                        <x-jet-label for="excelFile" value="{{ __('Excel File') }}" />
                        <div x-data="dataFileDnD()" class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                            <div x-ref="dnd" class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                <input accept=".xlsx, .xls" type="file" name="excelFile" class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer" @change="addFiles($event)" @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');" @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');" @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');" title="" />

                                <div class="flex flex-col items-center justify-center py-10 text-center">
                                    <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="m-0">Drag your Excel file here or click in this area.</p>
                                </div>
                            </div>

                            <template x-if="files.length > 0">
                                <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)" @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                    <template x-for="(_, index) in Array.from({ length: files.length })">
                                        <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none" style="padding-top: 100%;" @dragstart="dragstart($event)" @dragend="fileDragging = null" :class="{'border-blue-600': fileDragging == index}" draggable="true" :data-index="index">
                                            <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button" @click="remove(index)">
                                                <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <template x-if="files[index].type.includes('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')">
                                                <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 4v16H4V4h16zM12 2v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </template>
                                            <div class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                <span class="w-full font-bold text-gray-900 truncate" x-text="files[index].name">Loading</span>
                                                <span class="text-xs text-gray-900" x-text="humanFileSize(files[index].size)">...</span>
                                            </div>
                                            <div class="absolute inset-0 z-40 transition-colors duration-300" @dragenter="dragenter($event)" @dragleave="fileDropping = null" :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" data-dismiss="modal">Close</button>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
