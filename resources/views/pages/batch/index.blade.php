<x-app-layout>
    @push('css')

    @endpush
    <x-slot name="header_content">
        <h1>Batch</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Batch</a></div>
        </div>
    </x-slot>

    <div class="card card-primary">
        <h2 class="section-title">Master Data Batch</h2>
        <div class="col-md-2 mt-3">
        </div>

        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full" id="crudTable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama Batch</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Start</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Finish</th>
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
                    data: 'description'
                    , name: 'description'
                }
                , {
                    data: 'start'
                    , name: 'start'
                }
                , {
                    data: 'finish'
                    , name: 'finish'
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

    @endpush
</x-app-layout>
