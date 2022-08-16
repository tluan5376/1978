@extends('customer.layout')
@section('title', "")


@section('css')

@endsection()


@section('body')

<main id="content" role="main" class="checkout-page"> 

    <div class="container">
        <div class="mb-5 mt-5">
            <h1 class="text-center">Đặt hàng</h1>
        </div> 
        <div class=" order-formdata" novalidate="novalidate">
        	<div class="error-log"></div>
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg"> 
                            <div class="p-4 mb-4 checkout-table"> 
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Đơn hàng</h3>
                                </div> 
                                <table class="table order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tạm tính</th>
                                        </tr>
                                    </thead>
                                    <tbody> 

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tạm tính</th>
                                            <td class="sub-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Giảm giá</th>
                                            <td class="dícount-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Tổng</th>
                                            <td class="real-total"><strong></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1"> 
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingThree">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" value="1" id="thirdstylishRadio1" name="stylishRadio" checked>
                                                    <label class="custom-control-label form-label" for="thirdstylishRadio1" >
                                                        Thanh toán khi nhận hàng
                                                    </label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingFour">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" value="2" id="FourstylishRadio1" name="stylishRadio">
                                                    <label class="custom-control-label form-label" for="FourstylishRadio1" >
                                                        Thanh toán ngay với VNPay
                                                    </label>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                                <button type="button" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 action-checkout">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 order-lg-1">
                    <div class="pb-7 mb-7"> 
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Thông tin đặt hàng</h3>
                        </div> 
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Họ và tên
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control data-name" name="name" placeholder="Họ và tên" autocomplete="off" value="<?php  echo $customer_data['name'] ?>">
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Số điện thoại nhận hàng
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control data-phone" name="phone" placeholder="Điện thoại" autocomplete="off" value="<?php  echo $customer_data['phone'] ?>">
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control data-email" name="email" placeholder="Email" autocomplete="off" value="<?php  echo $customer_data['email'] ?>">
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Địa chỉ nhận hàng
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control data-address" name="address" placeholder="Địa chỉ nhận hàng" autocomplete="off" value="<?php  echo $customer_data['address'] ?>">
                                </div> 
                            </div>  
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection()

@section('sub_layout')

@endsection()


@section('js')
<script type="text/javascript" src="{{ asset('customer/assets/js/page/checkout.js') }}"></script>
@endsection()