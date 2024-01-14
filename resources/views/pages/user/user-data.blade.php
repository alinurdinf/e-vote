<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data User') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">User</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">Data User</a></div>
        </div>
    </x-slot>

    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="crudTable">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Access Pass</th>
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
