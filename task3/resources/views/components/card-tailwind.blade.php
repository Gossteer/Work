
    <div class="bg-gray-100 py-10 flex justify-center">
        <div class="bg-white w-80 shadow-lg cursor-pointer rounded transform hover:scale-105 duration-300 ease-in-out">
            <div class="">
                <img src="https://picsum.photos/400/300" alt="" class="rounded-t">
            </div>
            <div class="p-4">
                <h2 class="text-2xl uppercase">{{$name}}</h2>
                <a onclick="addUserOrder({{$order_id}})" class="cursor-pointer block bg-gray-300 py-2 px-2 text-gray-600 text-center rounded shadow-lg uppercase font-light mt-6 hover:bg-gray-400 hover:text-white duration-300 ease-in-out">Add to cart</a>
            </div>
        </div>
    </div>


