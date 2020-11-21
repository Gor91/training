@extends('layouts.master')
@section('content')
    <?php
    $show = false;

    if (!empty($course->coordinates)) {
        $show = true;
        $coordinates = json_decode($course->coordinates);
        $cert_name_x = $coordinates->name->x;
        $cert_name_y = $coordinates->name->y;
        $cert_start_date_x = $coordinates->start_date->x;
        $cert_start_date_y = $coordinates->start_date->y;
        $cert_end_date_x = $coordinates->end_date->x;
        $cert_end_date_y = $coordinates->end_date->y;
    }

    ?>
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
                                                <label for="cert_1" class="col-lg-2 col-form-label">
                                                    1 Անուն Կոորդինատ </label>
                                                <div class="col-lg-5">
                                                    <input id="cert_1"
                                                           type="radio" checked
                                                           name="coord_cert"
                                                           value="1"
                                                           class="form-control">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input readonly name="coord[name]"
                                                           value="{{$show?sprintf('%d,%d', $cert_name_x, $cert_name_y):'0,0'}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cert_2" class="col-lg-2 col-form-label">
                                                    2 Մեկնարկի Ամս․ </label>
                                                <div class="col-lg-5">
                                                    <input id="cert_2"
                                                           type="radio"
                                                           name="coord_cert"
                                                           value="2"
                                                           class="form-control">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input readonly name="coord[start_date]"
                                                           value="{{$show?sprintf('%d,%d', $cert_start_date_x, $cert_start_date_y):'0,0'}}"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cert_3" class="col-lg-2 col-form-label">
                                                    3 Ավարտի Ամս․ </label>
                                                <div class="col-lg-5">
                                                    <input id="cert_3"
                                                           type="radio"
                                                           name="coord_cert"
                                                           value="3"
                                                           class="form-control">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input readonly name="coord[end_date]"
                                                           value="{{$show?sprintf('%d,%d', $cert_end_date_x, $cert_end_date_y):'0,0'}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-10">
                                                    <div class="form-group">
                                                        <label class="btn btn-success" for="fileuploader-image">
                                                            Բեռնել դիպլոմ
                                                        </label>
                                                        <span id="file_uploaded"></span>
                                                        @error('book')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="file" hidden
                                                           id="fileuploader-image"
                                                           name="certificate"
                                                           accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div id="show_cert_image"
                                                     {{$show?'':'hidden'}} style="position: relative">
                                                    <div id="pos_1"
                                                         style="position:absolute;{{$show?sprintf('top: %dpx; left: %dpx;',$cert_name_y, $cert_name_x):'bottom: 0;'}} border-radius: 50%; text-align: center; color: #FFFFFF; width: 20px;height: 20px;background-color: black">
                                                        1
                                                    </div>
                                                    <div id="pos_2"
                                                         style="position:absolute; {{$show?sprintf('top: %dpx; left: %dpx;',$cert_start_date_y,$cert_start_date_x):'bottom: 0; left: 20px;'}} border-radius: 50%; text-align: center; color: #FFFFFF; width: 20px;height: 20px;background-color: black">
                                                        2
                                                    </div>
                                                    <div id="pos_3"
                                                         style="position:absolute; {{$show?sprintf('top: %dpx; left: %dpx;', $cert_end_date_y, $cert_end_date_x):'bottom: 0; left: 40px;'}} border-radius: 50%; text-align: center; color: #FFFFFF; width: 20px;height: 20px;background-color: black">
                                                        3
                                                    </div>
                                                    <img id="view_image"
                                                         alt="certificats"
                                                         src="{{$show?asset(sprintf('uploads/diplomas/%s', $course->certificate)):''}}"
                                                         style="cursor: crosshair; width: 100%; height: 100%">
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

@section('script')
    <script>
        $(document).ready(function () {
            var coord_checked = 0;
            var img = $('#view_image');
            var xdeg;
            var ydeg;

            img.click(function (e) {
                coord_checked = $("[name='coord_cert']:checked").val();

                if (coord_checked == 1) {
                    xdeg = e.offsetX;
                    ydeg = e.offsetY;
                    $("[name='coord[name]']").val(xdeg + ',' + ydeg);
                } else if (coord_checked == 2) {
                    xdeg = e.offsetX;
                    ydeg = e.offsetY;
                    $("[name='coord[start_date]']").val(xdeg + ',' + ydeg);
                } else if (coord_checked == 3) {
                    xdeg = e.offsetX;
                    ydeg = e.offsetY;
                    $("[name='coord[end_date]']").val(xdeg + ',' + ydeg);
                }

                if (coord_checked) {
                    $('#pos_' + coord_checked).css({"top": +(ydeg - 10) + 'px', "left": +(xdeg - 10) + 'px'})
                }
            });
        });
    </script>
@endsection
