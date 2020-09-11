@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-notes"></i>
                                    {{__('messages.new_course')}}&nbsp;
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
                                        <a href="{{action('Backend\CoursesController@index')}}"
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
                                  action="{{isset($course) ? action('Backend\CoursesController@update',$course->id) : action('Backend\CoursesController@store')}}">
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
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           value="{{isset($course) ?  $course->name : old('name')}}">
                                                    @error('name')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="special"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_list')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control @error('specialty_ids') is-invalid @enderror"
                                                            id="special"
                                                            name="specialty_ids[]" multiple="multiple">
                                                        @if(isset($course))
                                                            @for ($i = 0; $i < count($course->specialities); $i++)
                                                                <option selected
                                                                        value="{{$course->specialities[$i]["id"]}}">
                                                                    {{$course->specialities[$i]["name"]}}
                                                                </option>
                                                            @endfor
                                                        @endif
                                                        @if(!empty(old('specialty_ids')))
                                                            @foreach (old('specialty_ids') as $s_id)
                                                                <option selected
                                                                        value="{{$s_id}}">
                                                                    {{$speciality->getNameById($s_id)}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('specialty_ids')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="status"
                                                       class="col-lg-2 col-form-label">{{__('messages.course_status')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control @error('status') is-invalid @enderror"
                                                            id="status"
                                                            name="status">
                                                        <option {{isset($course) && $course->status == "active" || old('status')=="active" ?  'selected' : ''}}
                                                                value="active">{{__('messages.course_status_active')}}</option>
                                                        <option {{isset($course) && $course->status == "archive" || old('status')=="archive" ?  'selected' : ''}}
                                                                value="archive">{{__('messages.course_status_deactive')}}</option>
                                                    </select>
                                                    @error('status')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">{{__('messages.course_start_date')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <div class="input-group date">
                                                        <input id="kt_datepicker_3" type="text" readonly
                                                               name="start_date"
                                                               placeholder="{{__('messages.course_date_format')}}"
                                                               value="{{isset($course) ? date('m/d/Y', strtotime($course->start_date)) : old('start_date')}}"
                                                               class="form-control @error('start_date') is-invalid @enderror">
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar"></i>
														</span>
                                                        </div>
                                                        @error('start_date')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">{{__('messages.course_end_date')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <div class="input-group date">
                                                        <input id="kt_datepicker_3" type="text" name="end_date"
                                                               readonly
                                                               placeholder="{{__('messages.course_date_format')}}"
                                                               value="{{isset($course) ? date('m/d/Y', strtotime($course->end_date)) : old('end_date')}}"
                                                               class="form-control @error('end_date') is-invalid @enderror">
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar"></i>
														</span>
                                                        </div>
                                                        @error('end_date')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="duration"
                                                       class="col-lg-2 col-form-label">{{__('messages.duration')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <input id="duration" type="number" name="duration"
                                                           value="{{isset($course) ? $course->duration : old('duration')}}"
                                                           class="form-control @error('duration') is-invalid @enderror">
                                                    @error('duration')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @foreach($credit_types as $c_key => $credit_type)
                                                <div class="form-group row">
                                                    <label for="credit_theoretical"
                                                           class="col-lg-2 col-form-label">{{__('messages.course_credit')}}
                                                        {{$credit_type['key'] == 'theoretical'? '*':''}}</label>
                                                    <div class="col-lg-5">
                                                        <input id="{{sprintf('credit_%s', $credit_type['key'])}}"
                                                               type="number"
                                                               name="{{sprintf('credit[%d][credit]', $c_key)}}"
                                                               value="{{isset($course) ? $course->creditByKey($credit_type['key']) : (old('credit')?old('credit')[$c_key]['credit']:'')}}"
                                                               class="form-control @error(sprintf('credit.%d.credit', $c_key)) is-invalid @enderror">
                                                        <input type="hidden"
                                                               name="{{sprintf('credit[%d][name]', $c_key)}}"
                                                               value="{{$credit_type['key']}}">
                                                        @error(sprintf('credit.%d.credit', $c_key))
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <input readonly
                                                               value="{{__(sprintf('messages.%s',$credit_type['key']))}}"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="form-group row">
                                                <label for="cost"
                                                       class="col-lg-2 col-form-label">{{__('messages.cost')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <input id="cost" type="number" name="cost"
                                                           value="{{isset($course) ? $course->cost : old('cost')}}"
                                                           class="form-control @error('cost') is-invalid @enderror">
                                                    @error('cost')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="course_videos"
                                                       class="col-lg-2 col-form-label">{{__('messages.videos')}}</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control @error('videos') is-invalid @enderror"
                                                            id="course_videos" name="videos[]" multiple="multiple">
                                                        @if($videos)
                                                            @foreach ($videos as $video)
                                                                <option {{isset($course) && !empty($course->videos) &&
                                                                 in_array($video->id, json_decode($course->videos)?:[]) ||
                                                                 in_array($video->id, old('videos',[])) ?  'selected' : ''}}
                                                                        value="{{$video->id}}">{{$video->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('videos')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="course_books"
                                                       class="col-lg-2 col-form-label">{{__('messages.books')}}</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control @error('books') is-invalid @enderror"
                                                            id="course_books" name="books[]" multiple="multiple">
                                                        @if($books)
                                                            @foreach ($books as $book)
                                                                <option {{isset($course) && !empty($course->books) &&
                                                                 in_array($book->id, json_decode($course->books)?:[]) ||
                                                                 in_array($book->id, old('books',[])) ?  'selected' : ''}}
                                                                        value="{{$book->id}}">{{$book->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('books')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content_data"
                                                       class="col-lg-2 col-form-label">{{__('messages.content')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <textarea id="content_data" type="text" name="content_data"
                                                              class="form-control froala-editor @error('content_data') is-invalid @enderror">{{isset($course) ? $course->content : old('content_data')}}</textarea>
                                                    @error('content_data')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
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
