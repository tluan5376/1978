const View = {
    Description: {
        render(data){
            var cards = localStorage.getItem("card") == null ? "" : localStorage.getItem("card").split(",");

            var product_value   = data.data_product;
            var discount_value  = data.data_discount;

            var price_content   = '';
            if (discount_value == 0) {
                price_content = `<div class="d-flex align-items-baseline">
                                        <ins class="font-size-36 text-decoration-none">${View.formatNumber(product_value.prices)+"đ"}</ins>
                                    </div>`
            }else{
                price_content = ` <div class="d-flex align-items-baseline">
                                        <ins class="font-size-36 text-decoration-none">${View.formatNumber(product_value.prices - (product_value.prices*discount_value/100))+"đ"}</ins>
                                        <del class="font-size-20 ml-2 text-gray-6">${View.formatNumber(product_value.prices)+"đ"}</del>
                                    </div>`
            }   

            $(".action-add-to-card").attr("data-id", product_value.id)
            if (cards.includes(product_value.id+"")) {
                $(".action-add-to-card").html("✔ đã thêm")
                $(".action-add-to-card").removeClass("action-add-to-card")
            }else{
                $(".action-add-to-card").html("+ Giỏ hàng")
            }
            
            $(".product-prices").append(price_content)
            $(".action-add-to-card").attr("data-id", product_value.id) 

            $(".category-name").text(product_value.category_name)
            $(".category-name").attr("href", `/category?tag=${product_value.category_id}`)
            $(".category-image").attr("src", `/${product_value.category_image}`);

            $(".product-name").text(product_value.name); 

            product_value.description
                .split("<br />").map(v => {
                    $(".product-description")
                        .append(`<li>${v}</li>`)
                })  
            
            $(".data-warehouse").html(product_value.warehouse_quatity ? product_value.warehouse_quatity + " sản phẩm" : `<span class="text-red">Hết hàng</span>`)
            $(".product-detail").html(product_value.detail)

            var metadata = JSON.parse(product_value.metadata); 
            metadata.data.map(value => {
                $(".metadata-list").append(`
                    <tr>
                        <th class="px-4 px-xl-5 border-top-0">${Object.keys(value)}</th>
                        <td class="border-top-0">${Object.values(value)}</td>
                    </tr>
                `)
            })
        }
    },
    Images: {
        render_list(data){
            data.split(",").map((value, key) => {
                $("#sliderSyncingNav").append(`
                    <div class="js-slide">
                        <img class="img-fluid" src="/${value}" alt="Image Description">
                    </div>
                `)
                $("#sliderSyncingThumb").append(`
                    <div class="js-slide" style="cursor: pointer;">
                        <img class="img-fluid" src="/${value}" alt="Image Description">
                    </div>
                `)
            })
            $.HSCore.components.HSSlickCarousel.init('#sliderSyncingThumb');
            $.HSCore.components.HSSlickCarousel.init('#sliderSyncingNav');
        }
    },
    RecentlyProduct: {
        render(data){
            data.map(v => {
                var image           = v.images.split(",")[0];
                var real_prices     = View.formatNumber(v.discount == 0 ? v.prices : v.prices - (v.prices*v.discount/100));
                $(".recently-products-list").append(`
                    <div class="landscape-product product">
                        <a class="woocommerce-LoopProduct-link" href="/product?id=${v.id}">
                            <div class="media">
                                <img class="wp-post-image" src="/${image}" alt="">
                                <div class="media-body">
                                    <span class="price">
                                        <del>
                                            <span class="amount">${v.discount == 0 ? "" : View.formatNumber(v.prices)+"đ"}</span>
                                        </del>
                                        <span class="amount">${real_prices}</span>
                                    </span>
                                    <h2 class="woocommerce-loop-product__title">${v.name}</h2>
                                    <div class="techmarket-product-rating">
                                        <div title="Rated 0 out of 5" class="star-rating">
                                            <span style="width:0%">
                                                <strong class="rating">0</strong> out of 5</span>
                                        </div>
                                        <span class="review-count">(0)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                `)
            })  
        }
    },
    RelatedProduct: {
        render(data){
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
                $(".related-products-list").append(`
                   <li class="col-6 col-wd-2 col-md-2 product-item">
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
        }
    },
    isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    },
    formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },
    URL: {
        get(id){
            var urlParam    = new URLSearchParams(window.location.search);
            return urlParam.get(id)
        }
    },
    Comment:{
        setDefaul(){
            var data_comment      = $(`#comment`).val("");
        },
        changeText(status){
            $(".comment-submit").html(status ? `<i class="fas fa-spinner"></i>` : "Thêm đánh giá")
        },
        getVal(){
            var fd = new FormData();
            var required_data = [];
            var data_comment      = $(`#comment`).val();
            var data_product      = View.URL.get("id");
            var data_rate         = $("[name=rating2]:checked").val() ?? 0;
            fd.append('data_comment', data_comment);
            fd.append('data_rate', data_rate);
            fd.append('data_product', data_product);
            return fd;
        },
        onPush(name, callback){
            $(document).on('click', `.comment-submit`, function() {
                View.Comment.changeText(1);
                if($(this).attr('atr').trim() == name) {
                    var data = View.Comment.getVal();
                    callback(data);
                }
            });
        },
        onRender(data){
            $(".commentlist .comment-item").remove()
            data.map(v => {
                var rating_data = "";
                for (var i = 0; i < v.rating; i++) {
                    rating_data += `<small class="fas fa-star"></small>`
                }
                $(".commentlist")
                    .append(`
                        <div id="li-comment-${v.id}" class="border-bottom comment-item border-color-1 pb-4 mb-4"> 
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    ${rating_data}
                                </div>
                            </div>
                            <p class="text-gray-90">${v.comment ?? ""}</p>
                            <div class="mb-2">
                                <strong>${v.name}</strong>
                                <span class="font-size-13 text-gray-23">${v.created_at}</span>
                            </div>
                        </div>`)
            })
            
        },
        onRenderRate(product, data_rate){

            $(".avg-rating-number").html(`Trung bình: ${Math.round(product.equal_rate * 100) / 100 ?? 0}`) 
            $(".count-rate").html(`${product.count_rate ?? 0} Đánh giá`)

            var array_count_rate = [];
            data_rate.map(v => array_count_rate[v.rating] = v.count);
            for (var i = 5; i >= 1; i--) { 
                $(".rate-list-data")
                    .append(`<div class="py-1">
                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                    <div class="col-auto mb-2 mb-md-0">
                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                            ${i}<small class="fas fa-star ml-2"></small> 
                                        </div>
                                    </div>
                                    <div class="col-auto mb-2 mb-md-0">
                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                            <div class="progress-bar" role="progressbar" style="width:${((array_count_rate[i] ?? 0) / product.count_rate) * 100}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-right">
                                        <span class="text-gray-90">${array_count_rate[i] ?? 0}</span>
                                    </div>
                                </a>
                            </div>`)
            }
        },
        onSuccess(){
            $("#commentform").prepend(`<span class="label label-success">Đánh giá thành công</span>`)
            setTimeout(function() {
                $("#commentform .label").remove()
            }, 2000);
        },
    },
    init(){
        $(document).on('keypress', `.product-quantity`, function(event) {
            return View.isNumberKey(event);
        });
        $("#basicsHeadingOne button").click()
    }
};
(() => {
    View.init()
    function init(){
        getProduct();
        // getRecentlyProduct(); 
        getRelatedProduct();
        getComment();
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
    function delay(f, timeout) {
        let timeoutID = null;
        return function(...args) {
            clearTimeout(timeoutID);
            timeoutID = setTimeout(() => {
                f(...args);
            }, timeout);
        }
    }

    View.Comment.onPush("Comment Submit", delay((fd) => {
        Api.Comment.Create(fd)
            .done(res => {
                View.Comment.changeText(0);
                View.Comment.onSuccess();
                View.Comment.setDefaul();
                getComment();
            })
            .fail(err => {  })
            .always(() => { })   
    }, 1000))

    function getComment(){
        Api.Comment.GetAll(View.URL.get("id"))
            .done(res => {
                View.Comment.onRender(res.data)
            })
            .fail(err => {  })
            .always(() => { });
    } 


    function getProduct(){
        var history = localStorage.getItem("view") == null ? [] : localStorage.getItem("view").split(",");
        var item_id = View.URL.get("id"); 
        history = history.filter(function(ele){  return ele != item_id;  }) 
        history.push(View.URL.get("id"))
        localStorage.setItem("view", history);
        Api.Product.GetOne(View.URL.get("id"))
            .done(res => {
                View.Images.render_list(res.data.data_product.images);
                View.Description.render(res.data);
                View.Comment.onRenderRate(res.data.data_product[0], res.data.data_rate)
            })
            .fail(err => {  })
            .always(() => { });
    }
    function getRecentlyProduct(){
        Api.Product.GetRecently(View.Auth.get())
            .done(res => {
                View.RecentlyProduct.render(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    } 
    function getRelatedProduct(){
        Api.Product.GetRelated(View.URL.get("id"))
            .done(res => {
                View.RelatedProduct.render(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    } 
    init()
})();
