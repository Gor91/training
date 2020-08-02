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
                        Վիդեոներ
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{action('Backend\VideoController@create')}}"
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
                        <th>{{__('messages.lecture')}}</th>
                        <th>{{__('messages.duration')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$videos->isEmpty())
                        @foreach($videos as $key => $video)

                            <tr>
                                <td></td>
                                <td>{{$video->title}}</td>
                                <td>{{sprintf('%s %s', $video->lectures->name, $video->lectures->surname)}}</td>
                                <td>{{gmdate("H:i:s", $video->duration)}}</td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\VideoController@edit', $video->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top" data-original-title="Խմբագրել">
                                            <i class="la la-edit"></i>
                                        </a>
                                        @if($video->id !== \Illuminate\Support\Facades\Session::get('u_id'))
                                            <form action="{{action('Backend\VideoController@destroy', $video->id)}}"
                                                  id="_form" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="_id" type="hidden" value="{{$video->id}}">
                                                <button data-ref="" type="button"
                                                        {{--                                                    data-title="admin"--}}
                                                        class="delete btn btn-danger kt-badge--lg kt-badge  "
                                                        data-original-title="{{__('messages.delete')}}">
                                                    <i class="la la-trash"></i>

                                                </button>
                                                {{--                                                <button  data-title="admin"type="button" class="btn sweetalert"> Show me</button>--}}
                                            </form>
                                        @endif
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
