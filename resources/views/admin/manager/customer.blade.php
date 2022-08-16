@extends('admin.layout')
@section('title', 'Khách hàng')
@section('menu-data')
<input type="hidden" name="" class="menu-data" value="customer-group | customer">
@endsection()


@section('css')
    <link href="{{ asset('manager/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection()


@section('body')

    
<div class="page-header no-gutters has-tab">
    <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
        <div class="media align-center justify-content-between m-b-15 w-100">
            <div class="m-l-15">
                <h4 class="m-b-0">Khách hàng</h4>
            </div>
            @include('admin.alert')
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body"> 
        <div class="m-t-25">
            <table id="data-table" class="table"> </table>
        </div>
    </div>
</div>

@endsection()


@section('sub_layout')

<div class="modal modal-right fade quick-view" id="side-modal-create">
    <div class="modal-dialog tab-3">
        <div class="modal-content">
            <div class="modal-header justify-content-between align-items-center">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body scrollable">
                
            </div>
            <div class="modal-footer d-flex justify-content-end align-items-center"> 
                <button type="button" class="btn btn-primary push-modal" atr="Push"></button>
            </div>
        </div>
    </div>            
</div>
<div class="modal modal-right fade quick-view" id="side-modal-update">
    <div class="modal-dialog tab-3">
        <div class="modal-content">
            <div class="modal-header justify-content-between align-items-center">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body scrollable">
                
            </div>
            <div class="modal-footer d-flex justify-content-end align-items-center"> 
                <button type="button" class="btn btn-primary push-modal" atr="Push"></button>
            </div>
        </div>
    </div>            
</div>

<div class="modal modal-right fade quick-view" id="side-modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-between align-items-center">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body scrollable">
                
            </div>
            <div class="modal-footer d-flex justify-content-end align-items-center"> 
                <button type="button" class="btn btn-primary push-modal" atr="Push"></button>
            </div>
        </div>
    </div>            
</div>

@endsection()

@section('js')
    
    <script src="{{ asset('manager/assets/js/page/customer.js') }}"></script>

@endsection()