const View = {
    table: {
        __generateDTRow(data){ 
            return [
                `<div class="id-order">${data.id}</div>`,
                data.name,  
                `${IndexView.Config.formatPrices(data.prices)} đ`,  
                `${data.percent} %`,  
                data.discount_created_at,  
                data.time_end == "null" ? "Vô thời hạn" : data.time_end,  
                data.discount_status == 0 ? `<span class="badge badge-pill badge-red">Đã ngừng</span>` :  `<span class="badge badge-pill badge-green">Đang hoạt động</span>` , 
                `<a class="view-data " style="cursor: pointer" target="_blank" href="/product/${data.id}-${data.slug}"><i class="anticon anticon-eye"></i></a>
                ${data.discount_status == 0 ? `` :  `<div class="view-data modal-control" style="cursor: pointer" atr="Delete" data-id="${data.id}"><i class="anticon anticon-delete"></i></div>`}` ,  
                
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
                        title: 'Đơn giá',
                        name: 'name',
                        orderable: true,
                        width: '10%',
                    },   
                    {
                        title: 'Giảm giá',
                        name: 'metadata',
                        orderable: true,
                    },  
                    {
                        title: 'Thời gian tạo',
                        name: 'metadata',
                        orderable: true,
                    },  
                    {
                        title: 'Thời gian kết thúc',
                        name: 'metadata',
                        orderable: true,
                    },  
                    {
                        title: 'Trạng thái',
                        name: 'metadata',
                        orderable: true,
                    },  
                    {
                        title: 'Hành động',
                        name: 'Action',
                        orderable: true,
                        width: '10%',
                    },
                ];
            IndexView.table.init("#data-table", row_table);
        }
    },  
    SideModal: {
        Create: {
            resource: '#side-modal-create',
            setDefaul(){ this.init();  },
            setVal(data){
                var resource = this.resource; 
                $(`${resource}`).find('.data-category option').remove()
                data.map(v => {
                    if (v.data_discount == 0) {
                        $(`${resource}`)
                            .find('.data-category')
                            .append(`<option value="${v.data_product.id}">${v.data_product.id}-${v.data_product.name}</option>`);
                    }
                })
            },
            onTypeChange(resource, callback){
                $(document).on('change', `${resource} .data-type`, function() {
                    callback($(this).val());
                });
            },
            createDate(){
                $(".discount-form")
                    .append(`<div class="form-group">
                                <label >Thời gian kết thúc</label>
                                <input class="form-control data-time_end" type="date" placeholder="" required="">
                            </div> `)
            },
            removeDate(){
                $(".data-time_end").parent().remove();
            },
            getVal(){
                var resource = this.resource;
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;
 
                var data_category       = $(`${resource}`).find('.data-category').val(); 
                var data_percent        = $(`${resource}`).find('.data-percent').val();  
                var data_type           = $(`${resource}`).find('.data-type').val();  
                var data_time_end       = $(`${resource}`).find('.data-time_end').val();   
                if (data_percent == '') { required_data.push('Hãy nhập mức giảm giá.'); onPushData = false }
                if (data_type == '1') { 
                    if (!data_time_end) {required_data.push('Hãy nhập thời gian kết thúc.'); onPushData = false}
                }
                if (onPushData) { 
                    fd.append('data_category', data_category);  
                    fd.append('data_percent', data_percent);   
                    fd.append('data_type', data_type);   
                    fd.append('data_time_end', data_time_end ?? null);   
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
                        var data = View.SideModal.Create.getVal();
                        if (data) callback(data);
                    }
                });
            },
            init(){
                var modalTitleHTML  = `Tạo mới`;
                var modalBodyHTML   = Template.Discount.Create();
                var modalFooterHTML = ['Đóng', 'Tạo mới'];

                IndexView.SideModal.launch(this.resource, modalTitleHTML, modalBodyHTML, modalFooterHTML);
            }
        }, 
        Delete: {
            resource: '#side-modal-delete',
            setDefaul(){ this.init(); },
            textDefaul(){ },
            setVal(data){ },
            getVal(){
            },
            onPush(name, callback){
                var resource = this.resource;
                $(document).on('click', `${this.resource} .push-modal`, function() {
                    if($(this).attr('atr').trim() == name) {
                        callback($(this).attr('data-id'));
                    }
                });
            },
            init() {
                var modalTitleHTML = `Ngừng giảm giá ngay`;
                var modalBodyHTML  = Template.Category.Delete();
                var modalFooterHTML = ['Đóng', 'Ngừng giảm giá'];
                IndexView.SideModal.launch(this.resource, modalTitleHTML, modalBodyHTML, modalFooterHTML);
            }
        },
        init(){
            View.SideModal.Create.init();  
            View.SideModal.Delete.init(); 
        }
    },
    init(){
        View.table.init();
        View.SideModal.init(); 
    }
};
(() => {
    View.init();


    IndexView.SideModal.onControl("Create", () => {
        var resource = View.SideModal.Create.resource;
        IndexView.SideModal.onShow(resource);
        Api.Discount.GetDiscount()
            .done(res => {
                View.SideModal.Create.setVal(res.data)
            })
            .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
            .always(() => { });


        View.SideModal.Create.onPush("Push", (fd) => {
            IndexView.helper.showToastProcessing('Processing', 'Đang tạo!');
            IndexView.SideModal.onHide(resource)
            Api.Discount.Store(fd)
                .done(res => {
                    IndexView.helper.showToastSuccess('Success', 'Tạo thành công !');
                    getData();
                })
                .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
                .always(() => { });
            View.SideModal.Create.setDefaul();
        })
    }) 
    View.SideModal.Create.onTypeChange(View.SideModal.Create.resource, (id) => {
        id == 0 ? View.SideModal.Create.removeDate() : View.SideModal.Create.createDate()
    })


    IndexView.SideModal.onControl("Delete", (id) => {
        var resource = View.SideModal.Delete.resource;
        IndexView.SideModal.onShow(resource);
        View.SideModal.Delete.onPush("Push", () => {
            IndexView.helper.showToastProcessing('Processing', 'Đang xóa!');
            Api.Discount.Delete(id)
                .done(res => {
                    IndexView.helper.showToastSuccess('Success', 'Xóa thành công !');
                    getData();
                })
                .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
                .always(() => { });
            IndexView.SideModal.onHide(resource)
            View.SideModal.Delete.setDefaul();
        })
    })  


    function init(){
        getData();
    }
    function getData(){
        Api.Discount.GetAll()
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
