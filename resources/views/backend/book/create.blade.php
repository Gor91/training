@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid portlet__custom" id="kt_content">
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
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.add')}} {{__('messages.new_book')}}&nbsp;
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
                                        <a href="{{action('Backend\BookController@index')}}"
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
                            <form class="kt-form" id="kt_form" method="post" enctype="multipart/form-data"
                                  action="{{ action('Backend\BookController@store')}}">
                            @csrf
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="first_name"
                                                       class="col-lg-2 col-form-label">{{__('messages.name')}}*</label>
                                                <div class="col-lg-10">

                                                    <input id="name" type="text" name="title"
                                                           class="form-control @error('title') is-invalid @enderror"
                                                           value="{{old('name')}}">
                                                    @error('title')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">{{__('messages.book')}}
                                                    (.pdf)*</label>
                                                <div class="col-lg-10">
                                                    <div class="form-group">
                                                        <label class="btn btn-success" for="fileuploader-book">
                                                            {{__('messages.upload')}}
                                                        </label>
                                                        <span id="file_uploaded"></span>
                                                        @error('book')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="file" hidden
                                                           id="fileuploader-book"
                                                           name="book"
                                                           accept="application/pdf">
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

                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
    <?php
    $invalid_format = __('messages.invalid_format');
    ?>
    <script>
        $("#fileuploader-book").on('change', function () {
            var file = $(this)[0].files[0];
            if (!file) {
                return false
            }

            if (file.type !== 'application/pdf') {
                alert('{{$invalid_format}}'.replace(':format', 'pdf'));
                return false
            }

            $(".alert-danger").hide();

            var file_name_first = file.name;
            $("#file_uploaded").text(file_name_first);
        });
    </script>
@endsection
