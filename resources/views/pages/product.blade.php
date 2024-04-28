@extends('layouts.layout')
@section('content')
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Products</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                @if (session('success'))
                    <div class="flex justify-center">
                        <div id="toast-success"
                            class="flex items-center w-1/3 p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                            role="alert">
                            <div
                                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="sr-only">Check icon</span>
                            </div>
                            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Error</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All Products
                </h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="relative w-48 mt-1 sm:w-64 xl:w-96 mr-2">
                        <input type="hidden" name="category_id" value="{{request()->category_id}}">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Product" value="{{request() -> search }}" />
                            <button type="submit" class="text-white absolute end-2.5 bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                    <div class ="w-48 mt-1 sm:w-64 ">
                        <select name="category_id" id="search_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 tom-select">
                            <option value="all" selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if(auth()->user()->jabatan === 1 || auth()->user()->jabatan === 2)
                <button id="createProductButton"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                    type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal">
                    Add new product
                </button>
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="w-full text-center divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Product Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Category
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Description
                                </th>
                                @if(auth()->user()->jabatan === 1 || auth()->user()->jabatan === 2)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->product_name }}
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->description }}
                                    </td>

                                    @if(auth()->user()->jabatan === 1 || auth()->user()->jabatan === 2)
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button type="button" id="updateProductButton.{{ $product->id }}"
                                            data-modal-target="edit-product-modal.{{ $product->id }}"
                                            data-modal-toggle="edit-product-modal.{{ $product->id }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Update
                                        </button>
                                        <!-- Edit Product Drawer -->
                                        <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full text-start"
                                            id="edit-product-modal.{{ $product->id }}">
                                            <div
                                                class="relative w-full h-full max-w-4xl px-4 md:h-[calc(100%-1rem)] max-h-[70vh] overflow-y-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                                                        <h3 class="text-xl font-semibold dark:text-white">
                                                            Update product
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                                                            data-modal-toggle="edit-product-modal.{{ $product->id }}">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <form action="{{ route('product.update', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="p-6 space-y-6">

                                                            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                                                                id="product-tab{{ $product->id }}">
                                                                <li class="me-2" role="presentation">
                                                                    <button
                                                                        class="inline-block rounded-lg border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                                                        id="detail-tab{{ $product->id }}" type="button"
                                                                        role="tab" aria-controls="detail"
                                                                        aria-selected="false">Detail</button>
                                                                </li>
                                                                <li class="me-2" role="presentation">
                                                                    <button
                                                                        class= "inline-block rounded-lg border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                                                        id="ingredient-tab{{ $product->id }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="ingredient"
                                                                        aria-selected="false">Ingredient</button>
                                                                </li>

                                                            </ul>

                                                            <div id="product-tab-content{{ $product->id }}">
                                                                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                                                    id="detail{{ $product->id }}" role="tabpanel"
                                                                    aria-labelledby="detail-tab">
                                                                    <div class="grid grid-cols-6 gap-3">
                                                                        <div class="col-span-6">
                                                                            <label for="product_name"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                                                                Name</label>
                                                                            <input type="text" name="product_name"
                                                                                id="product_name"
                                                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                                value="{{ $product->product_name }}"
                                                                                required>
                                                                        </div>

                                                                        <div class ="col-span-6">
                                                                            <label for="category-create"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                                            <select id="category-create"
                                                                                name="category_id"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 tom-select">
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-span-6">
                                                                            <label for="desription"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                                            <textarea id="description" rows="4" name="description"
                                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                                placeholder="👨‍💻Full-stack web developer. Open-source contributor."> {{ $product->description }} </textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                                                    id="ingredient{{ $product->id }}" role="tabpanel"
                                                                    aria-labelledby="ingredient-tab">
                                                                    @foreach ($ingredientsCategory as $category)
                                                                        <div
                                                                            class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                                                            <h5
                                                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                                                {{ $category }}
                                                                            </h5>
                                                                            <ul class="grid w-full gap-3 md:grid-cols-4">
                                                                                @foreach ($ingredients->where('category', $category) as $ingredient)
                                                                                    <li>
                                                                                        <input type="checkbox"
                                                                                            id="cbIngredient{{ $product->id }}{{ $ingredient->id }}"
                                                                                            value="{{ $ingredient->id }}"
                                                                                            class="hidden peer"
                                                                                            name="ingredients[]"
                                                                                            {{$product->ingredients->contains($ingredient -> id) ? 'checked':'' }}
                                                                                            onchange="toggleQtyInput({{ $product->id }},{{ $ingredient->id }})">
                                                                                        <label
                                                                                            for="cbIngredient{{ $product->id }}{{ $ingredient->id }}"
                                                                                            class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                                                            <div class="block">
                                                                                                <div
                                                                                                    class="w-full text-lg font-semibold">
                                                                                                    {{ $ingredient->ingredient_name }}
                                                                                                </div>
                                                                                                <div id="qtyDiv{{ $product->id }}{{ $ingredient->id }}"

                                                                                                    style="{{$product->ingredients->contains($ingredient -> id) ? '':'display:none;' }}">
                                                                                                    <div class="flex">
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            id="qtyingredient{{ $product->id }}{{ $ingredient->id }}"
                                                                                                            name="qty_ingredients[{{ $ingredient->id }}]"
                                                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none rounded-s-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-e-0"
                                                                                                            placeholder='qty'
                                                                                                            value="{{$product->ingredients->contains($ingredient -> id) ? $product->ingredients->where('id', $ingredient->id)->first()->pivot->quantity : '' }}" />
                                                                                                        <span
                                                                                                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 rounded-e-lg dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                                                                            {{ $ingredient->unit }}
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </label>

                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>

                                                                        </div>
                                                                    @endforeach

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                                                            <button
                                                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                                type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="deleteProductButton.{{ $product->id }}"
                                            data-modal-target="delete-product-modal.{{ $product->id }}"
                                            data-modal-toggle="delete-product-modal.{{ $product->id }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Delete
                                        </button>
                                        <!-- Delete Product Drawer -->
                                        <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
                                            id="delete-product-modal.{{ $product->id }}">
                                            <div class="relative w-full h-full max-w-md px-4 md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                    <!-- Modal header -->
                                                    <div class="flex justify-end p-2">
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                                                            data-modal-hide="delete-product-modal.{{ $product->id }}">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 pt-0 text-center">
                                                        <svg class="w-16 h-16 mx-auto text-red-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are
                                                            you
                                                            sure you want to
                                                            delete this product?</h3>
                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                                                                Yes, I'm sure
                                                            </button>
                                                            <a href="#"
                                                                class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                                data-modal-hide="delete-product-modal.{{ $product->id }}">
                                                                No, cancel
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="IngredientProductButton.{{ $product->id }}"
                                            data-modal-target="ingredient-modal.{{ $product->id }}"
                                            data-modal-toggle="ingredient-modal.{{ $product->id }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            ingredient
                                        </button>
                                        <div id="ingredient-modal.{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Ingredients
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="ingredient-modal.{{ $product->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5 space-y-4 text-start">
                                                        <ul
                                                            class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                                            @foreach ($product->ingredients as $productIngredient)
                                                                <li
                                                                    class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                                    <i class="fa-solid fa-minus">
                                                                    </i>
                                                                    {{ $productIngredient->ingredient_name }}
                                                                    {{ $productIngredient->pivot->quantity }}
                                                                    {{ $productIngredient->unit }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div
                                                        class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="ingredient-modal.{{ $product->id }}"
                                                            type="button"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td class="p-4 dark:text-white" colspan="5">Data tidak ditemukan</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $products->links('pagination::flowbite') }}

    <!-- Add User Modal -->
    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="add-product-modal">
        <div class="relative w-full h-full max-w-4xl px-4 md:h-[calc(100%-1rem)] max-h-[70vh] overflow-y-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Add new product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="add-product-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                            id="product-tab">
                            <li class="me-2" role="presentation">
                                <button
                                    class="inline-block rounded-lg border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                    id="detail-tab" type="button" role="tab"
                                    aria-controls="detail" aria-selected="false">Detail</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button
                                    class= "inline-block rounded-lg border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                    id="ingredient-tab" type="button" role="tab"
                                    aria-controls="ingredient" aria-selected="false">Ingredient</button>
                            </li>

                        </ul>

                        <div id="product-tab-content">
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="detail"
                                role="tabpanel" aria-labelledby="detail-tab">
                                <div class="grid grid-cols-6 gap-3">
                                    <div class="col-span-6">
                                        <label for="product_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                            Name</label>
                                        <input type="text" name="product_name" id="product_name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            required>
                                    </div>

                                    <div class ="col-span-6">
                                        <label for="category-create"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category-create" name="category_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 tom-select">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="desription"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <textarea id="description" rows="4" name="description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="👨‍💻Full-stack web developer. Open-source contributor."></textarea>
                                    </div>

                                </div>
                            </div>


                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                id="ingredient" role="tabpanel" aria-labelledby="ingredient-tab">
                                @foreach ($ingredientsCategory as $category)
                                    <div
                                        class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $category }}
                                        </h5>
                                        <ul class="grid w-full gap-3 md:grid-cols-4">
                                            @foreach ($ingredients->where('category', $category) as $ingredient)
                                                <li>
                                                    <input type="checkbox"
                                                        id="cbIngredient0{{$ingredient -> id}}"
                                                        value="{{$ingredient -> id}}" class="hidden peer"
                                                        name="ingredients[]"
                                                        onchange="toggleQtyInput(0,{{$ingredient -> id}})">
                                                    <label for="cbIngredient0{{$ingredient -> id}}"
                                                        class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                        <div class="block">
                                                            <div class="w-full text-lg font-semibold">
                                                                {{ $ingredient->ingredient_name }}
                                                            </div>
                                                            <div id="qtyDiv0{{$ingredient -> id}}"
                                                                style="display:none;">
                                                                <div class="flex">
                                                                    <input type="number"
                                                                        id="qtyingredient0{{$ingredient -> id}}"
                                                                        name="qty_ingredients[{{$ingredient -> id}}]"
                                                                        value="0"
                                                                        min="0"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none rounded-s-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-e-0"
                                                                        placeholder='qty' />
                                                                    <span
                                                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 rounded-e-lg dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                                        {{ $ingredient->unit }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selects = document.querySelectorAll('.tom-select');
            selects.forEach(function(select) {
                new TomSelect(select);
            });

            var select = document.getElementById('search_category');

            select.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var categoryId = selectedOption.value;

                // Mendapatkan URL saat ini
                var currentUrl = window.location.href;

                // Memeriksa apakah sudah ada query string dalam URL
                var queryStringIndex = currentUrl.indexOf('?');
                var separator = queryStringIndex !== -1 ? '&' : '?';

                // Membuat objek untuk menyimpan parameter yang sudah ada
                var params = {};

                // Jika sudah ada query string
                if (queryStringIndex !== -1) {
                    // Memecah query string menjadi pasangan nama parameter dan nilainya
                    var queryString = currentUrl.substr(queryStringIndex + 1);
                    queryString.split('&').forEach(function(pair) {
                        var parts = pair.split('=');
                        params[parts[0]] = parts[1];
                    });
                }

                // Memperbarui nilai category_id atau menambahkannya jika belum ada
                params['category_id'] = categoryId;

                // Membuat query string baru
                var newQueryString = Object.keys(params).map(function(key) {
                    return key + '=' + params[key];
                }).join('&');

                // Membuat URL baru dengan query string yang diperbarui
                var newUrl = currentUrl.split('?')[0] + '?' + newQueryString;

                // Memperbarui URL
                window.location.href = newUrl;
            });

            var tabsElement = document.getElementById('product-tab');

                // create an array of objects with the id, trigger element (eg. button), and the content element
                var tabElements = [{
                        id: 'detail',
                        triggerEl: document.querySelector('#detail-tab'),
                        targetEl: document.querySelector('#detail'),
                    },
                    {
                        id: 'ingredient',
                        triggerEl: document.querySelector('#ingredient-tab'),
                        targetEl: document.querySelector('#ingredient'),
                    },

                ];

                // options with default values
                var options = {
                    defaultTabId: 'detail',
                    activeClasses: 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-t-lg rounded-b-lg active w-full dark:bg-blue-600',
                    inactiveClasses: 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white',
                    onShow: () => {
                        // console.log('tab is shown');
                    },
                };

                // instance options with default values
                var instanceOptions = {
                    id: 'product-tab',
                    override: true
                };


                var tabs = new Tabs(tabsElement, tabElements, options, instanceOptions);

            @foreach ($products as $product)
                var tabsElement = document.getElementById('product-tab{{ $product->id }}');

                // create an array of objects with the id, trigger element (eg. button), and the content element
                var tabElements = [{
                        id: 'detail{{ $product->id }}',
                        triggerEl: document.querySelector('#detail-tab{{ $product->id }}'),
                        targetEl: document.querySelector('#detail{{ $product->id }}'),
                    },
                    {
                        id: 'ingredient{{ $product->id }}',
                        triggerEl: document.querySelector('#ingredient-tab{{ $product->id }}'),
                        targetEl: document.querySelector('#ingredient{{ $product->id }}'),
                    },

                ];

                // options with default values
                var options = {
                    defaultTabId: 'detail{{ $product->id }}',
                    activeClasses: 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-t-lg rounded-b-lg active w-full dark:bg-blue-600',
                    inactiveClasses: 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white',
                    onShow: () => {
                        // console.log('tab is shown');
                    },
                };

                // instance options with default values
                var instanceOptions = {
                    id: 'product-tab{{ $product->id }}',
                    override: true
                };


                var tabs = new Tabs(tabsElement, tabElements, options, instanceOptions);
            @endforeach
        });

        function toggleQtyInput(productId, ingredientId) {
        const qtyDiv = document.getElementById(`qtyDiv${productId}${ingredientId}`);
        const qtyInput = document.getElementById(`qtyingredient${productId}${ingredientId}`);
        const checkbox = document.getElementById(`cbIngredient${productId}${ingredientId}`);
        

        if (!checkbox.checked) {
            qtyDiv.style.display = 'none';
            qtyInput.value = null;
            checkbox.value = []; // Set value of checkbox to empty array
        } else {
            qtyDiv.style.display = 'block';
        }
    }
    </script>
@endsection