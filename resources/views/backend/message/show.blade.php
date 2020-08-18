@extends('layouts.master')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet resume">
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
                    <p>@php echo html_entity_decode(\Session::get('success'), ENT_HTML5) @endphp</p>
                </div><br/>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <p>@php echo html_entity_decode(\Session::get('error'), ENT_HTML5) @endphp</p>
                </div>
            @endif
            @if (Session::has('delete'))
                <div class="alert alert-info">
                    <p>{{ Session::get('delete') }}</p>
                </div>
            @endif
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-email"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                   {{__('messages.message')}}
                                    &nbsp;&nbsp; </h3>
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

                    </div>
                </div>
            </div>
        </div>

            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col">
                        <!--Begin::Section-->
                        <div class="kt-portlet resume">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('messages.purpose')}}
                                    </h3>
                                </div>

                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget12">
                                    <div class="kt-widget3">
                                        <div class="kt-widget3__item">
                                            <div class="kt-widget3__body">
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.name')}}</h5>
                                                    @if(!empty($data->name))
                                                        <p class="kt-widget3__text">
                                                            {{$data->name}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.subject')}}</h5>
                                                    @if(!empty($data->value))
                                                        <p class="kt-widget3__text">
                                                            {{$data->value}}
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Section-->
                    </div>
                </div>

            </div>
        </div>
    <!-- end:: Content -->
@endsection
