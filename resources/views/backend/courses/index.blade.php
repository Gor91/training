@extends('layouts.master')
@section('content')
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
                        Դասընթացներ
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{action('Backend\CoursesController@create')}}"
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
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.course_status')}}</th>
                        <th>{{__('messages.course_credit')}}</th>
                        <th>{{__('messages.cost')}}</th>
                        <th>{{__('messages.activity_period')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$courses->isEmpty())
                        @foreach($courses as $key => $course)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->status == "active" ? __('messages.course_status_active') : __('messages.course_status_archive')}}</td>
                                <td>{{$course->credit}}</td>
                                <td>{{$course->cost}}</td>
                                <td>{{$course->duration_date}}</td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\CoursesController@getCourse',$course->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top" data-original-title="Խմբագրել">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="{{action('Backend\CoursesController@destroy',$course->id)}}" class="btn btn-danger kt-badge kt-badge--lg"
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
