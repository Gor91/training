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
                                    {{__('messages.edit')}}&nbsp;&nbsp;<i>{{$account->name.' '.$account->surname}}</i>
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{__('messages.all_field_required')}}</i>
                                </span>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\AccountController@index', $account->role)}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
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
                                                <i class="flaticon2-information"></i> {{__('messages.info')}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#kt_portlet_base_demo_2_tab_content"
                                               role="tab">
                                                <i class="flaticon-home-2"></i> {{__('messages.address')}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"
                                               href="#kt_portlet_base_demo_3_tab_content"
                                               role="tab">
                                                <i class="flaticon2-notepad"></i> {{__('messages.education')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <form class="tab-content kt-form offset-lg-2 col-lg-8" id="kt_form" method="post" enctype="multipart/form-data"
                                      action="{{ action('Backend\AccountController@updateAccount', $account->id)}}">
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
                                                                        $img_path =public_path().\Illuminate\Support\Facades\Config::get('constants.AVATAR_PATH').$account->image_name;

                                                                    @endphp
                                                                    @if(!empty($account->image_name && preg_match('/\d+/',$account->image_name)) )
                                                                        <img class="kt-widget__img avatar"
                                                                             src="{{asset(\Illuminate\Support\Facades\Config::get('constants.AVATAR_PATH').$account->image_name)}}"
                                                                             alt="image">
                                                                    @else
                                                                        <img class="kt-widget__img avatar"
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
                                                                    @if(!empty($account->image_name))
                                                                        <a href="javascript:removeFile()"
                                                                           style="color: red;text-decoration: none;">
                                                                            <i class="flaticon2-delete"></i>
                                                                        </a>
                                                                    @endif
                                                                </p>
                                                                <input type="file" id="file" style="display: none"/>
                                                                <input type="hidden" id="file_name"
                                                                       value="{{$account->image_name}}">
                                                                <input type="hidden" name="id" value="{{$account->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="form-group row">
                                                            <label for="name"
                                                                   class="col-lg-2 col-form-label">{{__('messages.name')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input type="hidden" name="id" value="{{$account->id}}">
                                                                <input id="name" type="text" name="name"
                                                                       class="form-control m-input"

                                                                       value="{{  $account->name}}">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="surname"
                                                                   class="col-lg-2 col-form-label">{{__('messages.surname')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="surname" type="text" name="surname"
                                                                       class="form-control m-input"
                                                                       value="{{$account->surname}}"></div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="father_name"
                                                                   class="col-lg-2 col-form-label">{{__('messages.father_name')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="father_name" type="text" name="father_name"
                                                                       class="form-control m-input"
                                                                       value="{{$account->father_name}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group row">
                                                            <label for="email"
                                                                   class="col-lg-2 col-form-label">{{__('messages.email')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="email" type="email" name="email"
                                                                       class="form-control m-input"
                                                                       value="{{$account->user->email}}">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone"
                                                                   class="col-lg-2 col-form-label">{{__('messages.phone')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="phone" type="tel" name="phone"
                                                                       class="form-control m-input"
                                                                       value="{{$account->phone}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="bday"
                                                                   class="col-lg-2 col-form-label">{{__('messages.bday')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="bday" type="date" name="bday"
                                                                       class="form-control m-input"
                                                                       value="{{$account->bday}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="passport"
                                                                   class="col-lg-2 col-form-label">{{__('messages.passport')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="passport" type="text" name="passport"
                                                                       class="form-control m-input"
                                                                       value="{{$account->passport}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="date_of_issue"
                                                                   class="col-lg-2 col-form-label">{{__('messages.date_of_issue')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="date_of_issue" type="date"
                                                                       name="date_of_issue"
                                                                       class="form-control m-input"
                                                                       value="{{$account->date_of_issue}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="date_of_expiry"
                                                                   class="col-lg-2 col-form-label">{{__('messages.date_of_expiry')."*"}}
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input id="date_of_expiry" type="date"
                                                                       name="date_of_expiry"
                                                                       class="form-control m-input"
                                                                       value="{{$account->date_of_expiry}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content"
                                         role="tabpanel">
                                        <h4 class="form-group row">{{__('messages.work_address')}}</h4>
                                        <div class="form-group row">
                                            <label for="workplace_name"
                                                   class="col-lg-2 col-form-label">{{__('messages.workplace_name')."*"}}
                                            </label>
                                            <div class="col-lg-10">
                                                <input id="workplace_name" name="workplace_name"
                                                       class="form-control " value="{{$account->workplace_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="w_region">{{__('messages.region')."*"}}</label>
                                            <div class="col-lg-10">
                                                <select id="w_region" name="w_region" class="form-control">
                                                    <option value="">{{__('messages.select_region')}}</option>
                                                    @foreach($regions->regions as $key=>$region)

                                                        <option value="@if(!empty(old('w_region'))){{old('w_region')}} @else{{$region->id}}@endif"
                                                        @if($region->name === $account->w_region) {{'selected'}}@endif>
                                                            {{(string)$region->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $w = json_decode($account->work_address, true);
                                        @endphp
                                        <div class="form-group row">
                                            <label for="w_territory"
                                                   class="col-lg-2 col-form-label">{{__('messages.territory')."*"}}</label>
                                            <div class="col-lg-10">
                                                <select id="w_territory" name="w_territory"
                                                        class="form-control">
                                                    <option value="{{$w['w_territory']}}">{{$account->w_territory}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="w_street"
                                                   class="col-lg-2 col-form-label">{{__('messages.street')."*"}}</label>
                                            <div class="col-lg-10">
                                                <input id="w_street" type="text" name="w_street"
                                                       class="form-control"
                                                       value="{{$account->w_street}}{{old('w_street')}}">

                                            </div>
                                        </div>
                                        <h4 class="form-group row">{{__('messages.home_address')}}</h4>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="w_region">{{__('messages.region')."*"}}</label>
                                            <div class="col-lg-10">
                                                <select id="h_region" name="h_region" class="form-control">
                                                    <option value="">{{__('messages.select_region')}}</option>
                                                    @foreach($regions->regions as $key=>$region)

                                                        <option value="@if(!empty(old('h_region'))){{old('h_region')}} @else{{$region->id}}@endif"
                                                        @if($region->name === $account->h_region) {{'selected'}}@endif>
                                                            {{$region->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $h = json_decode($account->home_address, true);
                                        @endphp
                                        <div class="form-group row">
                                            <label for="h_territory"
                                                   class="col-lg-2 col-form-label">{{__('messages.territory')."*"}}</label>
                                            <div class="col-lg-10">
                                                <select id="h_territory" name="h_territory"
                                                        class="form-control">
                                                    <option value="{{$w['w_territory']}}">{{$account->w_territory}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="h_street"
                                                   class="col-lg-2 col-form-label">{{__('messages.street')."*"}}</label>
                                            <div class="col-lg-10">
                                                <input id="h_street" type="text" name="h_street"
                                                       class="form-control"
                                                       value="{{$account->h_street}}{{old('h_street')}}">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_3_tab_content"
                                         role="tabpanel">
                                        <h4 class="form-group row">{{__('messages.section')}}</h4>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="prof">{{__('messages.prof')."*"}}</label>
                                            <div class="col-lg-10">

                                                <select id="prof" name="profession" class="form-control">
                                                    @if(!empty($prof))
                                                        @foreach($prof as $key=>$p)
                                                            <option class="form-control"
                                                                    value="{{$p->id}}{{old('profession')}}"
                                                            @if($p->name === $profession->type_name){{'selected'}} @endif>
                                                                {{$p->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        {{--@php--}}
                                        {{--dd($edu);--}}
                                        {{--@endphp--}}
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="edu">{{__('messages.education')}}</label>
                                            <div class="col-lg-10">
                                                <select id="edu" name="education_id" class="form-control">
                                                    @if(!empty($profession))

                                                        <option class="form-control"
                                                                value="@if(!empty(old('education_id'))){{old('education_id')}}@else{{$profession->parent_id}}@endif">
                                                            {{$profession->edu_name}}
                                                        </option>

                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="spec">{{__('messages.education')}}</label>
                                            <div class="col-lg-10">
                                                <select id="spec" name="specialty_id" class="form-control">
                                                    <option class="form-control"
                                                            value="@if(!empty(old('specialty_id'))){{old('specialty_id')}}@else{{$profession->specialty_id}}@endif">
                                                        {{$profession->spec_name}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-8 col-form-label"
                                                   for="member_of_palace">{{__('messages.member_of_palace')}}</label>
                                            <div class="col-lg-4">
                                                <input id="member_of_palace" type="checkbox" name="member_of_palace"
                                                       @if($profession->member_of_palace == 1){{'checked'}}@endif   value="@if(!empty(old('member_of_palace'))){{old('member_of_palace')}}@else {{1}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-8 col-form-label"
                                                   for="diploma">{{__('messages.diploma')}}</label>
                                            <div class="col-lg-4">
                                                <input id="diploma" type="file" name="diploma_1"
                                                       multiple="multiple">
                                            </div>
                                        </div>
                                        <div class="kt-pricing-1 kt-pricing-1--fixed">
                                            <div class="kt-pricing-1__items row">

                                                @if(!empty($account->prof->diplomas))
                                                    @php
                                                        $diplomas = json_decode($account->prof->diplomas);
                                                    @endphp
                                                    <input class="diplomas" type="hidden" name="diplomas" value="{{$account->prof->diplomas}}">
                                                    @foreach($diplomas as $key => $diploma)

                                                        <div class="kt-pricing-1__item col-lg-4">
                                                            <i class="fa flaticon2-delete remove_diploma"></i>
                                                            <div class="kt-pricing-1__visual">

                                                                <div class="kt-pricing-1__hexagon1"></div>
                                                                <div class="kt-pricing-1__hexagon2"></div>
                                                                <span class="kt-pricing-1__icon kt-font-brand">

                                                                    <a href="{{Config::get('constants.DIPLOMA').$diploma}}"
                                                                       target="_blank">
                                                                        <img src="{{Config::get('constants.DIPLOMA').$diploma}}"
                                                                             alt="diploma"
                                                                             class="col-lg-12 diploma">
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="kt-form__actions text-right float-lg-right">
                                            <button class="btn btn-info btn-md  right-align kt-font-bold kt-font-transform-u"
                                                    type="submit">
                                                {{__('messages.approved')}}
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
                        $('#preview_image').attr('src', '{{asset("images/default.jpg")}}');
                        alert(data.errors['file']);
                    } else {
                        location.reload()
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    $('#preview_image').attr('src', '{{asset("images/default.jpg")}}');
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
