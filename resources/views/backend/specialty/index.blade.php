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
                        {{__('messages.specialty')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions"> &nbsp;
                            <a href="{{action('Backend\SpecialtyController@create')}}"
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
                <table class="table table-striped- table-hover table-checkable spec_table" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('messages.section')}}</th>
                        <th>{{__('messages.type')}}</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$specs->isEmpty())
                        @foreach($specs as $key => $spec)
                            @foreach($spec->specialty as $key => $s)
                                {{--                                @php--}}
                                {{--                                dump($s->id)--}}
                                {{--                                @endphp--}}
                                <tr>
                                    <td></td>
                                    <td><h6>{{$spec->name}}</h6></td>
                                    <td><h5>{{$s->type->name}}</h5></td>
                                    <td>
                                        <input type="text" class="form-control name" name="name"
                                            value="{{$s->name}}" disabled>
                                    </td>

                                    <td>
                                        <div class="row justify-content-end">
                                            <a href="{{action('Backend\SpecialtyController@show', $spec->id)}}"
                                               class="btn btn-info kt-badge kt-badge--lg"
                                               data-toggle="m-tooltip" data-placement="top"
                                               data-original-title="{{__('messages.show')}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <input type="hidden" class="id" value="{{$s->id}}">
                                            <input type="hidden" class="url" value="/updateSpec">
                                            <button title="Edit"
                                                    class="edit btn btn-info kt-badge kt-badge--lg"
                                                    data-toggle="m-tooltip" data-placement="top"
                                                    data-original-title="{{__('messages.edit')}}"><i
                                                        class="la la-edit"></i>
                                            </button>
                                            <button title="Save"
                                                    class="save btn btn-info kt-badge kt-badge--lg"
                                                    data-toggle="m-tooltip" data-placement="top"
                                                    data-original-title="{{__('messages.save')}}"><i
                                                        class="la la-save"></i>
                                            </button>
                                            <button title="Cancel"
                                                    class="cancel btn btn-info kt-badge kt-badge--lg"
                                                    data-toggle="m-tooltip" data-placement="top"
                                                    data-original-title="{{__('messages.cancel')}}"><i
                                                        class="la la-ban"></i>
                                            </button>
                                            <form action="{{action('Backend\SpecialtyController@destroy', $s->id)}}"
                                                  id="_form" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="_id" type="hidden" value="{{$s->id}}">
                                                <button data-ref="" type="button"
                                                            data-title="specialty"
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
