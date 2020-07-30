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
                        {{__('messages.users')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm "
                                        title="change state" onclick="open_container();"
                                        class="display float-lg-left btn-primary px-2 myButton">
                                    <i class="fa fa-comments"></i>
                                    {{__('messages.send_email')}}
                                </button>

                            </div>
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> {{__('massages.export')}}Export
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a
                                                    href="{{action('Backend\AccountController@gdExcel')}}"
                                                    class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">{{__('massages.excel')}}</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a
                                                    href="{{action('Backend\AccountController@gdPDFRole')}}"
                                                    class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">{{__('massages.PDF')}}</span>
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
                        <th>
                            <label for="account" class="label">
                                <input type="checkbox" class="check_all">
                            </label>
                        </th>
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

                                    <input type="checkbox" name="choose_person"
                                           id="{{$account->id}}">
                                </td>
                                <td>
                                    <img src="{{  Config::get('constants.AVATAR_PATH_UPLOADED').$account->image_name}}"
                                         alt="avatar" style="height: 50px"></td>
                                <td>{{$account->name}}</td>
                                <td>{{$account->surname}}</td>
                                <td>{{$account->prof->profession}}</td>
                                <td>{{$account->phone}}</td>
                                <td class="email">{{$account->user->email}}</td>
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
                                              class="_form" method="post">
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
    <!-- Modal form-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.send_email')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="kt-form" method="post" action="{{action('Backend\BaseController@sendEmails')}}">
                        @csrf
                        <input type="hidden" name="ids" id="ids">
                        <div class="form-group row">
                            <label for="subject"
                                   class=" col-lg-3 col-form-label text-capitalize">{{__('messages.topic')}}*:</label>
                            <div class="col-lg-12">
                                <input id="subject" type="text"
                                       name="subject" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message"
                                   class="text-right col-lg-3 col-form-label text-capitalize">{{__('messages.message')}}
                                *:</label>
                            <div class="col-lg-12">
                                Can I insert rich text editor?
                                <textarea id="message" name="message"
                                          class="form-control"
                                          style="max-height: 200px; min-height: 200px; max-width: 100%; min-width: 100%"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <button type="submit"
                                    class="p-15 col-3 btn btn-primary align-self-end">{{__('messages.send')}}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- end of modal ------------------------------>
    <!-- end:: Content -->
    <script>
        $(".check_all").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        function open_container() {
            var size = 'small',
                content = '',
                title = 'Choose a ',
                footer = '';

            jQuery.noConflict();
            setModalBox(title, size);
            $chechedIds = [];
            $data = $("input:checked");
            $n = $data.length;
            $data.each(function () {
                $chechedIds.push($(this).attr('id'));
            });
            $('#ids').val($chechedIds);
            if ($n > 0)
                jQuery('#myModal').modal('show');
            else
                alert('Please choose a account.')
        }

        function setModalBox(title, content, footer, $size) {
            jQuery('#myModal').find('.modal-header h2').text(title);
            // $('#admin, #referee, #email, #state').css('display', 'none');
            // $('#' + _type).css('display', 'block');
            if ($size === 'small') {
                jQuery('#myModal').attr('class',
                    'modal fade bs-example-modal-sm')
                    .attr('aria-labelledby', 'mySmallModalLabel');
                jQuery('.modal-dialog').attr('class', 'modal-dialog modal-sm');
            }
        }
    </script>
@endsection
