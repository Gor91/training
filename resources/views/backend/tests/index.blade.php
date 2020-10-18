@extends('layouts.master')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
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
                            <a href="{{action('Backend\TestsController@create')}}"
                               class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{__('messages.add')}}
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
                        <th>Կուրսի անուն</th>
                        <th>Թեստի հարց</th>
                    </tr>
                    </thead>
                    <tbody>
                    <pre>
                    @if(!$tests->isEmpty())
                            @foreach($tests as $key => $test)
                                <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$test->courses->name}}</td>
                                <td>{{$test->question}}</td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\TestsController@editTests',$test->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top" data-original-title="Խմբագրել">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="{{action('Backend\TestsController@destroy',$test->id)}}" class="btn btn-danger kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top" data-original-title="Ջնջել">
                                            <i class="la la-trash"></i>
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
@endsection
