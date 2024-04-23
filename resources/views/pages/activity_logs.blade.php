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
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Activity Log History</span>
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
                @php
                    // Get the selected table name from the request
                    $selectedTableName = request()->table_name;
                @endphp
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ ucfirst($selectedTableName) }} Logs
                </h1>
                <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                    <div class="flex flex-col sm:flex-row items-center mb-5 sm:mb-0">
                        <div class ="w-full mt-1 sm:w-64 ">
                            <select name="table_name" id="search_table_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select a Table</option> 
                                        <option value="Product Categories" {{ request()->table_name == "Product Categories" ? 'selected' : '' }}>Product Categories</option>
                                        <option value="Products" {{ request()->table_name == "Products" ? 'selected' : '' }}>Products</option>
                                        <option value="Ingredients" {{ request()->table_name == "Ingredients" ? 'selected' : '' }}>Ingredients</option>
                                        <option value="Ingredients Stock" {{ request()->table_name == "Ingredients Stock" ? 'selected' : '' }}>Ingredients Stock</option>
                                        <option value="Sales" {{ request()->table_name == "Sales" ? 'selected' : '' }}>Sales</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    @if ($selectedTableName)
                    <table class="w-full text-center divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Action
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    User
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Table Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item ID
                                </th>
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_foreign_id')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Foreign ID
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_name')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Name
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_category')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Category
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_unit')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Unit
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_description')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Description
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_in_stock')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item In Stock
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_out_stock')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Item Out Stock
                                </th>
                                @endif
                                @if ($logs->where('table_name', $selectedTableName)->whereNotNull('changed_attributes')->count() > 0)
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Changed Attributes
                                </th>
                                @endif
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                    Date Modified
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($logs->where('table_name', $selectedTableName) as $logs)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->action }} </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->user->name }}  </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->table_name }}  </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->item_id }} </td>
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_foreign_id')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->item_foreign_id ?? 'N/A'}} </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_name')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_name ?? 'N/A' }}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_category')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_category ?? 'N/A'}}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_unit')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_unit ?? 'N/A'}}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_description')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_description ?? 'N/A'}}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_in_stock')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_in_stock ?? 'N/A'}}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('item_out_stock')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $logs->item_out_stock ?? 'N/A'}}
                                    </td>
                                    @endif
                                    @if ($logs->where('table_name', $selectedTableName)->whereNotNull('changed_attributes')->count() > 0)
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->changed_attributes ?? 'N/A'}} </td>
                                    @endif
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $logs->created_at }} </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="p-4 dark:text-white" colspan="13">No Changes Log</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    @else
                    <hr class="border-t border-gray-200 dark:border-gray-700 my-4">
                    <h1 class="w-full text-center divide-y font-semibold text-gray-900 sm:text-2xl dark:text-white">Please select a table from the Dropdown
                    </h1>
                    <hr class="border-t border-gray-200 dark:border-gray-700 my-4">
                    @endif
                </div>
            </div>
        </div>
    </div>

    

@endsection
@section('script')
<script>
 document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('search_table_name');
    
    select.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var table_name = selectedOption.value;

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
                params['table_name'] = table_name;

                // Membuat query string baru
                var newQueryString = Object.keys(params).map(function(key) {
                    return key + '=' + params[key];
                }).join('&');

                // Membuat URL baru dengan query string yang diperbarui
                var newUrl = currentUrl.split('?')[0] + '?' + newQueryString;

                // Memperbarui URL
                window.location.href = newUrl;
            });
});
</script>
@endsection
