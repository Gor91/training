@extends('layouts.master')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-dashboard"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Գլխավոր
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">

                            <button type="button" class="btn btn-default btn-icon-sm "
                                    data-toggle="modal" data-target="#kt_modal_6">
                                <i class="flaticon-grid-menu"></i>
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-xl">

            </div>
        </div>
    </div>

@endsection