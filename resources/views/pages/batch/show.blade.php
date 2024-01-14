<x-app-layout>
    @push('css')
    <style>

    </style>
    @endpush
    <x-slot name="header_content">
        <h1>Batch</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Batch</a></div>
        </div>
    </x-slot>

    <div class="card card-primary">
        <h2 class="section-title">Master Data Batch</h2>
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('batch.update',base64_encode($data->id)) }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$data->name}}" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <x-jet-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$data->description}}" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="start" value="{{ __('Start') }}" />
                            <x-jet-input id="start" class="block mt-1 w-full" type="datetime-local" name="start" value="{{$data->start}}" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="finish" value="{{ __('Finish') }}" />
                            <x-jet-input id="finish" class="block mt-1 w-full" type="datetime-local" name="finish" value="{{$data->finish}}" required />
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
