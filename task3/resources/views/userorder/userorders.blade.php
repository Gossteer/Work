<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
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
                @foreach ($userorders as $userorder)
                <tr id="userorder{{$userorder->id}}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900 ">
                            {{$userorder->user->name}}
                            </div>
                            <div class="text-sm text-gray-500">
                            {{$userorder->user->email}}
                            </div>
                        </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-4 text-center text-sm font-medium">
                        <a onclick="deleteUserOrder({{$userorder->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{__('Delete')}}</a>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-tailwind>
    </x-slot>
</x-app-layout>


<script  type="application/javascript">

    function deleteUserOrder($selector) {
        $.ajax({
            url: '{{ url('user-order') }}/' + $selector,
            type: "DELETE",
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

</script>
