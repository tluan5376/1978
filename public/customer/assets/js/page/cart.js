const View = { 
    Item: {
        clear(){
            $(".cart-table-wrapper tbody tr").remove()
        },
        render(data, k){
            var product_value   = data.data_product;
            var discount_value  = data.data_discount == null ?  0 : data.data_discount.percent; 
            var image           = product_value.images.split(",")[0];

            var discount        = product_value.prices*discount_value/100;
            var real_prices     = discount_value == 0 ? product_value.prices : product_value.prices - discount;
            var quantity        = localStorage.getItem("quantity") == null ? 1 : localStorage.getItem("quantity").split(",")[k] != undefined ? localStorage.getItem("quantity").split(",")[k] : 1;

            $(".cart-table-wrapper tbody")
                .append(`<tr data-id="${product_value.id}"
                            data-prices="${product_value.prices}" 
                            data-real-prices="${real_prices}"
                            data-discount="${discount}"
                            data-discount-value="${discount_value}"
                            data-total-prices="${product_value.prices*quantity}"
                            data-total-discount="${discount*quantity}"
                            data-total-real-prices="${real_prices*quantity}"
                            data-quatity="${quantity}">
                            <td class="text-center">
                                <a href="#" class="text-gray-32 font-size-26 remove-item">×</a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="/product/${product_value.slug}?id=${product_value.id}" class="cart-image-item"><img class="img-fluid max-width-100 p-1 border border-color-1" src="${image}" alt="Image Description"></a>
                            </td>
                            <td data-title="Product">
                                <a href="/product/${product_value.slug}?id=${product_value.id}" class="text-gray-90">${product_value.name}</a>
                            </td>
                            <td data-title="Price">
                                <span class="">${ViewIndex.Config.formatPrices(product_value.prices)} đ</span>
                            </td>
                            <td data-title="Quantity">
                                <span class="sr-only">Quantity</span>
                                <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none product-quantity quantity-value" type="text" value="${quantity}">
                                        </div> 
                                    </div>
                                </div>
                            </td>
                            <td data-title="Price">
                                <div class="">${discount_value} %</div>
                                ${discount == 0 ? "" : `<span class="discount-price data-total-discount">-${ViewIndex.Config.formatPrices(discount*quantity)} đ</span>`}
                            </td>
                            <td data-title="Total">
                                ${discount == 0 ? "" : `<del class="data-total-prices-defaul">${ViewIndex.Config.formatPrices(product_value.prices*quantity)} đ</del>`}
                                <div class="data-total-prices">${ViewIndex.Config.formatPrices(real_prices*quantity)} đ</div>
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
            $(".cart-table-wrapper tbody tr").each(function(index, el) {
                subtotal    += +$(this).attr("data-total-prices");
                discount    += +$(this).attr("data-total-discount");
                total       += +$(this).attr("data-total-real-prices");
            });
            $(".sub-total").html(ViewIndex.Config.formatPrices(subtotal) + " đ");
            $(".dícount-total").html("- " + ViewIndex.Config.formatPrices(discount) + " đ");
            $(".real-total").html(ViewIndex.Config.formatPrices(total) + " đ");
            $(".real-total").attr("data-total", total);
        },
        onRemove(callback){
            $(document).on('click', `.remove-item`, function(event) {
                var father = $(this).parent().parent();
                var id = father.attr("data-id");
                father.remove();
                callback(id)
            });
        },
        onCheckout(callback){
            $(document).on('click', `.action-checkout`, function(event) {
                callback($(".real-total").attr("data-total"));
            });
        },
    },
    init(){
        $(document).on('keypress', `.product-quantity`, function(event) {
            return ViewIndex.Config.onNumberKey(event);
        });
        $(document).on('keyup', `.product-quantity`, function(event) {
            var father      = $(this).parent().parent().parent().parent().parent();
            var prices      = father.attr("data-prices");
            var real_prices = father.attr("data-real-prices");
            var discount    = father.attr("data-discount");
            var quantity    = father.find(".product-quantity").val();

            father.find(".data-total-prices").html(ViewIndex.Config.formatPrices(real_prices*quantity) + " đ");
            father.find(".data-total-discount").html("-"+ViewIndex.Config.formatPrices(discount*quantity) + " đ");
            father.find(".data-total-prices-defaul").html(ViewIndex.Config.formatPrices(prices*quantity) + " đ");

            father.attr("data-quatity", quantity);
            father.attr("data-total-prices", prices*quantity);
            father.attr("data-total-discount", discount*quantity);
            father.attr("data-total-real-prices", real_prices*quantity);
            View.Cart.setTotal();
        });
        $("#basicsHeadingOne button").click()
    }
};
(() => {
    View.init()
    function init(){ 
        getCart();
        if (!ViewIndex.Auth.isLogin()) getItem();
        
    }
    async function redirect_logined(url) {
        await delay(500);
        window.location.replace(url);
    }
    function delay(delayInms) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(2);
            }, delayInms);
        });
    }
    function debounce(f, timeout) {
        let isLock = false;
        let timeoutID = null;
        return function(item) {
            if(!isLock) {
                f(item);
                isLock = true;
            }
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function() {
                isLock = false;
            }, timeout);
        }
    } 
    View.Cart.onRemove((id) => {
        var cart_item = localStorage.getItem("card").split(",").filter(item => item !== id).join(",");
        localStorage.setItem("card", cart_item)
        View.Cart.setTotal();
        updateCartUser();
    })
    View.Cart.onCheckout((total_prices) => {
        localStorage.removeItem("quantity"); 
        var quantity_list = [];
        $(".quantity-value").each(function(index, el) {
            quantity_list.push($(this).val())
        });
        localStorage.setItem("quantity", quantity_list);
        localStorage.setItem("total_prices", total_prices);
    })
    function getCart(){
        if (ViewIndex.Auth.isLogin()) {
            Api.Cart.GetCart()
                .done(res => { 
                    if (res.status == 200) {
                        if (res.data.cart != null) {
                            var cart = localStorage.getItem("card") == null ? [] : localStorage.getItem("card").split(",");
                            res.data.cart.split(",").map(v => {
                                cart.includes(v) ? "" : cart.push(v);
                            })
                            localStorage.setItem("card", cart);
                        }
                        getItem();
                        updateCartUser();
                    }else{
                        redirect_logined(res.data)
                    }
                })
        }
    }
    function updateCartUser(){
        if (ViewIndex.Auth.isLogin()) {
            var cart = localStorage.getItem("card");
            if (cart != null) {
                var fd = new FormData();
                fd.append('cart', cart); 
                Api.Cart.Update(fd)
                    .done(res => {
                        ViewIndex.Cart.update();
                    })
                    .fail(err => {  })
                    .always(() => { });
            }
        }
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
