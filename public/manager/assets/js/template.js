const Template = {
	Category: {
		Create(){
			return `<div class="error-log"></div>
					<input type="hidden" class="form-control data-id" required="">
					<div class="form-group">
                        <label >Tiêu đề <span class="data-name-return"></span></label>
                        <input type="text" class="form-control data-name" placeholder="Tiêu đề">
                    </div> 
                    <div class="form-group image-select-group">   
                        <div class="form-header">
                            <label>Image</label>
                            <label class="image-select" for="avatar"><i class="fas fa-upload m-r-10"></i>Chọn ảnh</label> 
                        </div>
                        <input type="file" id="avatar" class="image-input data-image" style="display: none;" accept="image/*">
                        <div class="image-wrapper form-preview data-image img-1-1"> </div>
                    </div>
					<div class="form-group">
                        <label >Metadata <span class="data-name-return"></span></label>
                        <div class="metadata-group">

                        </div>
                        <button class="btn btn-primary metadata-create" atr="Create">Thêm thuộc tính</button>
                    </div> `
		}, 
		Update(){
			return `<div class="error-log"></div>
					<input type="hidden" class="form-control data-id" required="">
					<div class="form-group">
                        <label >Tiêu đề <span class="data-name-return"></span></label>
                        <input type="text" class="form-control data-name" placeholder="Tiêu đề">
                    </div> 
                    <div class="form-group image-select-group">   
                        <div class="form-header">
                            <label>Image</label>
                            <label class="image-select" for="avatar-update"><i class="fas fa-upload m-r-10"></i>Chọn ảnh</label> 
                        </div>
                        <input type="file" id="avatar-update" class="image-input data-image" style="display: none;" accept="image/*">
                        <div class="image-wrapper form-preview data-image img-1-1"> </div>
                    </div>
					<div class="form-group">
                        <label >Metadata <span class="data-name-return"></span></label>
                        <div class="metadata-group">

                        </div>
                        <button class="btn btn-primary metadata-create" atr="Create">Thêm thuộc tính</button>
                    </div> `
		}, 
		Delete(){
			return `<div class="wrapper d-flex justify-center"><img src="/manager/images_global/funny.gif" alt=""></div>`
		}
	},
	Product: {
		Create(){
			return `<div class="error-log"></div>
		                <div class="row">
		                    <input type="hidden" class="data-id">
		                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		                        <div class="form-group">
		                            <label >Tên sản phẩm</label>
		                            <input class="form-control data-name" type="text" placeholder="" required="">
		                        </div>
		                        <div class="form-group">
		                            <label>Hình ảnh</label>
		                            <input type="file" class="form-control image-list" id="image-update" name="image"  accept="image/*" multiple="">
		                            <div class="form-preview multi-upload"> </div>
		                        </div> 
		                        <div class="form-group">
		                            <label >Đơn giá</label>
		                            <input class="form-control data-prices number-type" type="text" placeholder="" required="">
		                        </div> 
		                        <div class="form-group">
		                            <label >Giá sỉ</label>
		                            <input class="form-control data-defaul_prices number-type" type="text" placeholder="" required="">
		                        </div> 
		                        <div class="form-group">
		                            <label >Danh mục</label>
		                            <select name="" class="form-control data-category m-b-15" id=""> </select>
		                            <div class="metadata-list row">  

		                            </div>
		                        </div> 
		                    </div> 
		                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		                        <div class="form-group">
		                            <label >Mô tả</label>
		                            <textarea name="" id="" class="form-control data-description" rows="5"></textarea>
		                        </div>
		                        <div class="form-group">
		                            <label >Chi tiết</label>
		                            <textarea class="form-control summernote data-detail" name="" id="" rows="5"></textarea>
		                        </div>
		                    </div>
		                </div>
		            </div>`
		}, 
		Update(){
			return `<input type="hidden" class="form-control data-id" required="">
					<div class="error-log"></div>
		                <div class="row">
		                    <input type="hidden" class="data-id">
		                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		                        <div class="form-group">
		                            <label >Tên sản phẩm</label>
		                            <input class="form-control data-name" type="text" placeholder="" required="">
		                        </div>
		                        <div class="form-group">
		                            <label>Hình ảnh</label>
		                            <input type="file" class="form-control image-list" id="image-update" name="image"  accept="image/*" multiple="">
		                            <div class="form-preview multi-upload"> </div>
		                        </div> 
		                        <div class="form-group">
		                            <label >Đơn giá</label>
		                            <input class="form-control data-prices number-type" type="text" placeholder="" required="">
		                        </div> 
		                        <div class="form-group">
		                            <label >Giá sỉ</label>
		                            <input class="form-control data-defaul_prices number-type" type="text" placeholder="" required="">
		                        </div> 
		                        <div class="form-group">
		                            <label >Danh mục</label>
		                            <select name="" class="form-control data-category m-b-15" id=""> </select>
		                            <div class="metadata-list row">  

		                            </div>
		                        </div> 
		                    </div> 
		                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		                        <div class="form-group">
		                            <label >Mô tả</label>
		                            <textarea name="" id="" class="form-control data-description" rows="5"></textarea>
		                        </div>
		                        <div class="form-group">
		                            <label >Chi tiết</label>
		                            <textarea class="form-control summernote data-detail" name="" id="" rows="5"></textarea>
		                        </div>
		                    </div>
		                </div>
		            </div>`
		}, 
		Delete(){
			return `<div class="wrapper d-flex justify-center"><img src="/manager/images_global/funny.gif" alt=""></div>`
		}
	},
	Discount: {
		Create(){
			return `<div class="error-log"></div>
		                <div class="row">
		                    <input type="hidden" class="data-id">
		                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 discount-form">
		                        <div class="form-group">
		                            <label >Danh mục</label>
		                            <select name="" class="form-control data-category" id=""> </select> 
		                        </div> 
		                        <div class="form-group">
		                            <label >Mức giảm giá</label>
		                            <input class="form-control data-percent number-type" type="text" placeholder="%" required="">
		                        </div>
		                        <div class="form-group">
		                            <label >Phân loại</label>
		                            <select name="" class="form-control data-type" id="">
		                            	<option value="0">Vô thời hạn</option>
		                            	<option value="1">Có thời hạn</option>
		                            </select> 
		                        </div>    
		                    </div>  
		                </div>
		            </div>`
		},  
		Delete(){
			return `<div class="wrapper d-flex justify-center"><img src="/manager/images_global/funny.gif" alt=""></div>`
		}
	},
	Warehouse: {
		Create(){
			return `<div class="row warehouse-modal">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 offset-3">
							<div class="card">
								<div class="card-body">
									<div class="item-list">

									</div>
									<button type="button" class="btn btn-success item-create" atr="Item Create">Tạo mới</button>
								</div>
							</div>
						</div>
	            	</div>`
		},
		Update(){
			return `<div class="row warehouse-modal">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 offset-3">
							<table class="table table-bordered sub-warehouse">
							    <thead>
							      <tr>
							        <th>Tên sản phẩm</th>
							        <th>Số lượng</th>
							        <th>Đơn giá nhập</th>
							        <th>Thành tiền</th>
							      </tr>
							    </thead>
							    <tbody> 
							    </tbody>
							  </table>
						</div>
	            	</div>`
		},

	},
	Order: {
		Update(){
			return `<div class="container"> 
                        <div class="row"> 
                            <div class="col-md-8 pd-5"> 
								<table class="table table-bordered">
							    	<thead>
							      		<tr>
									        <th>Mã</th>
									        <th>Tên sản phẩm</th>
									        <th>Số lượng</th>
									        <th>Đơn giá</th>
									        <th>Giảm giá</th>
									        <th>Thành tiền</th>
									        <th>Kho</th> 
									        <th>Trạng thái</th> 
							      		</tr>
							    	</thead>
								    <tbody class="data-list"> 
								    </tbody>
							  	</table> 
                            </div>
                            <div class="col-md-4">  
                                <ul class="list-unstyled m-t-10">
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                            <span>Email: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-email"> </p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Khách hàng: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-type"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                            <span>Họ và tên: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-name"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                            <span>Điện thoại: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-telephone"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-15">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Địa chỉ: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-address"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Tạm tính: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-order-price"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Giảm giá: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-order-discount"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-15">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Tổng: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-order-total"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Phương thức: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-payment-type"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-7 col-7 pd-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Trạng thái: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-payment-status"></p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-12 col-12 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                            <span>Bình luận: </span> 
                                        </p>
                                        <p class="col font-weight-semibold pd-5 customer-order-comment"></p>
                                    </li>
                                </ul> 
                            	<select name="" id="" class="form-control order-status">
                            	</select>
                            </div>
                        </div> 
                    </div>`
		}
	}
}