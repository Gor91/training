@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
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

                        <div class="kt-portlet__head kt-portlet__head--lg">

                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-network"></i>
                                    Խմբագրել&nbsp;&nbsp;<i>{{$user->first_name.' '.$user->last_name}}</i>
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{Lang::get('messages.all_field_required')}}</i>
                                </span>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\UserController@index')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{Lang::get('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet kt-portlet--tabs">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-toolbar offset-lg-2 col-lg-8">
                                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right " role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"
                                               href="#kt_portlet_base_demo_1_tab_content" role="tab">
                                                <i class="flaticon-cogwheel-2"></i> Ընդհանուր
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#kt_portlet_base_demo_2_tab_content"
                                               role="tab">
                                                <i class="flaticon-multimedia"></i> Իրավունքներ
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <form class="tab-content kt-form offset-lg-2 col-lg-8" id="kt_form" method="post"
                                      action="{{ action('Backend\UserController@update', $user->id)}}">
                                    @csrf
                                    <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content"
                                         role="tabpanel">
                                        <input name="_method" type="hidden" value="PATCH">

                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v3__form">
                                                <div class=" row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group row">
                                                            <div class="form-group row">
                                                                <div class="kt-widget__media">
                                                                    @php
                                                                        $img_path =storage_path().\Illuminate\Support\Facades\Config::get('constants.USER_AVATAR_PATH').$user->avatar;

                                                                    @endphp
                                                                    @if(!empty($user->avatar) && file_exists($img_path))
                                                                        <img class="kt-widget__img "
                                                                             src="{{asset('/storage'.\Illuminate\Support\Facades\Config::get('constants.USER_AVATAR_PATH').$user->avatar)}}"
                                                                             alt="image">
                                                                    @else
                                                                        <img class="kt-widget__img "
                                                                             src="{{asset(\Illuminate\Support\Facades\Config::get('constants.DEFAULT_PATH'))}}"
                                                                             alt="image">
                                                                    @endif
                                                                </div>
                                                                <i id="loading"
                                                                   class="fa fa-spinner fa-spin fa-3x fa-fw"
                                                                   style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                                                <p class="p-1">
                                                                    <a href="javascript:changeProfile()"
                                                                       style="text-decoration: none;">
                                                                        <i class="flaticon2-edit"></i>
                                                                    </a>
                                                                    @if(!empty($user->avatar))
                                                                        <a href="javascript:removeFile()"
                                                                           style="color: red;text-decoration: none;">
                                                                            <i class="flaticon2-delete"></i>
                                                                        </a>
                                                                    @endif
                                                                </p>
                                                                <input type="file" id="file" style="display: none"/>
                                                                <input type="hidden" id="file_name"
                                                                       value="{{$user->avatar}}">
                                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="form-group row">
                                                            <label for="first_name"
                                                                   class="col-lg-2 col-form-label">Անուն*</label>
                                                            <div class="col-lg-10">
                                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                                <input id="first_name" type="text" name="first_name"
                                                                       class="form-control m-input"
                                                                       placeholder="Enter First Name"
                                                                       value="{{  $user->first_name}}">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="last_name"
                                                                   class="col-lg-2 col-form-label">Ազգանուն*</label>
                                                            <div class="col-lg-10">
                                                                <input id="last_name" type="text" name="last_name"
                                                                       class="form-control m-input"
                                                                       placeholder="Enter Last Name"
                                                                       value="{{$user->last_name}}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-lg-2 col-form-label">Էլ.
                                                        փոստ*</label>
                                                    <div class="col-lg-10">
                                                        <input id="email" type="email" name="email"
                                                               class="form-control m-input"
                                                               placeholder="Enter Email" value="{{$user->email}}">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="phone"
                                                           class="col-lg-2 col-form-label">Հեռախոս*</label>
                                                    <div class="col-lg-10">
                                                        <input id="phone" type="tel" name="phone"
                                                               class="form-control m-input"
                                                               placeholder="Enter Phone" value="{{$user->phone}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password"
                                                           class="col-lg-2 col-form-label">Ծածկագիր</label>
                                                    <div class="col-lg-10">
                                                        <input id="password" type="password" name="password"
                                                               class="form-control m-input">
                                                        <span class="form-text text-muted">Լրացնել միայն փոփոխելու կամ նորը սահմանելու դեպքում</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="c_password" class="col-lg-2 col-form-label">Կրկնել
                                                        ծածկագիր</label>
                                                    <div class="col-lg-10">
                                                        <input id="c_password" type="password"
                                                               name="confirm_password"
                                                               class="form-control m-input">
                                                        <span class="form-text text-muted">Լրացնել միայն փոփոխելու կամ նորը սահմանելու դեպքում</span>

                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label for="group" class="col-lg-2 col-form-label">Դեր*</label>
                                                    <div class="col-lg-10">
                                                        <select id="group" name="group"
                                                                class="form-control ">

                                                            @foreach ($groups as $group)
                                                                <option value="{{$group->id}}"
                                                                        @if ($user->group[0]['id'] == $group->id)
                                                                        selected="selected"
                                                                        @endif>
                                                                    {{$group->description}}
                                                                </option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="status"
                                                           class="col-lg-2 col-form-label">Ակտիվ*</label>
                                                    <div class="col-lg-10 m-select2">
                                                        <select id="status" name="status"
                                                                class="form-control m-input m-input--air m_selectpicker">
                                                            <option value="1">Ակտիվ</option>
                                                            <option value="0"
                                                                    @if($user->active==0) selected="selected" @endif>
                                                                Պասիվ
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content"
                                         role="tabpanel">
                                        <ul>
                                            {{--                                            @php--}}
                                            {{--                                            dd($gp_json);--}}
                                            {{--                                            @endphp--}}
                                            @if(!$permissions->isEmpty())
                                                @php
                                                    if(!empty($gp_json->permission_id))
                                                        $gp =json_decode($gp_json->permission_id,true);
                                                        if(!empty($ugp))
                                                        $ugp =json_decode($ugp->permissions,true);
                                                        $action = [1=>'Դիտել',2=>'Խմբագրել',3=>'Ստեղծել',4=>'Հաստատել'];
                                                        $step=3;
                                                        $class="vec";

                                                @endphp
                                                @foreach($permissions as $gn=> $items)
                                                    <li class="permission_group">{{$gn}}
                                                        <ul>
                                                            @foreach($items as $p)
                                                                @if(in_array($p->id, $gp))
                                                                    @if($p->id > 34 && $p->id < 37)
                                                                        @php
                                                                            $step=4;
                                                                        $class ="approve";
                                                                        @endphp
                                                                    @endif
                                                                    <li class="permission-name">{{$p->name}}
                                                                        <ul>
                                                                            @for($i = 1; $i<= $step; ++$i)
                                                                                <li>
                                                                                    <label class="kt-checkbox permission">
                                                                                        <input type="checkbox"
                                                                                               class="{{$class}}"
                                                                                               value="{{$p->id}}"
                                                                                               name="permission_{{$class}}_{{$i}}[]"
                                                                                        @if(!empty($ugp[$p->id]) )
                                                                                            @if(!is_array($ugp[$p->id]) &&  $ugp[$p->id] === $i)
                                                                                                {{'checked'}}
                                                                                                    @endif
                                                                                            @if(is_array($ugp[$p->id]))
                                                                                                @foreach($ugp[$p->id] as $jp)
                                                                                                    @if($jp === $i)
                                                                                                        {{'checked'}}
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                @endif
                                                                                        >
                                                                                        <span></span>

                                                                                        {{$action[$i]}}
                                                                                    </label></li>
                                                                            @endfor
                                                                        </ul>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <div class="kt-form__actions text-right float-lg-right">
                                            <button class="btn btn-info btn-md  right-align kt-font-bold kt-font-transform-u"
                                                    type="submit">
                                                Հաստատել
                                            </button>
                                        </div>
                                    </div>

                                    <!--end: Form Actions -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
    <script>
        function changeProfile() {
            $('#file').click();
        }

        $('#file').change(function () {
            if ($(this).val() != '') {
                upload(this);

            }
        });

        function upload(img) {
            var form_data = new FormData();
            $id = $('[name=id]').val();
            form_data.append('file', img.files[0]);
            form_data.append('id', $id);
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{url('backend/ajaxImageUpload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.fail) {
                        $('#preview_image').attr('src', '{{asset("images/noimage.jpg")}}');
                        alert(data.errors['file']);
                    } else {
                        location.reload()
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    $('#preview_image').attr('src', '{{asset("images/noimage.jpg")}}');
                }
            });
        }

        function removeFile() {

            if ($('#file_name').val() !== '')
                if (confirm('Are you sure want to remove profile picture?')) {
                    $('#loading').css('display', 'block');

                    var form_data = new FormData();
                    form_data.append('_method', 'DELETE');
                    form_data.append('id', $('[name=id]').val());
                    form_data.append('file_name', $('#file_name').val());
                    form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url: "{{url('backend/ajaxRemoveImage')}}",
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }
        }
    </script>
@endsection
