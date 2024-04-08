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
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="flex flex-col items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                    Products Sales Statistics
                    <span class="text-base">
                        {{$topdate}}
                    </span>
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
                        @forelse ($topSellingProducts as $product)

                        <li class="py-3 sm:py-4">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                              <div class="ml-3">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                  {{$product['product_name']}}
                                </p>
                              </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              {{$product['total_sold']}} Cup
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
                             <!-- Display total_sold_sum here -->
                             <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">
                                                Total Sold
                                            </p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-bold text-gray-900 dark:text-white">
                                        {{$totalSoldSum}} Cup
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
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Total Products
                    </h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"> {{$totalproduct}} </span>
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
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"> {{$totaluser}} </span>
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
                            Total ingredient Product
                        </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"> {{$totalingredient}} </span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Since last month
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>

 document.addEventListener('DOMContentLoaded', function() {
    let mainChartColors = {}
    //Menyimpan kategori x-axis secara global
    let xCategories = @json($chartData['dates']);
    //Menyimpan series data secara global
    let seriesData = @json($chartData['total_sales']);
    // Store product data globally
    let productData = @json($chartData['products']);

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
        }
    }
    var chartPenjualanOptions =
    {
		chart: {
			height: 420,
			type: 'area',
			fontFamily: 'Inter, sans-serif',
			foreColor: mainChartColors.labelColor,
			toolbar: {
				show: false
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
				enabled: true,
				opacityFrom: mainChartColors.opacityFrom,
				opacityTo: mainChartColors.opacityTo
			}
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
        /* tooltip: {
            custom: function({ series, seriesIndex, dataPointIndex, w}) {
                // Get the date for the current data point from the global xCategories variable
                const date = xCategories[dataPointIndex];
                
                // Construct the tooltip content
                let tooltipContent = '<div class="custom-tooltip">';
                tooltipContent += '<span>Date: ' + date + '</span>'; // Display the date
                
                // Display total sales for the current date
                tooltipContent += '<span>Total Sold: ' + series[seriesIndex][dataPointIndex] + '</span>';
                
                // Access product data globally
                const product = productData[dataPointIndex];
                // Display product data in tooltip
                tooltipContent += '<span>Product: Ice Latte</span>';
                tooltipContent += '<span>Sales: 20</span>';
                // Add other tooltip content as needed
                
                tooltipContent += '</div>';
                
                return tooltipContent; // Return the constructed tooltip content
            }
        }, */
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
				name: 'Total Sold',
				data: seriesData,// menggunakan variable seriesData
				color: '#1A56DB'
			},

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
			categories: xCategories, // menggunakan variable xCategories
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

	// init again when toggling dark mode
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

