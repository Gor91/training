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
											<i class="kt-font-brand flaticon2-lock"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                   {{__('messages.log')}}
                                    &nbsp;&nbsp; </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">

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
                                    {{__('messages.description')}}
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget12">
                                <div class="kt-widget3">
                                    <h5 class="kt-widget3__text--bold text-uppercase">
                                        @if(!empty($log->account->name) || !empty($log->account->surname || !empty($log->account->father_name)))
                                            <p class="kt-widget3__text">
                                                {{$log->account->name." ".$log->account->surname." ".$log->account->father_name}}
                                            </p>
                                        @endif
                                    </h5>

                                    @if(!empty($log->admin->name))
                                        <p><u>{{$log->created_at}}</u><em>{{" ".$log->admin->name}}</em></p>
                                    @endif
                                </div>

                                <div class="kt-widget3__text--bold ">

                                    <h5 class="kt-widget3__text--bold text-uppercase"><u>{{$log->subject}}</u></h5><br>
                                    <h6 class="kt-widget3__text--bold text-uppercase">{{__('messages.subject')}}</h6>
                                    @if(!empty($log->message))
                                        <p class="kt-widget3__text">
                                            {{$log->message}}
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
