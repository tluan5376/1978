@extends('customer.layout')
@section('title', "")


@section('css')

@endsection()


@section('body')
<main id="content" role="main">
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active category-name" aria-current="page"> </li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                Tất cả danh mục
                            </a>

                            <div id="sidebarNav1Collapse" class="collapse show" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list category-list">
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>
                <div class="mb-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Bộ lọc</h3>
                    </div>
                    <div class="filter-list">
                    	
                    </div>
                    <div class="range-slider">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                        <!-- Range Slider -->
                        <input class="js-range-slider" type="text"
    	                    data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
    	                    data-type="double"
    	                    data-grid="false"
    	                    data-hide-from-to="true"
    	                    data-prefix="đ"
    	                    data-min="0"
    	                    data-max="50000000"
    	                    data-from="0"
    	                    data-to="50000000"
    	                    data-step="100000"
    	                    data-result-min="#rangeSliderExample3MinResult"
    	                    data-result-max="#rangeSliderExample3MaxResult" value="0;50000000">
                        <!-- End Range Slider -->
                        <div class="mt-1 text-gray-111 d-flex mb-4">
                            <span class="mr-0dot5">Price: </span>
                            <span>đ</span>
                            <span id="rangeSliderExample3MinResult" class=""></span>
                            <span class="mx-0dot5"> — </span>
                            <span>đ</span>
                            <span id="rangeSliderExample3MaxResult" class=""></span>
                        </div>
                        <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg filter-prices">Lọc theo giá</button>
                    </div>
                </div> 
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0 category-name"> </h3>
                    <p class="font-size-14 text-gray-90 mb-0">Hiển thị <span class="count-start"></span> - <span class="count-end"></span> trong <span class="count-total"></span> kết quả</p>
                </div>
                <!-- End shop-control-bar Title -->
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a> 
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-align-justify"></i>
                                    </div>
                                </a>
                            </li> 
                        </ul>
                    </div>
                    <div class="d-flex">
                        <form method="get">
                            <!-- Select -->
                            <select class=" right-dropdown-0 px-2 px-xl-0 page_size_category"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0" id="ec-select">
                                    <option value="0">Sắp xếp theo</option>
                                    <option value="1">Mới nhất</option>
                                    <option value="2">Tên , A đến Z</option>
                                    <option value="3">Tên , Z đến A</option>
                                    <option value="4">Giá tiền, Thấp đến Cao</option>
                                    <option value="5">Giá tiền, Cao đến Thấp</option>
                            </select>
                            <!-- End Select -->
                        </form> 
                    </div> 
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            
                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                        </ul>
                    </div> 
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">Hiển thị <span class="count-start"></span> - <span class="count-end"></span> trong <span class="count-total"></span> kết quả</div>
                    <div class="woocommerce-pagination">
                        
                    </div>
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div> 
    </div>
</main>

@endsection()

@section('sub_layout')

@endsection()


@section('js')
<script type="text/javascript" src="{{ asset('customer/assets/js/page/category.js') }}"></script>
@endsection()