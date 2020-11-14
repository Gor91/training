@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br/>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('error') }}</p>
            </div>
        @endif
        @if (Session::has('delete'))
            <div class="alert alert-info">
                <p>{{ Session::get('delete') }}</p>
            </div>
        @endif

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-admins-1"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{__('messages.tests')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> {{__('messages.export')}}
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">

                                        <li class="kt-nav__item">
                                            <a href="{{action('Backend\AccountTestController@gdPDF', $id)}}"
                                               class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">{{__('messages.PDF')}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="{{action('Backend\AccountController@index', "user")}}"
                               class="btn btn-warning btn-sm ">
                                <i class="la la-undo"></i>
                                {{__('messages.back')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.credit')}}</th>
                        <th>{{__('messages.result')}}</th>
                        <th>{{__('messages.count')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$tests->isEmpty())
                        @foreach($tests as $key => $test)

                            <tr class="text-center">
                                <td></td>

                                <td>@if(!empty($test->course->name)){{$test->course->name}}@endif</td>
                                <td>@php if(!empty($test->course->credit)){{
                                html_entity_decode(creditNameByKey($test->course->credit));
                                }}@endphp</td>
                                <td>@if(!empty($test->percent)){{$test->percent}}@endif</td>
                                <td @if(!empty($test->count) && $test->count == 3) {{'class= table-danger'}}@endif>@if(!empty($test->count)){{$test->count}}@endif</td>

                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\AccountTestController@show', ['a_id'=>$test->account_id,'id'=>$test->id])}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top"
                                           data-original-title="{{__('messages.show')}}">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection
