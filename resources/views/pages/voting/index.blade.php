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
            max-width: 350px;
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
            width: 140px !important;
            height: 140px !important;
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
        <h1>Voting</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Voting</a></div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h4>Voting - {{$userData->batch->name}}</h4>
        </div>
        <div class="card-body">
            @if($status == 'valid')
            <div class="alert alert-primary alert-has-icon">
                @else
                <div class="alert alert-warning alert-has-icon">
                    @endif
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">E-Voting</div>
                        {{$message}}
                    </div>
                </div>
            </div>

            <div class="container">
                @foreach ($data as $item) <div class="box">
                    <div class="top-bar"></div>
                    <div class="top">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <input type="checkbox" class="heart-btn" id="heart-btn-1">
                        <label class="heart" for="heart-btn-1"></label>
                    </div>
                    <div class="content">
                        <img src="{{route('candidate.getimage',base64_encode($item->id))}}" alt="{{$item->name}}">
                        <strong>{{$item->name}}</strong>
                        <p>{{$item->tagline}}</p>
                        <i class="text-left">Visi</i>
                        <p>{{$item->visi}}</p>
                    </div>
                    <div class="btn">
                        @if($status == 'valid')
                        <a href="#"><i class="fa fa-clipboard" aria-hidden="true"></i>Vote</a>
                        <a href="#" class="detail-link" data-toggle="modal" data-target="#detailModal" data-index="{{$item->id}}">
                            <i class="fa fa-eye" aria-hidden="true"></i>Detail
                        </a>
                        @else
                        <center>
                            <a href="#" class="detail-link" data-toggle="modal" data-target="#detailModal" data-index="{{$item->id}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>Detail
                            </a>
                        </center>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function() {
            $('.detail-link').click(function() {
                var index = btoa($(this).data('index'));
                var url = "{{ url('candidate/get') }}/" + index;

                axios.get(url)
                    .then(function(response) {
                        var candidate = response.data;

                        $('#candidateName').text(candidate.name);
                        $('#tagline').text(candidate.tagline);
                        $('#visi').text(candidate.visi);
                        $('#candidateImage').attr('src', "{{ route('candidate.getimage', '') }}/" + index);
                        $('#misi').empty();
                        candidate.misi.forEach(function(item, i) {
                            var listItem = '<p>' + (i + 1) + '. ' + item.misi + '</p>';
                            $('#misi').append(listItem);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching candidate data:', error);
                    });
            });
        });

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
                <h3 class="text-lg font-medium text-gray-900" id="candidateName"></h3>
                <div class="content">
                    <img src="{{route('candidate.getimage',base64_encode(1))}}" alt="" id="candidateImage" class="w-25">
                </div>
                <p class="mb-3" id="tagline"></p>
                <h4><i>Visi:</i></h4>
                <p class="mb-3" id="visi"></p>
                <h4><i>Misi:</i></h4>
                <p class="mb-3" id="misi"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
