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
                                    aria-current="page">Sales</span>
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
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Sales
                </h1>
            </div>

            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="flex flex-col sm:flex-row items-center mb-4 sm:mb-0">
                    <form class="relative w-full mt-1 sm:w-64 xl:w-96 mr-2">
                        <input type="hidden" name="category_id" value="{{request()->category_id}}">
                        <input type="hidden" name="date" value="{{request()->date}}">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="default-search"
                                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Product" value="{{ request()->search }}" />
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                    <div class ="w-full mt-1 sm:w-64 ">
                        <select name="category_id" id="search_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 tom-select" placeholder="Select Category">
                            <option value="all" selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative mt-1 max-w-sm">
                        <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="searchDate" datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                            class=" ms-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date" value="{{ request()->date }}">
                    </div>
                    
                </div>
                        <button id="createPenjualanButton"
                        class="ms-4 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center"
                        type="button" data-modal-target="uploadModal" data-modal-toggle="uploadModal">
                        <svg class="w-4 h-4 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                        </svg>
                        Import Excel
                        </button>
                    </button>
                           <button id="createPenjualanButton"
                    class="ms-3  text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                    type="button" data-modal-target="add-penjualan-modal" data-modal-toggle="add-penjualan-modal">
                    Add New Recap Sales
                </button>
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
        <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
            <a href="{{ route('penjualan', ['sort' => 'product_name', 'direction' => $sortColumn == 'product_name' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                Product Name
                @if ($sortColumn == 'product_name')
                    @if ($sortDirection == 'asc')
                        <i class="fas fa-arrow-up"></i>
                    @else
                        <i class="fas fa-arrow-down"></i>
                    @endif
                @endif
            </a>
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
            <a href="{{ route('penjualan', ['sort' => 'category_id', 'direction' => $sortColumn == 'category_id' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                Category
                @if ($sortColumn == 'category_id')
                    @if ($sortDirection == 'asc')
                        <i class="fas fa-arrow-up"></i>
                    @else
                        <i class="fas fa-arrow-down"></i>
                    @endif
                @endif
            </a>
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
            <a href="{{ route('penjualan', ['sort' => 'sold', 'direction' => $sortColumn == 'sold' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                Sold
                @if ($sortColumn == 'sold')
                    @if ($sortDirection == 'asc')
                        <i class="fas fa-arrow-up"></i>
                    @else
                        <i class="fas fa-arrow-down"></i>
                    @endif
                @endif
            </a>
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
            <a href="{{ route('penjualan', ['sort' => 'date', 'direction' => $sortColumn == 'date' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                Date
                @if ($sortColumn == 'date')
                    @if ($sortDirection == 'asc')
                        <i class="fas fa-arrow-up"></i>
                    @else
                        <i class="fas fa-arrow-down"></i>
                    @endif
                @endif
            </a>
        </th>
        @if(auth()->user()->jabatan === 1 || auth()->user()->jabatan === 2)
        <th scope="col" class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
            Actions
        </th>
        @endif
    </tr>
</thead>

                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($penjualans as $penjualan)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $penjualan->product->product_name }}</td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $penjualan->product->category->name }}</td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $penjualan->sold }} Cups</td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $penjualan->date->format('d F Y') }}</td>

                                    @if(auth()->user()->jabatan === 1 || auth()->user()->jabatan === 2)
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button type="button" id="updatePenjualanButton.{{ $penjualan->id }}"
                                            data-modal-target="edit-penjualan-modal.{{ $penjualan->id }}"
                                            data-modal-toggle="edit-penjualan-modal.{{ $penjualan->id }}"
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
                                        <!-- Edit User Modal -->
                                        <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full text-start"
                                            id="edit-penjualan-modal.{{ $penjualan->id }}">
                                            <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                                                        <h3 class="text-xl font-semibold dark:text-white">
                                                            Update Recap Sales
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white "
                                                            data-modal-toggle="edit-penjualan-modal.{{ $penjualan->id }}">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        <form action="{{ route('penjualan.update', $penjualan->id ) }}" method="POST">
                                                            @csrf
                                                            <label for="date-create"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                                            <div class="relative w-full mb-3">
                                                                <div
                                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="currentColor" viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                                    </svg>
                                                                </div>
                                                                <input datepicker datepicker-autohide
                                                                    datepicker-format="yyyy-mm-dd" type="text"
                                                                    name="date"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                    placeholder="Select date">
                                                            </div>

                                                            <div class="grid grid-cols-6 gap-3">
                                                                <div class ="col-span-6">
                                                                    <label for="product-create"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                                                                    <select id="product-create" name="product_id"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}"
                                                                                {{ $product->id == $penjualan->product_id ? 'selected' : '' }}>
                                                                                {{ $product->product_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-span-6 sm:col-span-3">
                                                                    <label for="sold"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sold</label>
                                                                    <input type="number" name="sold" id="sold"
                                                                        value="{{ $penjualan->sold }}"
                                                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="sold" required>
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
                                        <button type="button" id="deleteProductButton{{ $penjualan->id }}"
                                            data-modal-target="delete-product-modal{{ $penjualan->id }}"
                                            data-modal-toggle="delete-product-modal{{ $penjualan->id }}"
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
                                            id="delete-product-modal{{ $penjualan->id }}">
                                            <div class="relative w-full h-full max-w-md px-4 md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                    <!-- Modal header -->
                                                    <div class="flex justify-end p-2">
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                                                            data-modal-hide="delete-product-modal{{ $penjualan->id }}">
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
                                                            delete this sale?</h3>
                                                        <form action="{{ route('penjualan.destroy', $penjualan->id) }}"
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

    {{ $penjualans->links('pagination::flowbite') }}

    <!-- Add User Modal -->
    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="add-penjualan-modal">
        <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Add New Recap Sales
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="add-penjualan-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form action="{{ route('penjualan.store') }}" method="POST">
                        @csrf
                        <label for="date-create"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <div class="relative w-full mb-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                                name="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date">
                        </div>

                        <div class="grid grid-cols-6 gap-3">

                            <div class ="col-span-6">
                                <label for="product-create"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                                <select id="product-create" name="product_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="sold"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sold</label>
                                <input type="number" name="sold" id="sold"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="sold" required>
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

    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="uploadModal">
        <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Import Excel
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="uploadModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="p-6 space-y-6">
                
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">XLSX , XLS (MAX. 20MB).</p>

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



            var dateInput = document.querySelector('#searchDate');

            dateInput.addEventListener('changeDate', function() {
                var selectedDate = this.value;

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

                // Memperbarui nilai date atau menambahkannya jika belum ada
                params['date'] = selectedDate;

                // Membuat query string baru
                var newQueryString = Object.keys(params).map(function(key) {
                    return key + '=' + params[key];
                }).join('&');

                // Membuat URL baru dengan query string yang diperbarui
                var newUrl = currentUrl.split('?')[0] + '?' + newQueryString;

                // Memperbarui URL
                window.location.href = newUrl;
            });


            var selects = document.querySelectorAll('.tom-select');
            selects.forEach(function(select) {
                new TomSelect(select);
            });
        });
    </script>

    <!-- Modal for uploading Excel file -->
<!-- <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Excel File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="excelFile" class="form-label">Choose Excel File:</label>
                        <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xls,.xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

@endsection
