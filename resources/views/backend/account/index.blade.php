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
                        Օգտագործողներ
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a
                                                    {{--                                                    href="{{action('Backend\AccountController@gdExcel')}}"--}}
                                                    class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a
                                                    {{--                                                    href="{{action('Backend\AccountController@gdPDF')}}"--}}
                                                    class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            &nbsp; @if($role !== 'user')
                                <a href="{{action('Backend\AccountController@create')}}"
                                   class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    {{__('messages.add')}}
                                </a>
                            @endif
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
                        <th>{{__('messages.image_name')}}</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.surname')}}</th>
                        <th>{{__('messages.prof')}}</th>
                        <th>{{__('messages.phone')}}</th>
                        <th>{{__('messages.email')}}</th>
                        <th>{{__('messages.status')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$accounts->isEmpty())
                        @foreach($accounts as $key => $account)

                            <tr class="text-center">
                                <td></td>
                                <td>
                                    <img src="{{  Config::get('constants.AVATAR_PATH_UPLOADED').$account->image_name}}"
                                         alt="avatar" style="height: 50px"></td>
                                <td>{{$account->name}}</td>
                                <td>{{$account->surname}}</td>
                                <td>{{$account->prof->profession}}</td>
                                <td>{{$account->phone}}</td>
                                <td>{{$account->user->email}}</td>
                                <td>
                                    <a @if($account->user->status ==="pending")
                                       class="btn btn-danger" @endif>{{__('messages.'.$account->user->status)}}</a></td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\AccountController@show', $account->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top"
                                           data-original-title="{{__('messages.show')}}">
                                            <i class="la la-eye"></i>
                                        </a>
                                        @if($account->role !=='user')
                                            <a href="{{action('Backend\AccountController@edit', $account->id)}}"
                                               class="btn btn-info kt-badge kt-badge--lg"
                                               data-toggle="m-tooltip" data-placement="top"
                                               data-original-title="{{__('messages.edit')}}">
                                                <i class="la la-edit"></i>
                                            </a>
                                        @endif

                                        <form action="{{action('Backend\AccountController@destroy', $account->id)}}"
                                              id="_form" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_id" type="hidden" value="{{$account->id}}">
                                            <button data-ref="" type="button"
                                                    {{--                                                    data-title="admin"--}}
                                                    class="delete btn btn-danger kt-badge--lg kt-badge  "
                                                    data-original-title="{{__('messages.delete')}}">
                                                <i class="la la-trash"></i>

                                            </button>
                                            {{--                                                <button  data-title="admin"type="button" class="btn sweetalert"> Show me</button>--}}
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

    <!-- end:: Content -->

@endsection
