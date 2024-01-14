<x-app-layout>
    @push('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        a {
            text-decoration: none;
        }


        .h1-text {
            font-size: 1.3rem;
            margin: 40px 0;
            color: #2c2c2c;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .h1-text i {
            background-color: #509bfc;
            color: #fff;
            width: 40px;
            height: 40px;
            box-shadow: 2px 5px 30px rgba(80, 123, 252, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            margin: 0 20px;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }


        .box {
            position: relative;
            min-width: 350px;
            min-height: 320px;
            background-color: #fff;
            box-shadow: 2px 3px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 10px;
            margin-bottom: 30px;
            margin-top: 30px;
            position: relative;
            border-radius: 10px;
        }


        .top-bar {
            width: 50%;
            height: 4px;
            background: #507bfc;
            position: absolute;
            top: 0px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 0px 0px 10px 10px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .fa-check-circle {
            color: #17b667;
        }

        /* creating heart */
        .heart {
            color: rgba(155, 155, 155);
        }

        .heart::before {
            content: '\f004';
            font-family: fontawesome;
            line-height: 30px;
            cursor: pointer;
            z-index: 1;
            transition: all 0.3s;
        }

        .box .heart-btn:checked~.heart::before {
            color: #e41934
        }

        .heart-btn {
            position: absolute;
            top: 25px;
            right: 20px;
            padding: 1rem;
            display: none;
        }


        .content img {
            width: 90px;
            height: 90px;
            border-radius: 100px;
            overflow: hidden;
            object-fit: cover;
            object-position: top;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content strong {
            font-weight: 500;
            color: #141414;
            margin-top: 10px;
        }

        .content p {
            font-size: 0.9rem;
            color: #7a7a7a;
            margin: 4px 0px 10px 0px;
            cursor: pointer;
        }

        .content p:hover {
            text-decoration: underline;
        }

        .btn {
            margin-top: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .btn a i {
            margin-right: 9px;
        }

        .btn a {
            border-radius: 20px;
            color: #8b8b8b;
            padding: 8px 20px;
            font-size: 0.9rem;
        }

        .btn a:hover {
            color: #fff;
            box-shadow: 2px 5px 15px rgba(80, 123, 252, 0.05);
            background-color: #507bfc;
            transition: all ease 0.5s;
        }

    </style>
    @endpush
    <x-slot name="header_content">
        <h1>Candidate</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Candidate</a></div>
        </div>
    </x-slot>

    <div class="card card-primary">
        <h2 class="section-title">Master Data Candidate</h2>
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full" id="crudTable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">No Urut</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tagline</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Visi</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Misi</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Image</th>
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
                    data: 'no_urut'
                    , name: 'no_urut'
                }
                , {
                    data: 'tagline'
                    , name: 'tagline'
                }
                , {
                    data: 'visi'
                    , name: 'visi'
                }
                , {
                    data: 'misi'
                    , name: 'misi'
                }
                , {
                    data: 'image'
                    , name: 'image'
                    , orderable: false
                    , searchable: false
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
