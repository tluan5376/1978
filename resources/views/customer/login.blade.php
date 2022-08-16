@extends('customer.layout')
@section('title', "")


@section('css')

@endsection()


@section('body')

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Account</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container"> 
                <div class="my-4 my-xl-8">
                    <div class="row">
                        <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                            <form class="js-validate">
                                    
                                <div id="login" data-target-group="idForm">
                                    <!-- Title -->
                                    <header class="text-center mb-7">
                                    <h1 class="h4 mb-0">Chào mừng chở lại!</h1>
                                    <p>Đăng nhập vào hệ thống.</p>
                                    </header>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signinEmail">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinEmailLabel">
                                                        <i class="fas fa-at"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control data-email" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                data-msg="Email không đúng định dạng."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                          <label class="sr-only" for="signinPassword">Mật khẩu</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="signinPasswordLabel">
                                                    <span class="fas fa-lock"></span>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control data-password" name="password" id="signinPassword" placeholder="Mật khẩu" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                               data-msg="Your password is invalid. Please try again."
                                               data-error-class="u-has-error"
                                               data-success-class="u-has-success">
                                          </div>
                                        </div>
                                    </div> 
                                    <div class="d-flex justify-content-end mb-4">
                                        <a class="js-animation-link small link-muted" href="javascript:;"
                                           data-target="#forgotPassword"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Quên mật khẩu?</a>
                                    </div>

                                    <div class="mb-2">
                                        <button type="button" class="btn btn-block btn-sm btn-primary transition-3d-hover color-white form-submit" atr="Login">Đăng nhập</button>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Bạn chưa có tài khoản?</span>
                                        <a class="js-animation-link small text-dark" href="javascript:;"
                                           data-target="#signup"
                                           data-link-group="idForm"
                                           data-animation-in="slideInUp">Đăng ký
                                        </a>
                                    </div>
                                </div>
                                <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                    <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">Đăng ký.</h2>
                                    </header>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupEmail">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupEmailLabel">
                                                        <i class="fas fa-at"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control data-email" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                                data-msg="Email không đúng định dạng."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupPassword">Mật khẩu</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control data-password" name="password" id="signupPassword" placeholder="Mật khẩu" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                                data-msg="Password không đúng định dạng."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                        <label class="sr-only" for="signupConfirmPassword">Nhập lại mật khẩu</label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                    <span class="fas fa-key"></span>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control data-password-repert" name="confirmPassword" id="signupConfirmPassword" placeholder="Nhập lại mật khẩu" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                            data-msg="Password nhập lại không đúng."
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupName">Họ và tên</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupNameLabel">
                                                        <span class="fas fa-user"></span>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control data-name" name="name" id="signupName" placeholder="Họ và tên" aria-label="Name" aria-describedby="signupNameLabel" required
                                                data-msg="Trường bắt buộc."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupPhone">Số điện thoại</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupPhoneLabel">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control data-phone" name="phone" id="signupPhone" placeholder="Số điện thoại" aria-label="Phone" aria-describedby="signupPhoneLabel" required
                                                data-msg="Trường bắt buộc."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupAddress">Địa chỉ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupAddressLabel">
                                                        <i class="fas fa-address-card"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control data-address" name="address" id="signupAddress" placeholder="Địa chỉ" aria-label="Address" aria-describedby="signupAddressLabel" required
                                                data-msg="Trường bắt buộc."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>         
                                    <div class="mb-2">
                                        <button type="button" class="btn btn-block btn-sm btn-primary transition-3d-hover color-white form-submit" atr="Register">Đăng ký</button>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Bạn đã có tài khoản?</span>
                                        <a class="js-animation-link small text-dark" href="javascript:;"
                                            data-target="#login"
                                            data-link-group="idForm"
                                            data-animation-in="slideInUp">Đăng nhập
                                        </a>
                                    </div> 
                                </div>
                                <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                    <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Quên mật khẩu.</h2>
                                        <p>Nhập email để khôi phục mật khẩu.</p>
                                    </header>
                                    <div class="form-group form-email">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="recoverEmail">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="recoverEmailLabel">
                                                        <i class="fas fa-at"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control data-email" name="email" id="recoverEmail" placeholder="Email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                                data-msg="Hãy nhập email của bạn."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-password" style="display: none;">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="recoverEmail">Mật khẩu mới</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="recoverCodeLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control data-password" name="text" id="recoverEmail" placeholder="Mật khẩu mới" aria-describedby="recoverCodeLabel"  required
                                                data-msg="Trường bắt buộc."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-code" style="display: none;">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="recoverEmail">Mã xác thực</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="recoverCodeLabel">
                                                        <i class="fas fa-code"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control data-code" name="text" id="recoverEmail" placeholder="Mã xác thực" aria-describedby="recoverCodeLabel"  required
                                                data-msg="Trường bắt buộc."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="button" class="btn btn-block btn-sm btn-primary transition-3d-hover color-white form-submit" atr="Forgot">Lấy lại mật khẩu</button>
                                    </div>
                                    <div class="text-center mb-4">
                                        <span class="small text-muted">Bạn đã có tài khoản?</span>
                                        <a class="js-animation-link small text-dark" href="javascript:;"
                                            data-target="#login"
                                            data-link-group="idForm"
                                            data-animation-in="slideInUp">Đăng nhập
                                        </a>
                                    </div> 
                                </div> 
                            </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
@endsection()

@section('sub_layout')

@endsection()


@section('js')
<script type="text/javascript" src="{{ asset('customer/assets/js/page/checkout.js') }}"></script>
@endsection()