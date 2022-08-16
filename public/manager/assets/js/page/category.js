const View = {
    table: {
        __generateDTRow(data){ 
            return [
                `<div class="id-order">${data.id}</div>`,
                data.name,  
                `<img src="/${data.image}" style="width:100px" alt="">`,  
                JSON.parse(data.metadata).data.map(v => {
                    return `<span class="badge badge-pill badge-blue m-r-10 m-b-10"> ${v}</span>`
                }).join(""),
                `<div class="view-data modal-control" style="cursor: pointer" atr="Update" data-id="${data.id}"><i class="anticon anticon-edit"></i></div>
                <div class="view-data modal-control" style="cursor: pointer" atr="Delete" data-id="${data.id}"><i class="anticon anticon-delete"></i></div>`
            ]
        },
        init(){
            var row_table = [
                    {
                        title: 'ID',
                        name: 'id',
                        orderable: true,
                        width: '10%',
                    },
                    {
                        title: 'Tên',
                        name: 'name',
                        orderable: true,
                        width: '10%',
                    },  
                    {
                        title: 'Hình ảnh',
                        name: 'image',
                        orderable: true,
                        width: '10%',
                    },  
                    {
                        title: 'Thuộc tính',
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
    Metadata: {
        getVal(resource){
            var data_return = JSON.parse(`{ "data": [] }`); 
            var list_metadata = $( `${resource} .meta-item` ); 
            list_metadata.each(function( index ) {
                var father = $(this);
                var data_name       = father.find(".data-meta-name").val();  
                if (data_name) data_return.data.push(data_name); 
            });
            return [
                JSON.stringify(data_return)
            ];
        },
        setVal(resource, value_input){
            $(`${resource} .metadata-group`).append(`
                <div class="meta-item m-b-10">    
                    <input type="text" class="col-md-9 form-control data-meta-name" placeholder="Tên thuộc tính" value="${value_input}"> 
                    <button class="col-md-2 btn btn-danger metadata-remove" atr="Delete">X</button>  
                </div>   
            `);
        },
        Create(resource){
            $(`${resource} .metadata-group`).append(`
                <div class="meta-item m-b-10">    
                    <input type="text" class="col-md-9 form-control data-meta-name" placeholder="Tên thuộc tính"> 
                    <button class="col-md-2 btn btn-danger metadata-remove" atr="Delete">X</button>  
                </div>   
            `);
        },
        onCreate(resource, name){
            $(document).on('click', `${resource} .metadata-create`, function() {
                if($(this).attr('atr').trim() == name) {
                    View.Metadata.Create(resource);
                }
            });
        },
        onRemove(resource, name){
            $(document).on('click', `${resource} .metadata-remove`, function() {
                if($(this).attr('atr').trim() == name) {
                    $(this).parent().parent().parent().remove();
                }
            });
        },
        clear(resource){
            $(`${resource} .metadata-group`).find('.meta-item').remove()
        }
    },
    SideModal: {
        Create: {
            resource: '#side-modal-create',
            setDefaul(){ this.init();  },
            setVal(data){ },
            getVal(){
                var resource = this.resource;
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;
 
                var data_name      = $(`${resource}`).find('.data-name').val();    
                var data_image     = $(".data-image")[0].files;
                var data_metadata  = View.Metadata.getVal(this.resource);

                if (data_image.length <= 0  ) { required_data.push('Hãy chọn hình ảnh.'); onPushData = false }
                if (data_name == '') { required_data.push('Hãy nhập tên.'); onPushData = false }

                if (onPushData) { 
                    fd.append('data_name', data_name);  
                    fd.append('data_metadata', data_metadata);  
                    fd.append('data_image', data_image[0]);  
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
                var modalBodyHTML   = Template.Category.Create();
                var modalFooterHTML = ['Đóng', 'Tạo mới'];

                IndexView.SideModal.launch(this.resource, modalTitleHTML, modalBodyHTML, modalFooterHTML);
            }
        },
        Update: {
            resource: '#side-modal-update',
            setDefaul(){ this.init();  },
            setVal(data){   
                var resource = this.resource; 
                $(`${resource} .data-id`).val(data[0].id) 
                $(`${resource}`).find('.data-name').val(data[0].name);     
                $(`${resource}`).find('.form-preview').css({ "background-image": `url('/${data[0].image}')`})
                JSON.parse(data[0].metadata).data.map(v => {
                    View.Metadata.setVal(resource, v);
                }) 
            },
            getVal(){
                var resource = this.resource;
                var fd = new FormData();
                var required_data = [];
                var onPushData = true;

                var data_id      = $(`${resource}`).find('.data-id').val();
                var data_name      = $(`${resource}`).find('.data-name').val();    
                var data_image     = $(".data-image")[0].files;
                var data_metadata  = View.Metadata.getVal(this.resource);

                if (data_name == '') { required_data.push('Hãy nhập tên.'); onPushData = false }

                if (onPushData) {
                    fd.append('data_id', data_id); 
                    fd.append('data_name', data_name); 
                    fd.append('data_image', data_image[0] ?? "null");
                    fd.append('data_metadata', data_metadata);  
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
                var modalBodyHTML   = Template.Category.Update();
                var modalFooterHTML = ['Đóng', 'Cập nhật'];

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
                var modalTitleHTML = `Xóa`;
                var modalBodyHTML  = Template.Category.Delete();
                var modalFooterHTML = ['Đóng', 'Xóa'];
                IndexView.SideModal.launch(this.resource, modalTitleHTML, modalBodyHTML, modalFooterHTML);
            }
        },
        init(){
            View.SideModal.Create.init(); 
            View.SideModal.Update.init(); 
            View.SideModal.Delete.init(); 
        }
    },
    init(){
        View.table.init();
        View.SideModal.init();
        View.Metadata.onCreate("#side-modal-create", "Create");
        View.Metadata.onRemove("#side-modal-create", "Delete");
        View.Metadata.onCreate("#side-modal-update", "Create");
        View.Metadata.onRemove("#side-modal-update", "Delete");
    }
};
(() => {
    View.init();


    IndexView.SideModal.onControl("Create", () => {
        var resource = View.SideModal.Create.resource;
        IndexView.SideModal.onShow(resource);
        View.SideModal.Create.onPush("Push", (fd) => {
            IndexView.helper.showToastProcessing('Processing', 'Đang tạo!');
            IndexView.SideModal.onHide(resource)
            Api.Category.Store(fd)
                .done(res => {
                    IndexView.helper.showToastSuccess('Success', 'Tạo thành công !');
                    getData();
                })
                .fail(err => { IndexView.helper.showToastError('Error', 'Có lỗi sảy ra'); })
                .always(() => { });
            View.SideModal.Create.setDefaul();
        })
    })
    IndexView.SideModal.onControl("Update", (id) => {
        var resource = View.SideModal.Update.resource;
        IndexView.SideModal.onShow(resource); 
        Api.Category.getOne(id)
            .done(res => {  
                View.SideModal.Update.setVal(res.data); 
                View.SideModal.Update.onPush("Push", (fd) => {
                    IndexView.helper.showToastProcessing('Processing', 'Đang cập nhật!');
                    Api.Category.Update(fd)
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
    IndexView.SideModal.onControl("Delete", (id) => {
        var resource = View.SideModal.Delete.resource;
        IndexView.SideModal.onShow(resource);
        View.SideModal.Delete.onPush("Push", () => {
            IndexView.helper.showToastProcessing('Processing', 'Đang xóa!');
            Api.Category.Delete(id)
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
        Api.Category.GetAll()
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
