@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

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
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.add')}} {{__('messages.new_lecture')}}&nbsp;
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{__('messages.*_field_required')}}</i>
                                </span>
                            </div>

                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\AccountController@index','lecture')}}"
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
                                <form class="tab-content kt-form offset-lg-2 col-lg-8" id="kt_form" method="post"
                                      enctype="multipart/form-data"
                                      action="{{ action('Backend\AccountController@store','lecture')}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="POST">
                                    <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content"
                                         role="tabpanel">
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v3__form">
                                                <div class="form-group row validated">
                                                    <label for="name"
                                                           class="col-lg-2 col-form-label">{{__('messages.name').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="name" type="text" name="name"
                                                               placeholder="{{__('messages.arm')}}"
                                                               class="form-control @if($errors->first('name')){{'is-invalid'}} @endif"
                                                               value="{{old('name')}}">
                                                        @error('name')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="surname"
                                                           class="col-lg-2 col-form-label">{{__('messages.surname').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="surname" type="text" name="surname"
                                                               placeholder="{{__('messages.arm')}}"
                                                               class="form-control @if($errors->first('surname')){{'is-invalid'}} @endif"
                                                               value="{{old('surname')}}">
                                                        @error('surname')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="father_name"
                                                           class="col-lg-2 col-form-label">{{__('messages.father_name').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="father_name" type="text" name="father_name"
                                                               placeholder="{{__('messages.arm')}}"
                                                               class="form-control @if($errors->first('father_name')){{'is-invalid'}} @endif"
                                                               value="{{old('father_name')}}">
                                                        @error('father_name')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="phone"
                                                           class="col-lg-2 col-form-label">{{__('messages.phone').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="phone" type="text" name="phone"
                                                               class="form-control @if($errors->first('phone')){{'is-invalid'}} @endif"
                                                               value="{{old('phone')}}">
                                                        @error('phone')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="email"
                                                           class="col-lg-2 col-form-label">{{__('messages.email').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="email" type="email" name="email"
                                                               class="form-control @if($errors->first('email')){{'is-invalid'}} @endif"
                                                               value="{{old('email')}}">
                                                        @error('email')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row date validated">
                                                    <label for="bday"
                                                           class="col-lg-2 col-form-label">{{__('messages.bday').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="bday" type="date" name="bday"
                                                               value="{{old('bday')}}"
                                                               class="form-control @if($errors->first('bday')){{'is-invalid'}} @endif">
                                                    </div>
                                                    @error('bday')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row date validated">
                                                    <label for="passport"
                                                           class="col-lg-2 col-form-label">{{__('messages.passport').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="passport" type="text" name="passport"
                                                               value="{{old('passport')}}"
                                                               class="form-control @if($errors->first('passport')){{'is-invalid'}} @endif">
                                                        @error('passport')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                @php
                                                    $date = strtotime(date('Y-m-d').'-10 year');
                                                @endphp
                                                <div class="form-group row date validated">
                                                    <label for="date_of_issue"
                                                           class="col-lg-2 col-form-label">{{__('messages.date_of_issue').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="date_of_issue" type="date" name="date_of_issue"
                                                               min="{{date('Y-m-d', $date)}}" max="{{date('Y-m-d')}}"
                                                               class="form-control @if($errors->first('date_of_issue')){{'is-invalid'}} @endif"
                                                               value="{{old('date_of_issue')}}">
                                                        @error('date_of_issue')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                @php
                                                    $date_start = strtotime(date('Y-m-d').'-10 year');
                                                    $date_end = strtotime(date('Y-m-d').'+10 year');
                                                @endphp
                                                <div class="form-group row date validated">
                                                    <label for="date_of_expiry"
                                                           class="col-lg-2 col-form-label">{{__('messages.date_of_expiry').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="date_of_expiry" type="date" name="date_of_expiry"
                                                               min="{{date('Y-m-d', $date_start)}}"
                                                               max="{{date('Y-m-d', $date_end)}}"
                                                               class="form-control @if($errors->first('date_of_expiry')){{'is-invalid'}} @endif"
                                                        value="{{old('date_of_expiry')}}">
                                                        @error('date_of_expiry')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content"
                                         role="tabpanel">
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v3__form">
                                                <h4 class="form-group row">{{__('messages.work_address')}}</h4>
                                                <div class="form-group row validated">
                                                    <label for="workplace_name"
                                                           class="col-lg-2 col-form-label">{{__('messages.workplace_name').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="workplace_name" type="text" name="workplace_name"
                                                               placeholder="{{__('messages.arm')}}"
                                                               value="{{old('workplace_name')}}"
                                                               class="form-control @if($errors->first('workplace_name')){{'is-invalid'}} @endif">
                                                        @error('workplace_name')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row was-validated">
                                                    <label class="col-lg-2 col-form-label"
                                                           for="w_region">{{__('messages.region').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="w_region" name="w_region"
                                                                class="form-control @if($errors->first('w_region')){{'is-invalid'}} @endif">
                                                            <option value="">{{__('messages.select_region')}}</option>
                                                            @foreach($regions->regions as $key=>$region)

                                                                <option value="{{$region->id}}">
                                                                    {{$region->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('w_region')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="w_territory"
                                                           class="col-lg-2 col-form-label">{{__('messages.territory').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="w_territory" name="w_territory"
                                                                class="form-control @if($errors->first('w_territory')){{'is-invalid'}} @endif">
                                                        </select>
                                                        @error('w_territory')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="w_street"
                                                           class="col-lg-2 col-form-label">{{__('messages.street').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="w_street" type="text" name="w_street"
                                                               placeholder="{{__('messages.arm')}}"
                                                               class="form-control @if($errors->first('w_street')){{'is-invalid'}} @endif"
                                                        value="{{old('w_street')}}">
                                                        @error('w_street')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <h4 class="form-group row">{{__('messages.home_address')}}</h4>


                                                <div class="form-group row validated">
                                                    <label class="col-lg-2 col-form-label"
                                                           for="h_region">{{__('messages.region').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="h_region" name="h_region"
                                                                class="form-control @if($errors->first('h_region')){{'is-invalid'}} @endif">
                                                            <option value="">{{__('messages.select_region')}}</option>
                                                            @foreach($regions->regions as $key=>$region)
                                                                <option value="{{$region->id}}">
                                                                    {{$region->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('h_region')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="h_territory"
                                                           class="col-lg-2 col-form-label">{{__('messages.territory').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="h_territory" name="h_territory"
                                                                class="form-control @if($errors->first('h_territory')){{'is-invalid'}} @endif">
                                                        </select>
                                                        @error('h_territory')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label for="h_street"
                                                           class="col-lg-2 col-form-label">{{__('messages.street').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="h_street" type="text" name="h_street"
                                                               placeholder="{{__('messages.arm')}}"
                                                               class="form-control @if($errors->first('h_street')){{'is-invalid'}} @endif"
                                                        value="{{old('h_street')}}">
                                                        @error('h_street')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_portlet_base_demo_3_tab_content"
                                         role="tabpanel">
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v3__form">
                                                <h4 class="form-group row">{{__('messages.education').'*'}}</h4>
                                                <div class="form-group row validated">
                                                    <label class="col-lg-2 col-form-label"
                                                           for="prof">{{__('messages.prof')}}</label>
                                                    <div class="col-lg-10">

                                                        <select id="prof" name="profession"
                                                                class="form-control @if($errors->first('profession')){{'is-invalid'}} @endif">
                                                            @if(!empty($prof))
                                                                @foreach($prof as $key=>$p)
                                                                    <option class="form-control" value="{{$p->id}}">
                                                                        {{$p->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('profession')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label class="col-lg-2 col-form-label"
                                                           for="edu">{{__('messages.spec').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="edu" name="education_id"
                                                                class="form-control @if($errors->first('education_id')){{'is-invalid'}} @endif">
                                                        </select>
                                                        @error('education_id')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label class="col-lg-2 col-form-label"
                                                           for="spec">{{__('messages.education').'*'}}</label>
                                                    <div class="col-lg-10">
                                                        <select id="spec" name="specialty_id"
                                                                class="form-control @if($errors->first('specialty_id')){{'is-invalid'}} @endif">
                                                        </select>
                                                        @error('specialty_id')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label class="col-lg-6 col-form-label"
                                                           for="member_of_palace">{{__('messages.member_of_palace')}}</label>
                                                    <div class="col-lg-6">
                                                        <input id="member_of_palace" type="checkbox"
                                                               name="member_of_palace"
                                                               class="form-control @if($errors->first('member_of_palace')){{'is-invalid'}} @endif"
                                                               value="1">
                                                        @error('member_of_palace')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row validated">
                                                    <label class="col-lg-6 col-form-label"
                                                           for="diploma">{{__('messages.diploma').'*'}}</label>
                                                    <div class="col-lg-6">
                                                        <input id="diploma" type="file" name="diploma_1"
                                                               class="form-control @if($errors->first('diploma_1')){{'is-invalid'}} @endif"
                                                               value="{{old('diploma_1')}}" multiple="multiple">
                                                        @error('diploma_1')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="kt-form__actions text-right float-lg-right">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('messages.save')}}</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 1-->


                                    <!--end: Form Actions -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>


@endsection
