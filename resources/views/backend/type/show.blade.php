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
											<i class="kt-font-brand flaticon-book"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    {{__('messages.type')}}
                                    &nbsp;&nbsp; </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions"> &nbsp;
                                        <a href="{{action('Backend\TypeController@index')}}"
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
                    <div class="kt-portlet ">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @if(!empty($type->name))
                                        <img src="">{{$type->name}}
                                    @endif
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget12">

                                <div class="kt-widget3__text--bold ">


                                    <h6 class="kt-widget3__text--bold text-uppercase">{{__('messages.description')}}</h6>
                                    @if(!empty($type->description))
                                        <p class="kt-widget3__text">
                                            {{$type->description}}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <!--End::Section-->
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- end:: Content -->
@endsection
