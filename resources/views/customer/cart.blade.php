@extends('customer.layout')
@section('title', "")


@section('css')

@endsection()


@section('body')
<main id="content" role="main" class="cart-page"> 
    <div class="container">
        <div class="mb-4 mt-4">
            <h1 class="text-center">Giỏ hàng</h1>
        </div>
        <div class="mb-5 cart-table">
            <div class="mb-4 cart-table-wrapper">
                <table class="table table-striped" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name" width="250">Tên sản phẩm</th>
                            <th class="product-price">Đơn giá</th>
                            <th class="product-quantity w-lg-15">Số lượng</th>
                            <th class="product-discount">Giảm giá</th>
                            <th class="product-subtotal">Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-8 cart-total">
            <div class="row"> 
                <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                	<div class="d-block d-md-flex flex-center-between justify-content-md-center mb-5"> 
                        <?php if ($customer_data['is_login']): ?> 
                        	<a href="/checkout" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto action-checkout">Đặt hàng</a>
                        <?php else: ?>
                            <a href="/checkout" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto action-checkout">Đặt hàng ngay</a>
                        	{{-- <div class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block open-login-popup">Bạn cần đăng nhập để đặt hàng</div> --}}
                        <?php endif ?> 
                    </div>
                    <div class="border-bottom border-color-1 mb-3">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Thanh toán</h3>
                    </div>
                    <table class="table mb-3 mb-md-0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Tạm tính</th>
                                <td data-title="Subtotal"><span class="amount sub-total"></span></td>
                            </tr>
                            <tr class="discount-subtotal">
                                <th>Giảm giá</th>
                                <td data-title="Subtotal"><span class="amount dícount-total"></span></td>
                            </tr>
                            <tr class="order-total">
                                <th>Thực tính</th>
                                <td data-title="Total"><strong><span class="amount real-total"></span></strong></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</main>

@endsection()

@section('sub_layout')

@endsection()


@section('js')
<script type="text/javascript" src="{{ asset('customer/assets/js/page/cart.js') }}"></script>
@endsection()