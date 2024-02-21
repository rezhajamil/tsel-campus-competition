<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    
    <div class=" lg:w-96 sm:w-64 mx-10 my-40 px-6 py-4 bg-white border-2 border-red-500 shadow-lg overflow-hidden rounded-lg sm:rounded-lg">
        <div class="flex justify-center my-2">
            {{ $logo }}
        </div>
        {{ $slot }}
    </div>
</div>
