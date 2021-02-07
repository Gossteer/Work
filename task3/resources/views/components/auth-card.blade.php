<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $name }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class=" min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex flex-col sm:justify-center  items-center ">
                    {{ $logo }}
                </div>
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
