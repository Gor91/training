@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet portlet__custom">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-user-add"></i>
                                       {{isset($tests) ?  __('messages.edit_test') : __('messages.new_test')}}
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{__('messages.*_field_required')}}</i>
                                </span>
                            </div>

                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{action('Backend\TestsController@index')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-content">
                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form1" method="{{isset($test) ? "get" : "post"}}"
                                  enctype="multipart/form-data"
                                  action="{{isset($test) ? action('Backend\TestsController@editTests',$test->id) : action('Backend\TestsController@store')}}">
                                @csrf
                                {{--                            <!--begin: Form Wizard Step 1-->--}}
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="courses"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_list')}}</label>
                                                <div class="col-sm-10">
                                                    <select class="js-data-example-ajax form-control" id="courses"
                                                            data-placeholder="{{__('messages.choose_profession')}}"
                                                            name="courses">
                                                        @if(isset($test))
                                                            <option selected value="{{$test->courses_id}}">
                                                                {{$test->courses["name"]}}
                                                            </option>
                                                        @endif
                                                    </select>
                                                    @error('courses')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="test_name"
                                                       class="col-lg-2 col-form-label">{{__('messages.test_name')}}</label>
                                                <div class="col-lg-10">

                                                    <input id="test_name" type="text" name="question"
                                                           value="{{isset($test) ? $test->question : ""}}"
                                                           class="form-control">
                                                    @error('question')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="answer"
                                                       class="col-lg-2 col-form-label">{{__('messages.test_answer')}}</label>
                                                <div class="col-sm-10">
                                                    <div class="dynamic-wrap">
                                                        @if(isset($test))
                                                            <?php $i = 0;?>
                                                            @foreach (json_decode($test->answers) as $key=>$value)
                                                                <div class="entry input-group custom_counter_g">
                                                                    <textarea class="form-control froala-editor"
                                                                              name="fields[{{$i}}][inp]"
                                                                              type="text"
                                                                              placeholder="{{__('messages.answer')}}">{{$value->inp}}</textarea>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn {{$i+1 == count((array)json_decode($test->answers)) ?
                                                                                    "btn-success btn-add" : "btn-danger btn-remove"}}"
                                                                                type="button">
                                                                                <span class="fa {{$i+1 == count((array)json_decode($test->answers)) ?
                                                                                    "fa-plus" : "fa-minus"}}"></span>
                                                                        </button>
                                                                </span>
                                                                    <input type="checkbox" name="fields[{{$i}}][check]"
                                                                           id="{{$i}}"
                                                                           {{array_key_exists("check",(array)$value) ? "checked" : ""}}
                                                                           class="form-check-input">
                                                                    <label class="form-check-label"
                                                                           for="{{$i}}"></label>
                                                                </div>
                                                                <?php $i++?>
                                                            @endforeach
                                                        @endif
                                                        @if(!isset($test))
                                                            <div class="entry input-group custom_counter_g">
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control froala-editor"
                                                                              name="fields[0][inp]"
                                                                              type="text"
                                                                              placeholder="{{__('messages.answer')}}"></textarea>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-success btn-add"
                                                                                type="button">
                                                                                <span class="fa fa-plus"></span>
                                                                        </button>
                                                                </span>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <input type="checkbox" name="fields[0][check]"
                                                                           id="0"
                                                                           value="1"
                                                                           class="form-check-input">
                                                                    <label class="form-check-label" for="0"></label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Form Wizard Step 1-->
                                <div class="kt-form__actions text-right float-lg-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>
                                <!--end: Form Actions -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
