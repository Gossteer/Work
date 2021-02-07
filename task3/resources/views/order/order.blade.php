<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        @if(Auth::user()->admin)
        <x-form-add-tailwind >
            <x-slot name="route">
                {{route('order.store')}}
            </x-slot>
            <x-slot name="attributes">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        {{__('Name')}}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name"
                        required
                        type="text" placeholder="{{__('Name')}}">
                </div>
            </x-slot>
        </x-form-add-tailwind>

        <x-table-tailwind>
            <x-slot name="thead">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__('Name')}}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($orders as $order)
                <tr id="order{{$order->id}}">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900 ">
                            <input type="text" id="nametr{{$order->id}}" class="border border-gray-300 p-1 my-1 rounded-md focus:outline-none focus:ring-2 ring-blue-200" value="{{$order->name}}">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-4 text-center text-sm font-medium">
                        <a onclick="deleteOrder({{$order->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{__('Delete')}}</a>
                        <a onclick="update({{$order->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{__('Save')}}</a>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-tailwind>
        @endif
        <div class="holder mx-auto w-10/12 grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($orders as $order)
                <x-card-tailwind >
                    <x-slot name="name">
                        {{$order->name}}
                    </x-slot>
                    <x-slot name="order_id">
                        {{$order->id}}
                    </x-slot>
                </x-form-add-tailwind>
            @endforeach
        </div>

    </x-slot>
</x-app-layout>


<script  type="application/javascript">
    @if(Auth::user()->admin)
    function deleteUserOrder($selector) {
        $.ajax({
            url: '{{ url('user-order') }}/' + $selector,
            type: "DELETE",
            data: {id:$selector},
            headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
            },
            success: function (data) {
                document.querySelector("#userorder"+$selector).remove();
            },

            error: function (msg) {
                alert('Ошибка');
            }

        });
    }

    function deleteOrder($selector) {
        $.ajax({
            url: '{{ url('order') }}/' + $selector,
            type: "DELETE",
            data: {id:$selector},
            headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
            },
            success: function (data) {
                document.querySelector("#order"+$selector).remove();
            },

            error: function (msg) {
                alert('Ошибка');
            }

        });
    }

    function update($selector) {
        $.ajax({
            url: '{{ url('order') }}/' + $selector,
            type: "PUT",
            data: {id:$selector, name:document.getElementById('nametr'+$selector).value},
            headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
            },
            success: function (data) {
            },

            error: function (msg) {
                alert('Ошибка');
            }

        });
    }
    @endif

    function addUserOrder($selector) {
        $.ajax({
            url: '{{ url('user-order') }}',
            type: "POST",
            data: {id:$selector},
            headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
            },
            success: function (data) {

            },

            error: function (msg) {
                alert('Ошибка');
            }

        });
    }
</script>


