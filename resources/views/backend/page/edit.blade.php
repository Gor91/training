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
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.edit')}}&nbsp;
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
                                        <a href="{{action('Backend\MessageController@index')}}"
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
                            <form class="kt-form" id="kt_form" method="post"
                                  action="{{ action('Backend\PageController@update', $pages->id)}}" enctype="multipart/form-data">
                                @csrf
                                <input name="_method" type="hidden" value="PATCH">
                            {{--                            <input name="_method" type="hidden" value="PATCH">--}}
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="first_name"
                                                       class="col-lg-3 col-form-label">{{__('messages.title')}}*</label>
                                                <div class="col-lg-9">

                                                    <input id="name" type="text" name="title"
                                                           class="form-control" value="{{$pages->title}}">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="key" class="col-lg-3 col-form-label">{{__('messages.shortdescription')}}
                                                    *</label>
                                                <div class="col-lg-9">
                                                    <textarea id="key" type="text" name="homedescription"
                                                              class="form-control">{{$pages->homedescription}}</textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-3 col-form-label">{{__('messages.description')}}
                                                    *</label>
                                                <div class="col-lg-9">
                                                    <textarea id="value" name="description"
                                                              class="form-control p-5">{{$pages->description}}</textarea>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <p for="value"
                                                       class="col-lg-12 col-form-label font-weight-bold">{{__('messages.legalacts')}}
                                                    *</p>
                                                </div>
                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-6 col-form-label">{{__('messages.rules')}}
                                                    *</label>
                                                <div class="col-lg-6">
                                                    <input  type="file" name="rules"
                                                           value="{{old('rules')}}" multiple="multiple">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-6 col-form-label">{{__('messages.orders_of_decrees_presidential')}}
                                                    *</label>
                                                <div class="col-lg-6">
                                                    <input  type="file" name="orders_of_decrees_presidential"
                                                           value="{{old('orders_of_decrees_presidential')}}" multiple="multiple">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-6 col-form-label">{{__('messages.government_decisions')}}
                                                    *</label>
                                                <div class="col-lg-6">
                                                    <input  type="file" name="government_decisions"
                                                           value="{{old('government_decisions')}}" multiple="multiple">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-6 col-form-label">{{__('messages.health_care_orders')}}
                                                    *</label>
                                                <div class="col-lg-6">
                                                    <input  type="file" name="health_care_orders"
                                                           value="{{old('health_care_orders')}}" multiple="multiple">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="value"
                                                       class="col-lg-6 col-form-label">{{__('messages.sanitary_rules_and_norms')}}
                                                    *</label>
                                                <div class="col-lg-6">
                                                    <input  type="file" name="sanitary_rules_and_norms"
                                                           value="{{old('sanitary_rules_and_norms')}}" multiple="multiple">

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
@endsection
