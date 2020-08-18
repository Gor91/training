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
                        {{__('messages.comments')}}
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('messages.username')}}</th>
                        <th>{{__('messages.course_name')}}</th>
                        <th>{{__('messages.comments')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$comments->isEmpty())
                        @foreach($comments as $key => $comment)
                            <tr>
                                <td></td>
                                <td>{{getAccountName($comment->account_id)}}</td>
                                <td>{{getCourseName($comment->course_id)}}</td>
                                <td>{{$comment->comment}}</td>
                                <td>
                                    <div class="row justify-content-end">
                                        <a href="{{action('Backend\CommentController@show', $comment->id)}}"
                                           class="btn btn-info kt-badge kt-badge--lg"
                                           data-toggle="m-tooltip" data-placement="top"
                                           data-original-title="{{__('messages.show')}}">
                                            <i class="la la-eye"></i>
                                        </a>

                                        <a id ="{{$comment->id}}"
                                           class="btn btn-info kt-badge kt-badge--lg unread" <?php if($comment->panding == "unread"){ echo "style='background-color:#F64E60 !important;border:0;'";}?>
                                           data-toggle="m-tooltip" data-placement="top" data-original-title="Խմբագրել">
                                            <i class="la la-folder-o bg-red"></i>
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
