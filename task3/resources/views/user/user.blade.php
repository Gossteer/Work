<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <x-form-add-tailwind >
            <x-slot name="route">
                {{route('user.store')}}
            </x-slot>
            <x-slot name="attributes">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        {{__('Name')}}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name"
                        value="{{ old('name') }}"
                        type="text" placeholder="{{__('Name')}}"  required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        {{__('Email')}}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email"
                        value="{{ old('email') }}"
                        type="email" placeholder="{{__('Email')}}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        {{__('Password')}}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="password"  autocomplete="new-password"
                        type="password" placeholder="{{__('Password')}}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        {{__('Confirm Password')}}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="password_confirmation" autocomplete="new-password"
                        type="password" placeholder="{{__('Confirm Password')}}" required>
                </div>
            </x-slot>
        </x-form-add-tailwind>

        <x-table-tailwind>
            <x-slot name="thead">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__('Name')}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__('Number of orders')}}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($users as $user)
                <tr id="user{{$user->id}}">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900 ">
                            <input type="text" id="nametr{{$user->id}}" class="border border-gray-300 p-1 my-1 rounded-md focus:outline-none focus:ring-2 ring-blue-200" value="{{$user->name}}">
                          </div>
                          <div class="text-sm text-gray-500">
                            <input type="email" id="emailtr{{$user->id}}" class="border border-gray-300 p-1 my-1 rounded-md focus:outline-none focus:ring-2 ring-blue-200"  value="{{$user->email}}">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{$user->orders->count()}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-4 text-center text-sm font-medium">
                      <a onclick="deleteUser({{$user->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{__('Delete')}}</a>
                      <a onclick="update({{$user->id}})" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{__('Save')}}</a>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-tailwind>
    </x-slot>
</x-app-layout>




<script  type="application/javascript">
    function deleteUser($selector) {
        $.ajax({
            url: '{{ url('user') }}/' + $selector,
            type: "DELETE",
            headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
            },
            success: function (data) {
                document.querySelector("#user"+$selector).remove();
            },

            error: function (msg) {
                alert('Ошибка');
            }

        });
    }

    function update($selector) {
        $.ajax({
            url: '{{ url('user') }}/' + $selector,
            type: "PUT",
            data: {id:$selector, name:document.getElementById('nametr'+$selector).value, email:document.getElementById('emailtr'+$selector).value},
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



