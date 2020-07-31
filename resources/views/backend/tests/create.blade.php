@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"/>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet"
              id="bootstrap-css">
        <style>
            .entry:not(:first-of-type) {
                margin-top: 10px;
            }
        </style>
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
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
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
                                                <div class="col-lg-10">
                                                    <select class="js-data-example-ajax form-control" id="courses"
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
                                                                <div
                                                                    class="entry input-group col-sm-10 custom_counter_g">
                                                                    <input id="answer" class="form-control"
                                                                           name="fields[{{$i}}][inp]"
                                                                           type="text" placeholder="Պատասխան"
                                                                           value="{{$value->inp}}"/>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn {{$i+1 == count((array)json_decode($test->answers)) ?
                                                                                    "btn-success btn-add" : "btn-danger btn-remove"}}"
                                                                                type="button">
                                                                                <span class="glyphicon {{$i+1 == count((array)json_decode($test->answers)) ?
                                                                                    "glyphicon-plus" : "glyphicon-minus"}}"></span>
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
                                                            <div class="entry input-group col-sm-10 custom_counter_g">
                                                                <input id="answer" class="form-control"
                                                                       name="fields[0][inp]"
                                                                       type="text" placeholder="Պատասխան"/>
                                                                <span class="input-group-btn">
                                                                        <button class="btn btn-success btn-add"
                                                                                type="button">
                                                                                <span
                                                                                    class="glyphicon glyphicon-plus"></span>
                                                                        </button>
                                                                </span>
                                                                <input type="checkbox" name="fields[0][check]" id="0"
                                                                       value="1"
                                                                       class="form-check-input">
                                                                <label class="form-check-label" for="0"></label>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script>
            $("#courses").select2({
                placeholder: "Ընտրեք մասնագիտություն",
                tags: true,
                ajax: {
                    dataType: "json",
                    method: 'GET',
                    url: "tests/getCourses",
                    processResults: function (data) {
                        var select_result = [];
                        var final_data = {};
                        if (data) {
                            $.each(data, function (key, value) {
                                final_data["children"] = [];
                                for (var i = 0; i < value.length; i++) {
                                    final_data["children"].push(value[i])
                                }
                                select_result.push(final_data)
                                final_data = {};

                            })
                        }
                        return {results: select_result}
                    }
                }
            })
            $(".select2-selection__arrow").hide()
            $("#select2-courses-container").css("display", "inline")

        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script>
            $(function () {
                $(document).on('click', '.btn-add', function (e) {
                    e.preventDefault();
                    var t = $('.custom_counter_g').length;
                    var dynaForm = $('.dynamic-wrap:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(dynaForm);
                    newEntry.find('input[type=text]').val('');
                    newEntry.find('input[type=text]').attr("name", "fields[" + t + "][inp]").val('');
                    newEntry.find('input[type=checkbox]').attr("name", "fields[" + t + "][check]");
                    newEntry.find('input[type=checkbox]').attr("id", t);
                    newEntry.find('input[type=checkbox]').prop("checked", false);
                    newEntry.find('.form-check-label').attr("for", t);

                    dynaForm.find('.entry:not(:last) .btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="glyphicon glyphicon-minus"></span>');
                    t++;
                }).on('click', '.btn-remove', function (e) {
                    $(this).parents('.entry:first').remove();
                    e.preventDefault();
                    return false;
                });
            });
        </script>
        <!-- end:: Content -->
    </div>
@endsection
