<form method="post" action="{{ $route }}" accept-charset="UTF-8" class=" flex items-center justify-center mt-8">
    @csrf
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <div class="flex justify-items-center justify-center content-center mt-6">
            <img src="https://hhcdn.ru/employer-logo/3481998.jpeg" width="40%">
        </div>
        <br>
        <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">{{__('Form add')}}</h1>
        <br>
            {{$attributes}}
        <div class="flex justify-items-center justify-center content-center mt-6">
            <button id="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline"
                type="submit">
                <i class="text-center"></i> {{__('Add')}}
            </button>
        </div>
    </div>
</form>


