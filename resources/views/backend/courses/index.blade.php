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
                        {{__('messages.courses')}}
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
                                            <a href="{{action('Backend\CoursesController@gdExcel')}}"
                                               class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">{{__('messages.excel')}}</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{action('Backend\CoursesController@gdPDF')}}"
                                               class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">{{__('messages.PDF')}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

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
                        <th>{{__('messages.course_start_date')}}</th>
                        <th>{{__('messages.course_end_date')}}</th>
                        <th>{{__('messages.duration')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$courses->isEmpty())
                        @foreach($courses as $key => $course)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->status == "active" ? __('messages.course_status_active') : __('messages.course_status_archive')}}</td>
                                <td>
                                    @if($course->credit)
                                        <?php $credits = (array)json_decode($course->credit);?>
                                        @foreach($credits as $key => $credit)
                                            @if($credit)
                                                <span class="kt-widget1__title">
                                                {{__(sprintf('messages.%s', $credit->name))}}
                                            </span>
                                                <span class="kt-widget1__title">
                                                    {{$credit->credit}}
                                            </span><br/>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$course->cost}}</td>
                                <td>{{date('d-m-Y', strtotime($course->start_date))}}</td>
                                <td>{{date('d-m-Y', strtotime($course->end_date))}}</td>
                                <td>{{$course->duration}}</td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\CoursesController@show', $course->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top"
                                           data-original-title="{{__('messages.show')}}">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{action('Backend\CoursesController@edit',$course->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top"
                                           data-original-title="{{__('messages.edit')}}">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <form action="{{action('Backend\CoursesController@destroy', $course->id)}}"
                                              id="_form" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button data-ref="" type="button"
                                                    data-title="type"
                                                    class="delete btn btn-danger kt-badge--lg kt-badge"
                                                    data-original-title="{{__('messages.delete')}}">
                                                <i class="la la-trash"></i>
                                            </button>
                                        </form>

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
