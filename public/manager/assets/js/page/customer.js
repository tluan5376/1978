const View = {
    Category: [],
    table: {
        __generateDTRow(data){ 
            return [
                `<div class="id-order">${data.id}</div>`,
                data.username,
                data.email,  
                data.telephone,  
                data.address,  
                `<label class="switch" data-id="${data.id}" data-status="${data.view_type == '1' ? '0' : '1'}" atr="Status"> <span class="slider round ${data.view_type == '1' ? 'active' : ''}"></span> </label>`, 
            ]
        },
        init(){
            var row_table = [
                {
                    title: 'ID',
                    name: 'id',
                    orderable: true,
                    width: '5%',
                },
                {
                    title: 'Tên',
                    name: 'name',
                    orderable: true, 
                },
                {
                    title: 'Email',
                    name: 'name',
                    orderable: true, 
                },
                {
                    title: 'Địa chỉ',
                    name: 'name',
                    orderable: true, 
                },
                {
                    title: 'Số điện thoại',
                    name: 'name',
                    orderable: true, 
                },  
                {
                    title: 'Khách sỉ',
                    name: 'icon',
                    orderable: true, 
                }, 
            ];
            IndexView.table.init("#data-table", row_table);
        }
    },
    Metadata: {
        getVal(resource){
            var data_return = JSON.parse(`{ "data": [] }`); 
            var list_metadata = $( `${resource} .meta-item` );
            var global_price = 0;
            list_metadata.each(function( index ) {
                var father = $(this);
                var title_meta       = father.find(".data-meta-name").attr("meta-title");
                var value_meta       = father.find(".data-meta-name").val(); 
                data_return.data
                    .push(
                        JSON.parse(`{ "${title_meta}": "${value_meta}" }`)
                    );
            });
            return JSON.stringify(data_return);
        },
        setVal(resource, metadata){
            this.clear(resource);
            JSON.parse(metadata).data.map(v => {
                $(`${resource} .metadata-list`).append(`
                     <div class="col-md-6 meta-item  m-t-5">    
                        <input type="text" class="form-control data-meta-name" meta-title="${v}" placeholder="${v}">  
                    </div>
                `);
            }) 
        },  
        renderVal(resource, metadata){ 
            JSON.parse(metadata).data.map(v => {
                $(`${resource} .data-meta-name[meta-title='${Object.keys(v)}']`).val(Object.values(v))
            })   
        },
        clear(resource){
            $(`${resource} .metadata-list`).find('.meta-item').remove()
        }
    },
    SideModal: { 
        Update: {
            resource: '#side-modal-update',
            setDefaul(){ this.init();  },
            setVal(data){  
                var resource = this.resource; 
                View.Category.map(v => {
                    $(resource)
                        .find(".data-category")
                        .append(`<option value="${v.id}" metadata='${v.metadata}'>${v.name}</option>`)
                })
                $(`${resource} .data-category`).val(data.category_id);
                var metadata = $(resource).find(".data-category").find(":selected").attr("metadata");
                View.Metadata.setVal(resource, metadata); 
                View.Metadata.renderVal(resource, data.metadata);
                $(`${resource} .data-id`).val(data.id) 
                $(`${resource}`).find('.data-name').val(data.name);  
                $(`${resource}`).find('.data-prices').val(data.prices);  
                $(`${resource}`).find('.data-defaul_prices').val(data.defaul_prices);  
                data.images == "" ? null : IndexView.multiImage.setVal(data.images);  
                $(`${resource}`).find('.data-description').val(IndexView.Config.toNoTag(data.description));  
                IndexView.summerNote.update(`${resource} .data-detail`, data.detail); 
            },
            getVal(){
                var resource = this.resource;
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var data_id             = $(`${resource}`).find('.data-id').val();
 
                
                var data_name           = $(`${resource}`).find('.data-name').val();   
                var data_images         = $(`${resource}`).find(".image-list")[0].files; 
                var data_prices         = $(`${resource}`).find('.data-prices').val(); 
                var data_prices         = $(`${resource}`).find('.data-prices').val(); 
                var data_defaul_prices         = $(`${resource}`).find('.data-defaul_prices').val(); 
                var data_category       = $(`${resource}`).find('.data-category').val(); 
                var data_meta           = View.Metadata.getVal(resource);
                var data_description    = $(`${resource}`).find('.data-description').val();
                var data_detail         = $(`${resource}`).find('.data-detail').val();

                var data_images_preview = [];
                $(`${resource}`).find('.image-preview-item.image-load-data').each(function(index, el) { 
                    data_images_preview.push($(this).attr("data-url"));
                });
 
                if (data_name == '') { required_data.push('Hãy nhập tên.'); onPushData = false } 
                if (data_description == '') { required_data.push('Nhập mô tả ngắn.'); onPushData = false } 
                if (data_detail == '') { required_data.push('Nhập mô tả đầy đủ.'); onPushData = false }  
                if (data_prices == '') { required_data.push('Hãy nhập giá sản phẩm.'); onPushData = false }

                if (onPushData) {
                    fd.append('data_id', data_id);  
                    fd.append('data_name', data_name);   
                    fd.append('data_category', data_category);  
                    fd.append('data_prices', data_prices);  
                    fd.append('data_description', data_description); 
                    fd.append('data_detail', data_detail); 
                    fd.append('data_meta', data_meta);  
                    fd.append('data_defaul_prices', data_defaul_prices); 
                    fd.append('data_images_preview', data_images_preview.toString()); 
                    fd.append('image_list_length', data_images.length);
                    for (var i = 0; i < data_images.length; i++) {
                        fd.append('image_list_item_'+i, data_images[i]);
                    }
                    return fd;
                }else{
                    $(`${resource}`).find('.error-log .js-errors').remove();
                    var required_noti = ``;
                    for (var i = 0; i < required_data.length; i++) { required_noti += `<li class="error">${required_data[i]}</li>`; }
                    $(`${resource}`).find('.error-log').prepend(` <ul class="js-errors">${required_noti}</ul> `)
                    return false;
                }
            },
            onPush(name, callback){
                var resource = this.resource;
                $(document).on('click', `${this.resource} .push-modal`, function() { 
                    if($(this).attr('atr').trim() == name) {
                        var data = View.SideModal.Update.getVal();
                        if (data) callback(data);
                    }
                });
            },
            init(){
                var modalTitleHTML  = `Cập nhật`;
                var modalBodyHTML   = Template.Product.Update();
                var modalFooterHTML = ['Đóng', 'Cập nhật'];

                IndexView.SideModal.launch(this.resource, modalTitleHTML, modalBodyHTML, modalFooterHTML);
                IndexView.summerNote.init(".data-detail", "Mô tả đầy đủ", 400);
            }
        }, 
        onCategoryChange(callback){
            $(document).on('change', `.data-category`, function() {
                callback($(this).find(":selected").attr("metadata"));
            });
        },
        init(){ 
            View.SideModal.Update.init();  
        }
    },
    init(){
        View.table.init();
        View.SideModal.init(); 
    }
};
(() => {
    View.init();
     IndexView.SideModal.onControl("View", (id) => {
        View.SideModal.Update.init(); 
        var resource = View.SideModal.Update.resource;
        View.SideModal.Create.setDefaul();
        IndexView.SideModal.onShow(resource); 

        View.SideModal.onCategoryChange((metadata) => {
            View.Metadata.setVal(resource, metadata)
        })

        Api.Product.getOne(id)
            .done(res => { 
                View.SideModal.Update.setVal(res.data); 
                IndexView.SideModal.onShow(resource);
                View.SideModal.Update.onPush("Push", (fd) => {
                    IndexView.helper.showToastProcessing('Processing', 'Đang cập nhật!');
                    Api.Product.Update(fd)
                        .done(res => {
                            IndexView.helper.showToastSuccess('Success', 'Cập nhật thành công !');
                            getData();
                        })
                        .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
                        .always(() => { });
                        IndexView.SideModal.onHide(resource)
                        View.SideModal.Update.setDefaul();
                })
            })
            .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
            .always(() => { }); 
    })  
    IndexView.table.onSwitch(debounce((item) => {
        Api.Customer.Trending(item.attr('data-id'))
            .done(res => {
                getData()
                item.find('.slider').toggleClass('active');
            })
            .fail(err => {
                console.log(err);
            })
            .always(() => {
            });
    }, 500));


    function init(){
        getData();
    }

    function getData(){
        Api.Customer.GetAll()
            .done(res => {
                IndexView.table.clearRows();
                Object.values(res.data).map(v => {
                    IndexView.table.insertRow(View.table.__generateDTRow(v));
                    IndexView.table.render();
                })
                IndexView.table.render(); 
            })
            .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
            .always(() => { }); 
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
    init();
})();
