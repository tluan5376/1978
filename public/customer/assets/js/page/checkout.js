const View = { 
    Item: {
        clear(){
            $(".order-table tbody tr").remove()
        },
        render(data, k){
            var product_value   = data.data_product;
            var discount_value  = data.data_discount == null ?  0 : data.data_discount.percent; 
            var image           = product_value.images.split(",")[0];

            var discount        = product_value.prices*discount_value/100;
            var real_prices     = discount_value == 0 ? product_value.prices : product_value.prices - discount;
            var quantity        = localStorage.getItem("quantity") != null ? localStorage.getItem("quantity").split(",")[k] : 1;
            $(".order-table tbody")
                .append(`<tr class="cart_item"
                            data-total-prices="${product_value.prices*quantity}"
                            data-total-discount="${discount*quantity}"
                            data-total-real-prices="${real_prices*quantity}"
                            data-quatity="${quantity}">
                            <td>${product_value.name}&nbsp;<strong class="product-quantity">× ${quantity}</strong></td>
                            <td>
                                ${discount != 0 ? `<del>${ViewIndex.Config.formatPrices(product_value.prices * quantity)} đ</del>` : ""}
                                <div>${ViewIndex.Config.formatPrices(real_prices * quantity)} đ</div>
                            </td>
                        </tr>`)
            View.Cart.setTotal();
        }
    },
    Cart: {
        setTotal(){
            var subtotal = 0;
            var discount = 0;
            var total = 0;
            $(".order-table tbody tr").each(function(index, el) {
                subtotal    += +$(this).attr("data-total-prices");
                discount    += +$(this).attr("data-total-discount");
                total       += +$(this).attr("data-total-real-prices");
            });
            $(".sub-total").html(ViewIndex.Config.formatPrices(subtotal) + " đ");
            $(".dícount-total").html(`<strong class="discount-price">- ${ViewIndex.Config.formatPrices(discount)} đ</strong>` );
            $(".real-total").html(`<strong>${ViewIndex.Config.formatPrices(total)} đ</strong>`);
        },
        getVal(){
            var resource = $(".order-formdata");
            var fd = new FormData();
            var required_data = [];
            var onPushData = true;

            var data_cart          = localStorage.getItem("card");
            var data_quantity      = localStorage.getItem("quantity");
            var data_name          = resource.find('.data-name').val();
            var data_address       = resource.find('.data-address').val();
            var data_phone         = resource.find('.data-phone').val();
            var data_email         = resource.find('.data-email').val();
            var data_payment       = resource.find(".custom-control-input[name=stylishRadio]:checked").val();
 
            if (data_name == '') { required_data.push('Nhập tên.'); onPushData = false }
            if (data_address == '') { required_data.push('Nhập địa chỉ.'); onPushData = false }
            if (data_phone == '') { required_data.push('Nhập số điện thoại.'); onPushData = false }
            if (data_email == '') { required_data.push('Nhập email.'); onPushData = false }
            if (data_cart == null || data_cart == "") {  onPushData = false }
            if (data_quantity == null || data_quantity == "") {  onPushData = false }

            if (onPushData) {
                fd.append('data_cart', data_cart);
                fd.append('data_quantity', data_quantity);
                fd.append('data_name', data_name);
                fd.append('data_address', data_address);
                fd.append('data_phone', data_phone);
                fd.append('data_email', data_email);
                fd.append('data_payment', data_payment);
                return fd;
            }else{
                resource.find('.error-log .js-response').remove();
                var required_noti = ``;
                for (var i = 0; i < required_data.length; i++) { required_noti += `<li class="error">${required_data[i]}</li>`; }
                resource.find('.error-log').prepend(`<div class="js-response js-errors">${required_noti}</div> `)
                return false;
            }
        },
        onCheckout(callback){
            $(document).on('click', `.action-checkout`, function(event) {
                var data = View.Cart.getVal();
                if (data) callback(data);
            });
        },
        response: { 
            success(message){
                $(".error-log .js-response").remove();
                $(".error-log").prepend(`<div class="js-response js-success"><li>${message}</li></div>`)
                setTimeout(function () {
                    $('.error-log .js-response').remove();
                }, 5000);
            },
            error(message){
                $(".error-log .js-response").remove();
                $(".error-log").prepend(`<div class="js-response js-errors"><li>${message}</li></div>`)
                setTimeout(function () {
                    $('.error-log .js-response').remove();
                }, 5000);
            },                  
        },
    },
    init(){
        $(document).on('keypress', `.data-phone`, function(event) {
            return ViewIndex.Config.onNumberKey(event);
        }); 
        $("#basicsHeadingOne button").click()
    }
};
(() => {
    View.init();

    async function redirect_logined(url) {
        await delay(1500);
        window.location.replace(url);
    }
    function delay(delayInms) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(2);
            }, delayInms);
        });
    }
    View.Cart.onCheckout((fd) => {
        Api.Order.Checkout(fd)
            .done(res => { 
                if (res.status == 200) {
                    View.Cart.response.success(res.message)
                    localStorage.removeItem("card");
                    localStorage.removeItem("quantity");
                    redirect_logined(res.data)
                }else{
                    View.Cart.response.error(res.message)
                }
            })
            .fail(err => {   })
            .always(() => { }); 
    })
    function init(){ 
        getItem(); 
    } 
    function getItem(){
        var cart = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");
        if (cart.length > 0) {
            cart.map((v, k) => {
                Api.Product.GetOneItem(v)
                    .done(res => {
                        if (res.status == 200) View.Item.render(res.data, k)
                    })
                    .fail(err => {  })
                    .always(() => { });
            })
        }else{
            $(".cart-table table").remove();
            $(".cart-total").remove();
            $(".cart-table-wrapper").append(`<h6 class="text-center">Chưa có sản phẩm nào</h6>`)
        }
    }
    init()
})();
