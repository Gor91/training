@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"/>
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
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.add')}} {{__('messages.new_user')}}&nbsp;
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
                                        <a href="{{action('Backend\AdminController@index')}}"
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
                            {{--                            {{Form::}}--}}

                            <form class="kt-form" id="kt_form" method="post" enctype="multipart/form-data"

                                  action="{{ action('Backend\CoursesController@store')}}">
                            @csrf
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_name')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <input id="name" type="text" name="name"
                                                           class="form-control" value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="special"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_list')}}</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control" id="special"
                                                            name="specialty_ids[]" multiple="multiple">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">{{__('messages.course_status')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control" id="special"
                                                            name="status">
                                                        <option
                                                            value="active">{{__('messages.course_status_active')}}</option>
                                                        <option
                                                            value="archive">{{__('messages.course_status_deactive')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_duration_date')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <input id="date" type="date" name="date"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="credit"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_credit')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <input id="credit" type="number" name="credit"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content_data"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_paragraph')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <textarea id="content_data" type="text" name="content_data"
                                                              class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-10">
                                                    <input name="files" id="video" type="hidden"
                                                           class="form-control">
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
            $("#special").select2({
                placeholder: "Ընտրեք մասնագիտություն",
                tags: true,
                ajax: {
                    dataType: "json",
                    method: 'GET',
                    url: "courses/getSpecialities",
                    processResults: function (data) {
                        var select_result = [];
                        var final_data = {};
                        if (data) {
                            $.each(data, function (key, value) {
                                final_data["id"] = key;
                                final_data["text"] = key;
                                final_data["children"] = [];
                                for (var i = 0; i < value.length; i++) {
                                    final_data["children"].push(value[i])
                                }
                                select_result.push(final_data)
                                final_data = {};

                            })
                        }
                        return {results : select_result }
                    }
                }
            })
        </script>
        <!-- end:: Content -->
    </div>
@endsection
