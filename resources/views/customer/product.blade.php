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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#" class="category-name"></a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active product-name" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mb-xl-14 mb-6">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                        data-infinite="true"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                        data-nav-for="#sliderSyncingThumb"> 
                    </div>

                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                        data-infinite="true"
                        data-slides-show="5"
                        data-is-thumbs="true"
                        data-nav-for="#sliderSyncingNav"> 
                    </div>
                </div>
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block category-name"></a>
                            <h2 class="font-size-25 text-lh-1dot2 product-name"> </h2>
                            <div class="mb-2">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    <div class="text-warning mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                </a>
                            </div>
                            <div class="d-md-flex align-items-center"> 
                                <a href="#" class="product-category-image ml-n2 mb-2 mb-md-0 d-block mr-3"><img class="img-fluid category-image" src="" alt="Image Description"></a>
                                <div class="text-gray-9 font-size-14">Khả dụng: <span class="text-green font-weight-bold data-warehouse"></span></div>
                            </div>
                        </div> 
                        <div class="mb-2">
                            <ul class="font-size-14 pl-3 ml-1 text-gray-110 product-description">

                            </ul>
                        </div> 
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline product-prices"> </div>
                        </div>
                        <div class="d-md-flex align-items-end mb-3"> 
                            <div class="ml-md-3">
                                <a href="#" class="btn px-5 btn-primary-dark transition-3d-hover action-add-to-card" data-id=" " atr="Add to card"> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="mb-8">
            <div class="position-relative position-md-static px-md-6">
                <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Mô tả</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Thông tin chi tiết</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Đánh giá</a>
                    </li>
                </ul>
            </div>
            <!-- Tab Content -->
            <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                <div class="tab-content" id="Jpills-tabContent">
                    <div class="tab-pane fade active show product-detail" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">

                    </div>
                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                        <div class="mx-md-5 pt-1">
                            <h3 class="font-size-18 mb-4">Thông số kĩ thuật</h3>
                            <div class="table-responsive mb-4">
                                <table class="table table-hover">
                                    <tbody class="metadata-list"> 
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                        <div class="row mb-8">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h3 class="font-size-18 mb-6 count-rate"> </h3>
                                    <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0 avg-rating-number"> </h2> 
                                </div> 
                                <ul class="rate-list-data"> 
                                </ul> 
                            </div>
                            <div class="col-md-6">
                                <h3 class="font-size-18 mb-5">Thêm đánh giá</h3>
                                <!-- Form -->
                                <div class="js-validate">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="rating" class="form-label mb-0">Đánh giá</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <div id="half-stars-example">
                                                <div class="rating-group">
                                                    <input class="rating__input rating__input--none" name="rating2" id="rating2-0" value="0" type="radio">
                                                    <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                                                    <label aria-label="1 star" class="rating__label" for="rating2-10">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating2-20">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating2-30">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating2-40">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating2-50">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio" checked="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="descriptionTextarea" class="form-label">Bình luận</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" rows="3" id="comment" ></textarea>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="offset-md-4 offset-lg-3 col-auto">
                                            <button type="button" class="btn btn-primary-dark btn-wide transition-3d-hover comment-submit" atr="Comment Submit">Bình luận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="commentlist">
                            
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title mb-0 pb-2 font-size-22">Sản phẩm liên quan</h3>
            </div>
            <ul class="row list-unstyled products-group no-gutters related-products-list"> 
            </ul>
        </div>
    </div>
</main>
@endsection()

@section('sub_layout')

@endsection()


@section('js')
<script type="text/javascript" src="{{ asset('customer/assets/js/page/product.js') }}"></script>
@endsection()