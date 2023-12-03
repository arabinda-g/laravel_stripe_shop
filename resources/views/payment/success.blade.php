<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto px-4 py-6">
                <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-5">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            Payment was successful. Thank you!
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
