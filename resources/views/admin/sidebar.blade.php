<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown statistic-group">
                <a class="dropdown-toggle statistic statistic-href-control" href="{{ route('admin.statistic.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Thống kê</span>
                </a>
            </li>
            <li class="nav-item dropdown manager-group">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Quản lí</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu"> 
                    <li class="category"> <a href="{{ route('admin.category.index') }}">Danh mục</a> </li>
                    <li class="product"> <a href="{{ route('admin.product.index') }}">Sản phẩm</a> </li>
                </ul>
            </li> 
            <li class="nav-item dropdown discount-group">
                <a class="dropdown-toggle discount" href="{{ route('admin.discount.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-fall"></i>
                    </span>
                    <span class="title">Giảm giá</span>
                </a>
            </li>
            <li class="nav-item dropdown order-group">
                <a class="dropdown-toggle order" href="{{ route('admin.order.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping-cart"></i>
                    </span>
                    <span class="title">Đơn hàng</span>
                </a>
            </li>
            <li class="nav-item dropdown warehouse-group">
                <a class="dropdown-toggle warehouse" href="{{ route('admin.warehouse.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-hdd"></i>
                    </span>
                    <span class="title">Kho hàng</span>
                </a>
            </li>
            <li class="nav-item dropdown customer-group">
                <a class="dropdown-toggle customer" href="{{ route('admin.customer.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Quản lý khách hàng</span>
                </a>
            </li>
        </ul>
    </div>
</div>