<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST">
                        @method('PUT')
                        @csrf
                        <div>
                            <div>
                                <div>
                                    <x-label for="name" :value="__('Nama')"></x-label>
                                    <x-input id="name" class=" block mt-1 w-full" type="text" name="nama" value="{{ auth()->user()->name }}"></x-input>
                                </div>
                                <div>
                                    <x-label for="telp" :value="__('Nomor Telepon')"></x-label>
                                    <x-input id="telp" class=" block mt-1 w-full" type="text" name="telp" value="{{ auth()->user()->telp }}"></x-input>
                                </div>
                                <div>
                                    <x-label for="password" :value="__('Password')"></x-label>
                                    <x-input id="password" class=" block mt-1 w-full" 
                                                    type="password" 
                                                    name="password"
                                                    required autocomplete="new-password"></x-input>
                                </div>
                                <div>
                                    <x-label for="name" :value="__('Konfirmasi Password')"></x-label>
                                    <x-input id="name" class=" block mt-1 w-full"
                                                    type="password" 
                                                    name="password_confirmation" required></x-input>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                           <x-button class="ml-3">
                            {{__('Update')}}
                           </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
