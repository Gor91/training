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
                                    {{__('messages.courses')}}
                                    &nbsp;&nbsp; </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions"> &nbsp;
                                        <a href="{{action('Backend\CoursesController@index')}}"
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
                                    {{__('messages.course')}} {{$course->name}}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.course_list')}}</h3>
                                        <span class="kt-widget1__desc">
                                            @if($course->specialities)
                                                @foreach($course->specialities as $key => $speciality)
                                                    @if($speciality)
                                                        <span class="kt-widget1__title">
                                                            {{$speciality['name']}}
                                                        </span><br/>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.course_status')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {{$course->status == "active" ? __('messages.course_status_active') : __('messages.course_status_archive')}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.course_start_date')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {{date('d-m-Y', strtotime($course->start_date))}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.course_end_date')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {{date('d-m-Y', strtotime($course->end_date))}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.duration')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {{$course->duration}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.course_credit')}}</h3>
                                        <span class="kt-widget1__desc">
                                             @if($course->credit)
                                                <?php $credits = (array)json_decode($course->credit);?>
                                                @foreach($credits as $key => $credit)
                                                    @if($credit)
                                                        <span class="kt-widget1__title">
                                                {{__(sprintf('messages.%s', $credit->name))}}
                                            </span>
                                                        <span class="kt-widget1__title">
                                                    {{$credit->credit}}
                                            </span><br/>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.cost')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {{$course->cost}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.videos')}}</h3>
                                        @if(isset($course->video_list))
                                            @foreach($course->video_list as $video)
                                                <br/>
                                                <div class="col-lg-4">
                                                    <span class="kt-widget1__title">
                                                        {{$video['title']}}
                                                    </span>
                                                    <video class="view-video" controls>
                                                        <source src="{{$video['src']}}"
                                                                type="video/mp4">
                                                        {{__('messages.not_support_html5_video')}}
                                                    </video>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.books')}}</h3>
                                        @if(isset($course->book_list))
                                            @foreach($course->book_list as $book)
                                                <br/>
                                                <a target="_blank" class="kt-widget1__title text text-info"
                                                   href="{{$book['src']}}">{{$book['title']}}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{__('messages.content')}}</h3>
                                        <span class="kt-widget1__desc">
                                            {!! $course->content !!}
                                        </span>
                                    </div>
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
