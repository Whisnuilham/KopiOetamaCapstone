@extends('layouts.layout')


@section('content')
    <div class="px-4 pt-6">
        <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
            <!-- Main widget -->
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex-shrink-0">
                        <h3 class="flex flex-col items-center justify-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                            Products Sales Recap Chart
                            <span class="text-base">
                                {{$chartdate}}
                            </span>
                        </h3>
                    </div>
                </div>
                <div id="main-chart"></div>
                <!-- Card Footer -->
                <div
                    class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                    <div>
                        <button
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            type="button" data-dropdown-toggle="weekly-sales-dropdown">
                            @if (request()->filterChart=="yesterday")
                            Yesterday
                            @elseif (request()->filterChart=="today")
                            Today
                            @elseif (request()->filterChart=="last_7_days")
                            Last 7 days
                            @elseif (request()->filterChart=="last_30_days")
                            Last 30 days
                            @else
                            Last 7 days
                            @endif
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="weekly-sales-dropdown">

                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" onclick="applyFilter('yesterday')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#" onclick="applyFilter('today')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Today</a>
                                </li>
                                <li>
                                    <a href="#" onclick="applyFilter('last_7_days')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 7 days</a>
                                </li>
                                <li>
                                    <a href="#" onclick="applyFilter('last_30_days')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 30 days</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('penjualan') }}"
                            class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                            Sales Report
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!--Tabs widget -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex flex-col items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
        Ingredient Out Statistics
        <span class="text-base">
            {{ $topdate }}
        </span>
    </h3>

    <!-- List of products and their sales -->

    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($ingredient_stocks as $stock)
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                {{ $stock->ingredient_name }}
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{ $stock->total_out_stock }} ({{ $stock->unit }})
                    </div>
                </div>
            </li>
            @empty
            <li class="py-3 sm:py-4">
                <div class="flex items-center min-w-0">
                    <div class="ml-3">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                            Tidak Terdapat Penjualan
                        </p>
                    </div>
                </div>
            </li>
            @endforelse

            <!-- Pagination links -->
            
        </ul>
    </div>

    <!-- Dropdown for top statistics -->
    <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="stats-dropdown">
                @if (request()->filterTop=="yesterday")
                Yesterday
                @elseif (request()->filterTop=="today")
                Today
                @elseif (request()->filterTop=="last_7_days")
                Last 7 days
                @elseif (request()->filterTop=="last_30_days")
                Last 30 days
                @else
                Last 7 days
                @endif
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="stats-dropdown">
                <ul class="py-1" role="none">
                    <li>
                        <a href="#" onclick="applyFilterTop('yesterday')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('today')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_7_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_30_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('penjualan') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                Full Report
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>

        </div>
        <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex flex-col items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
        Top Products
        <span class="text-base">
            {{ $topdate }}
        </span>
    </h3>

    <!-- List of products and their sales -->

    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

        <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Anggur Dahayu
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        140 Cup
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Kopi Susu Toean Oetama
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        120 Cup
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Kopi Susu Permen Kapas
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        102 Cup
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Cahyo Mantrijeron 38
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        97 Cup
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Gonzaga Pine Brulee
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        77 Cup
                    </div>
                </div>
            </li>

            <!-- Pagination links -->
            
        </ul>
    </div>

    <!-- Dropdown for top statistics -->
    <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="stats-dropdown">
                @if (request()->filterTop=="yesterday")
                Yesterday
                @elseif (request()->filterTop=="today")
                Today
                @elseif (request()->filterTop=="last_7_days")
                Last 7 days
                @elseif (request()->filterTop=="last_30_days")
                Last 30 days
                @else
                Last 7 days
                @endif
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="stats-dropdown">
                <ul class="py-1" role="none">
                    <li>
                        <a href="#" onclick="applyFilterTop('yesterday')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('today')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_7_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_30_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('penjualan') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                Full Report
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex flex-col items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
        Expired Soon
        <span class="text-base">
            {{ $topdate }}
        </span>
    </h3>

    <!-- List of products and their sales -->

    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        <li class="py-3 sm:py-4">

                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                            Rosemary Syrup
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        28-06-2024
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Lychee
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    28-06-2024
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Banana Pasta
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    29-06-2024
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Black Tea
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    29-06-2024
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Vanilla Syrup
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    31-06-2024
                    </div>
                </div>
            </li>

            <!-- Pagination links -->
            
        </ul>
    </div>

    <!-- Dropdown for top statistics -->
    <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="stats-dropdown">
                @if (request()->filterTop=="yesterday")
                Yesterday
                @elseif (request()->filterTop=="today")
                Today
                @elseif (request()->filterTop=="last_7_days")
                Last 7 days
                @elseif (request()->filterTop=="last_30_days")
                Last 30 days
                @else
                Last 7 days
                @endif
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="stats-dropdown">
                <ul class="py-1" role="none">
                    <li>
                        <a href="#" onclick="applyFilterTop('yesterday')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('today')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_7_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_30_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('penjualan') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                Full Report
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex flex-col items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
        Need to Restock
        <span class="text-base">
            {{ $topdate }}
        </span>
    </h3>

    <!-- List of products and their sales -->

    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Sugar
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        10000 Gram
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Lychee
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        100 Pcs
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Banana Pasta
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        1000 Gram
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Black Tea
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        500 Ml
                    </div>
                </div>
            </li>
            <li class="py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center min-w-0">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                Vanilla Syrup
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        1000 Ml
                    </div>
                </div>
            </li>

            <!-- Pagination links -->
            
        </ul>
    </div>

    <!-- Dropdown for top statistics -->
    <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="stats-dropdown">
                @if (request()->filterTop=="yesterday")
                Yesterday
                @elseif (request()->filterTop=="today")
                Today
                @elseif (request()->filterTop=="last_7_days")
                Last 7 days
                @elseif (request()->filterTop=="last_30_days")
                Last 30 days
                @else
                Last 7 days
                @endif
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="stats-dropdown">
                <ul class="py-1" role="none">
                    <li>
                        <a href="#" onclick="applyFilterTop('yesterday')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('today')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_7_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#" onclick="applyFilterTop('last_30_days')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('penjualan') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                Full Report
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let mainChartColors = {};
        let xCategories = @json($chartData['dates']);
        
        // Example data: replace these with your actual data
        let series1Data = @json($chartData['total_sales']);
        let series2Data = @json($chartData['additional_series_1']);
        let series3Data = @json($chartData['additional_series_2']);
        let series4Data = @json($chartData['additional_series_3']);
        let series5Data = @json($chartData['additional_series_4']);

        if (document.documentElement.classList.contains('dark')) {
            mainChartColors = {
                borderColor: '#374151',
                labelColor: '#9CA3AF',
                opacityFrom: 0,
                opacityTo: 0.15,
            };
        } else {
            mainChartColors = {
                borderColor: '#F3F4F6',
                labelColor: '#6B7280',
                opacityFrom: 0.45,
                opacityTo: 0,
            };
        }

        var chartPenjualanOptions = {
            chart: {
                height: 420,
                type: 'line', // Changed from 'area' to 'line'
                fontFamily: 'Inter, sans-serif',
                foreColor: mainChartColors.labelColor,
                toolbar: {
                    show: false
                }
            },
            fill: {
                type: 'solid'
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                style: {
                    fontSize: '14px',
                    fontFamily: 'Inter, sans-serif',
                },
            },
            grid: {
                show: true,
                borderColor: mainChartColors.borderColor,
                strokeDashArray: 1,
                padding: {
                    left: 35,
                    bottom: 15
                }
            },
            series: [
                {
                    name: 'Anggur Dahayu',
                    data: series1Data,
                    color: '#1A56DB'
                },
                {
                    name: 'Kopi Susu Toean Oetama', // Replace with actual name
                    data: series2Data,
                    color: '#FF5733'
                },
                {
                    name: 'Kopi Susu Permen Kapas', // Replace with actual name
                    data: series3Data,
                    color: '#28A745'
                },
                {
                    name: 'Cahyo Mantrijeron 38', // Replace with actual name
                    data: series4Data,
                    color: '#FFC107'
                },
                {
                    name: 'Gonzaga Pine Brulee', // Replace with actual name
                    data: series5Data,
                    color: '#17A2B8'
                }
            ],
            markers: {
                size: 5,
                strokeColors: '#ffffff',
                hover: {
                    size: undefined,
                    sizeOffset: 3
                }
            },
            xaxis: {
                categories: xCategories,
                labels: {
                    style: {
                        colors: [mainChartColors.labelColor],
                        fontSize: '14px',
                        fontWeight: 500,
                    },
                },
                axisBorder: {
                    color: mainChartColors.borderColor,
                },
                axisTicks: {
                    color: mainChartColors.borderColor,
                },
                crosshairs: {
                    show: true,
                    position: 'back',
                    stroke: {
                        color: mainChartColors.borderColor,
                        width: 1,
                        dashArray: 10,
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: [mainChartColors.labelColor],
                        fontSize: '14px',
                        fontWeight: 500,
                    },
                },
            },
            legend: {
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Inter, sans-serif',
                labels: {
                    colors: [mainChartColors.labelColor]
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            responsive: [
                {
                    breakpoint: 1024,
                    options: {
                        xaxis: {
                            labels: {
                                show: false
                            }
                        }
                    }
                }
            ]
        };

        const chart = new ApexCharts(document.getElementById('main-chart'), chartPenjualanOptions);
        chart.render();

        // Init again when toggling dark mode
        document.addEventListener('dark-mode', function () {
            chart.updateOptions(chartPenjualanOptions);
        });
    });

    function applyFilter(filter) {
        var url = new URL(window.location.href);
        url.searchParams.set('filterChart', filter);
        window.location.href = url.href;
    }

    function applyFilterTop(filter) {
        var url = new URL(window.location.href);
        url.searchParams.set('filterTop', filter);
        window.location.href = url.href;
    }
</script>
@endsection
