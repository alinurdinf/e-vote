<x-app-layout>
    @push('css')
    <style>

    </style>
    @endpush
    <x-slot name="header_content">
        <h1>Voter</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Voter</a></div>
        </div>
    </x-slot>

    <div class="card card-primary">
        <h2 class="section-title">Edit Voter</h2>
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('voter.update',base64_encode($data->id)) }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$data->user->name}}" readonly autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="visi" value="{{ __('Visi') }}" />
                            <div class="form-group">
                                <select class="form-control" name="batch">
                                    <option value="{{$data->batch->id}}">{{$data->batch->name}} | Mulai : {{$data->batch->start}} | Selesai: {{$data->batch->finish}}</option>
                                    @foreach (App\Models\Batch::all() as $batch)
                                    <option value="{{$batch->id}}">{{$batch->name}} | Mulai : {{$batch->start}} | Selesai: {{$batch->finish}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')

    @endpush
</x-app-layout>
