const View = {
    Auth: {
        get(){
            return $(".authen").val() == "" ? 0 : $(".authen").val();
        }
    },
    Product: {
        renderNewArrivals(data){ 
            var cards = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");
            data.map(v => {
                var product_value   = v.data_product;
                var discount_value  = v.data_discount;
                var image           = product_value.images.split(",")[0];
                var price_content   = '';
                if (discount_value == 0) {
                    price_content = `<div class="prodcut-price"> <div class="text-gray-100">${View.formatNumber(product_value.prices)+"đ"}</div> </div>`
                }else{
                    price_content = `<div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                        <ins class="font-size-20 text-red text-decoration-none mr-2">${View.formatNumber(product_value.prices - (product_value.prices*discount_value/100))+"đ"}</ins>
                                        <del class="font-size-12 tex-gray-6 position-absolute bottom-100">${View.formatNumber(product_value.prices)+"đ"}</del>
                                    </div>`
                } 
                $("#new-arrivals ul").append(`
                    <li class="col-6 col-wd-3 col-md-4 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="/category?tag=${product_value.category_id}" class="font-size-12 text-gray-5">${product_value.category_name}</a></div>
                                    <h5 class="mb-1 product-item__title"><a href="/product/${product_value.slug}?id=${product_value.id}" class="text-blue font-weight-bold">${product_value.name}</a></h5>
                                    <div class="mb-2">
                                        <a href="/product/${product_value.slug}?id=${product_value.id}" class="d-block text-center rect-1-1 block-image">
                                            <img class="img-fluid rect-1-1 lazy-load" src="" data-src="/${image}" alt="${product_value.search_name}">
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                            ${price_content} 
                                        </div>
                                        <div class="prodcut-add-cart">
                                            <div class="btn-add-cart btn-primary transition-3d-hover action-add-to-card" data-id="${product_value.id}" atr="Add to card">
                                                ${cards.includes(product_value.id+"") ? `<i class="fas fa-check"></i>` : `<i class="ec ec-add-to-cart"></i>`}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </li>
                `)
            })
        },
        renderDiscountProducts(data){
            var cards = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");
            data.map(v => {
                var product_value   = v.data_product;
                var discount_value  = v.data_discount;
                var image           = product_value.images.split(",")[0];
                var price_content   = '';
                if (discount_value == 0) {
                    price_content = `<div class="prodcut-price"> <div class="text-gray-100">${View.formatNumber(product_value.prices)+"đ"}</div> </div>`
                }else{
                    price_content = `<div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                        <ins class="font-size-20 text-red text-decoration-none mr-2">${View.formatNumber(product_value.prices - (product_value.prices*discount_value/100))+"đ"}</ins>
                                        <del class="font-size-12 tex-gray-6 position-absolute bottom-100">${View.formatNumber(product_value.prices)+"đ"}</del>
                                    </div>`
                } 
                $("#discount-arrivals ul").append(`
                    <li class="col-6 col-wd-3 col-md-4 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="/category?tag=${product_value.category_id}" class="font-size-12 text-gray-5">${product_value.category_name}</a></div>
                                    <h5 class="mb-1 product-item__title"><a href="/product/${product_value.slug}?id=${product_value.id}" class="text-blue font-weight-bold">${product_value.name}</a></h5>
                                    <div class="mb-2">
                                        <a href="/product/${product_value.slug}?id=${product_value.id}" class="d-block text-center rect-1-1 block-image">
                                            <img class="img-fluid rect-1-1 lazy-load" src="" data-src="/${image}" alt="${product_value.search_name}">
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                            ${price_content} 
                                        </div>
                                        <div class="prodcut-add-cart">
                                            <div class="btn-add-cart btn-primary transition-3d-hover action-add-to-card" data-id="${product_value.id}" atr="Add to card">
                                                ${cards.includes(product_value.id+"") ? `<i class="fas fa-check"></i>` : `<i class="ec ec-add-to-cart"></i>`}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </li>
                `)
            })
        },
        renderBestDeal(data){
            var image           = data.images.split(",")[0];
            $(".best-deal").find(".data-discount").text(`- ${data.discount_percent}%`);
            $(".best-deal").find(".data-product").attr("href", `/product/${data.slug}?id=${data.id}`);
            $(".best-deal").find(".data-product img").attr("src", `/${image}`);
            $(".best-deal").find(".data-name").attr("href", `/product/${data.slug}?id=${data.id}`);
            $(".best-deal").find(".data-name").text(data.name);
            $(".best-deal").find(".data-prices").text(View.formatNumber(data.prices)+"đ");
            $(".best-deal").find(".data-sale").text(View.formatNumber(data.prices - (data.prices*data.discount_percent/100))+"đ");
            let countDownDate = new Date(data.discount_time_end).getTime(); 

            let interval = setInterval(function() {
                let now = new Date(); 
                let distance = countDownDate - now - (1000 * 60 * 60 * 7);
                if (!(countDownDate > 0) || distance < 0) {
                    clearInterval(interval);
                    $(".data-countdown").find(".js-cd-days").text("-")
                    $(".data-countdown").find(".js-cd-hours").text("-")
                    $(".data-countdown").find(".js-cd-minutes").text("-")
                    $(".data-countdown").find(".js-cd-seconds").text("-")
                } else {
                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = (days * 24) + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    $(".data-countdown").find(".js-cd-days").text(days)
                    $(".data-countdown").find(".js-cd-hours").text(hours < 10 ? `0${hours}` : hours)
                    $(".data-countdown").find(".js-cd-minutes").text(minutes < 10 ? `0${minutes}` : minutes)
                    $(".data-countdown").find(".js-cd-seconds").text(seconds < 10 ? `0${seconds}` : seconds) 
                }
            }, 1000);
        },
        renderQuickDiscount(data){
            var cards = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");
            data.map(v => { 
                var image           = v.images.split(",")[0];
                var price_content   = '';
                if (v.discount_percent == 0) {
                    price_content = `<div class="prodcut-price"> <div class="text-gray-100">${View.formatNumber(v.prices)+"đ"}</div> </div>`
                }else{
                    price_content = `<div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                        <ins class="font-size-20 text-red text-decoration-none mr-2">${View.formatNumber(v.prices - (v.prices*v.discount_percent/100))+"đ"}</ins>
                                        <del class="font-size-12 tex-gray-6 position-absolute bottom-100">${View.formatNumber(v.prices)+"đ"}</del>
                                    </div>`
                } 
                $("#quick-discount")
                    .append(`<div class="js-slide products-group">
                                <div class="product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="/category?tag=${v.category_id}" class="font-size-12 text-gray-5">${v.category_name}</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="/product/${v.slug}?id=${v.id}" class="text-blue font-weight-bold">${v.name}</a></h5>
                                                <div class="mb-2">
                                                    <a href="/product/${v.slug}?id=${v.id}" class="d-block text-center block-image">
                                                        <img class="img-fluid lazy-load" src="" data-src="/${image}" alt="${v.search_name}">
                                                    </a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                                        ${price_content} 
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <div class="btn-add-cart btn-primary transition-3d-hover action-add-to-card" data-id="${v.id}" atr="Add to card">
                                                            ${cards.includes(v.id+"") ? `<i class="fas fa-check"></i>` : `<i class="ec ec-add-to-cart"></i>`}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>`)
            })
            $.HSCore.components.HSSlickCarousel.init('#quick-discount');
        },
        renderTrending(data){
            data.map(v => {
                var image           = v.images.split(",")[0];
                var real_prices     = View.formatNumber(v.discount == 0 ? v.prices : v.prices - (v.prices*v.discount/100));
                $("#trending-carousel").append(`
                    <div class="js-slide bg-img-hero-center">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8"> 
                                <h6 class="font-size-15 font-weight-bold mb-3"
                                    data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="200">${v.name}
                                </h6>
                                <div class="mb-4"
                                    data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="300">
                                    <span class="font-size-13">Giá từ</span>
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">đ</sup>${View.formatNumber(v.prices)}
                                    </div>
                                </div>
                                <a href="/product/${v.slug}?id=${v.id}" class="btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                    data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="400">
                                    Xem sản phẩm
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center flex-end"
                                data-scs-animation-in="zoomIn"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" style="max-width: 350px" src="${image}" alt="Image Description">
                            </div>
                        </div>
                    </div>`)
            })
            $.HSCore.components.HSSlickCarousel.init('#trending-carousel');
        }, 
        RecentlyProduct(data){
            var cards = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");
            data.map(v => {
                var image           = v.images.split(",")[0];
                var real_prices     = View.formatNumber(v.discount == 0 ? v.prices : v.prices - (v.prices*v.discount/100));
                $("#recently-viewed-list").append(`
                    <li class="col-6 col-wd-2 col-md-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"></div>
                                    <h5 class="mb-1 product-item__title"><a href="/product/${v.slug}?id=${v.id}" class="text-blue font-weight-bold">${v.name}</a></h5>
                                    <div class="mb-2">
                                        <a href="/product/${v.slug}?id=${v.id}" class="d-block text-center rect-1-1">
                                            <img class="img-fluid rect-1-1" src="/${image}" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                                            ${v.discount == 0 
                                                ?  `<div class="text-gray-100">${View.formatNumber(v.prices)+"đ"}</div>`
                                                :   `<ins class="font-size-20 text-red text-decoration-none mr-2">${View.formatNumber(v.prices)+"đ"}</ins>
                                                    <del class="font-size-12 tex-gray-6 position-absolute bottom-100"> - ${View.formatNumber(v.prices*v.discount/100)} đ </del>`
                                            }
                                        </div>
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <div class="btn-add-cart btn-primary transition-3d-hover action-add-to-card" data-id="${v.id}" atr="Add to card">
                                                ${cards.includes(v.id+"") ? `<i class="fas fa-check"></i>` : `<i class="ec ec-add-to-cart"></i>`}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </li>
                `)
            })
        },
    },
    Category: { 
        render_top(data){ 
            data.map((v, k) => {
                if (k == 0) {
                    $('.category-list-tab').attr("id-select", v.id)
                }
                $('.category-list-tab').append(`
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1 category-tab-select" data-id="${v.category.id}">
                        <a class="nav-link ${k == 0 ? "active" : ""} " id="Tpills-one-${v.category.id}-tab" data-toggle="pill" href="#Tpills-tab-${v.category.id}" role="tab" aria-controls="#Tpills-tab-${v.category.id}" aria-selected="true">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                ${v.category.name}
                            </div>
                        </a>
                    </li>
                `)
            })
        }, 
    },
    formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },
    init(){

    }
};
(() => {
    View.init()
    function init(){
        // getCategory();
        getTrending();
        getNewArrivals();
        getDiscountProducts();
        getBestDiscount();
        getQuickDiscount();
        // getViewed();
        $(document).on('click', `.category-tab-select`, function() {
            getItemCategory($(this).attr('data-id'));
        });
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
 
    function getViewed(){
        if (localStorage.getItem("view") == null) {
            $(".item-viewed").css({ "display": "none"})
        }else{
            var history = localStorage.getItem("view").split(",");
            var qty = [];
            for (var i = history.length-1; i >= 0; i--) {
                if (qty.length < 6) {
                    qty.push(history[i])
                }
            }
            Api.Product.GetRecently(qty.toString())
                .done(res => { 
                    View.Product.RecentlyProduct(res.data);
                })
                .fail(err => {  })
                .always(() => { });
        }
    }
    function getTrending(){
        Api.Product.Trending()
            .done(res => {
                View.Product.renderTrending(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getNewArrivals(){
        Api.Product.NewArrivals()
            .done(res => {
                View.Product.renderNewArrivals(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getDiscountProducts(){
        Api.Product.DiscountProducts()
            .done(res => { 
                View.Product.renderDiscountProducts(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getBestDiscount(){
        Api.Product.getBestDiscount()
            .done(res => {
                View.Product.renderBestDeal(res.data)
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getQuickDiscount(){
        Api.Product.getQuickDiscount()
            .done(res => {
                View.Product.renderQuickDiscount(res.data)
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getCategory(){
        Api.Category.GetAll()
            .done(res => { 
                View.Category.render_top(res.data);
                // res.data.map(v => {
                //     getItemCategory(v.category);
                // })
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getItemCategory(category_item){
        Api.Product.GetItemCategory(category_item.id)
            .done(res => {
                View.Category.render_item2(category_item, res.data.product, res.data.type);
            })
            .fail(err => {  })
            .always(() => { });
    }
    init()
})();
