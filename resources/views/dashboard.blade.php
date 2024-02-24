@extends('layouts.layout')
@section('content')
    <div class="px-4 pt-6">
        <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
            <!-- Main widget -->
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex-shrink-0">
                        <h3 class="flex items-center justify-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                            Chart Rekap Product Penjualan
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
                            Last 7 days
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="weekly-sales-dropdown">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                    Sep 16, 2021 - Sep 22, 2021
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Today</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 7 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 30 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 90 days</a>
                                </li>
                            </ul>
                            <div class="py-1" role="none">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Custom...</a>
                            </div>
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
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                    Statistics Penjualan Product
                </h3>
                <div data-popover id="popover-description" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">
                            Statistics
                        </h3>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <img class="flex-shrink-0 w-10 h-10"
                                src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                alt="imac image" />
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  iPhone 14 Pro
                                </p>
                                <div
                                  class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                    </path>
                                  </svg>
                                  2.5%
                                  <span class="ml-2 text-gray-500">vs last month</span>
                                </div>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              $445,467
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <img class="flex-shrink-0 w-10 h-10"
                                src="https://flowbite-admin-dashboard.vercel.app/images/products/imac.png"
                                alt="imac image" />
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  Apple iMac 27"
                                </p>
                                <div
                                  class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                    </path>
                                  </svg>
                                  12.5%
                                  <span class="ml-2 text-gray-500">vs last month</span>
                                </div>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              $256,982
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <img class="flex-shrink-0 w-10 h-10"
                                src="https://flowbite-admin-dashboard.vercel.app/images/products/watch.png"
                                alt="watch image" />
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  Apple Watch SE
                                </p>
                                <div class="flex items-center justify-end flex-1 text-sm text-red-600 dark:text-red-500">
                                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                    </path>
                                  </svg>
                                  1.35%
                                  <span class="ml-2 text-gray-500">vs last month</span>
                                </div>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              $201,869
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <img class="flex-shrink-0 w-10 h-10"
                                src="https://flowbite-admin-dashboard.vercel.app/images/products/ipad.png"
                                alt="ipad image" />
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  Apple iPad Air
                                </p>
                                <div
                                  class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                    </path>
                                  </svg>
                                  12.5%
                                  <span class="ml-2 text-gray-500">vs last month</span>
                                </div>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              $103,967
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <img class="flex-shrink-0 w-10 h-10"
                                src="https://flowbite-admin-dashboard.vercel.app/images/products/imac.png"
                                alt="imac image" />
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  Apple iMac 24"
                                </p>
                                <div class="flex items-center justify-end flex-1 text-sm text-red-600 dark:text-red-500">
                                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                    </path>
                                  </svg>
                                  2%
                                  <span class="ml-2 text-gray-500">vs last month</span>
                                </div>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              $98,543
                            </div>
                          </div>
                        </li>
                      </ul>
                  </div>
                <!-- Card Footer -->
                <div
                    class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                    <div>
                        <button
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            type="button" data-dropdown-toggle="stats-dropdown">
                            Last 7 days
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="stats-dropdown">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                    Sep 16, 2021 - Sep 22, 2021
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Today</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 7 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 30 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Last 90 days</a>
                                </li>
                            </ul>
                            <div class="py-1" role="none">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Custom...</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="#"
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
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Total Products
                    </h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        Since last month
                    </p>
                </div>
            </div>
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Users
                    </h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        Since last month
                    </p>
                </div>
            </div>
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">
                            Total Product Stock
                        </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Since last month
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
