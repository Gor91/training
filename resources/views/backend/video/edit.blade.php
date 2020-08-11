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
                                   {{__('messages.add')}} {{__('messages.new_video')}}&nbsp;
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
                                        <a href="{{action('Backend\VideoController@index')}}"
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
                                  action="{{ action('Backend\VideoController@update', $video->id)}}">
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
                                                           value="{{$video->title}}">
                                                    @error('title')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="first_name"
                                                       class="col-lg-2 col-form-label">{{__('messages.lecture')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <select class="js-example-basic-multiple form-control @error('lecture') is-invalid @enderror"
                                                            name="lecture">
                                                        @if(isset($lectures))
                                                            @foreach($lectures as $lecture)
                                                                <option @if ($video->lectures_id == $lecture['id']) selected @endif value="{{$lecture['id']}}">
                                                                    {{$lecture['name']}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('lectures_id')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email"
                                                       class="col-lg-2 col-form-label">{{__('messages.video')}}
                                                    *</label>
                                                <div class="col-lg-10">
                                                    <div class="kt-section kt-section--last">
                                                        <div class="kt-section__content">
                                                            <div class="progress fileupload-progress" hidden>
                                                                <div id="progress-bar"
                                                                     class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                     role="progressbar" aria-valuenow="0"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" style="width: 0">0
                                                                </div>
                                                            </div>
                                                            <small class="text-muted progress-extended"
                                                                   hidden>{{__('messages.loading')}}</small>
                                                            <div class="kt-space-10"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="btn btn-success" for="fileuploader-video">
                                                            {{__('messages.upload')}}
                                                        </label>
                                                        <label id="cancel" class="btn btn-warning"
                                                               hidden>{{__('messages.cancel')}}</label>
                                                        <label id="remove" class="btn btn-danger"
                                                               hidden>{{__('messages.remove')}}</label>
                                                        @error('video')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden"
                                                           id="name_video"
                                                           name="path">
                                                    <input type="hidden"
                                                           id="duration"
                                                           name="duration">

                                                    <video id="video" class="view-video col-lg-10" controls>
                                                        <source src="{{sprintf("%s/%s",env('AWS_URL_ACL'),$video->path)}}"
                                                                type="video/mp4">
                                                        {{__('messages.not_support_html5_video')}}
                                                    </video>
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
                            <input type="file" hidden
                                   id="fileuploader-video"
                                   name="video"
                                   accept="video/*">
                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
    <?php
    $uniqueId = uniqid();
    $ACCESS_KEY_ID = env('AWS_ACCESS_KEY_ID');
    $SECRET_ACCESS_KEY = env('AWS_SECRET_ACCESS_KEY');
    $DEFAULT_REGION = env('AWS_DEFAULT_REGION');
    $BUCKET = env('AWS_BUCKET');
    $BUCKET_URL = env('AWS_URL_ACL');
    $confirm_message = __(('messages.confirm_message'));
    $invalid_format = __(('messages.invalid_format'));
    ?>
    <script>
        var file_name = '';
        var up = null;

        $("#fileuploader-video").on('change', function () {
            var file = $(this)[0].files[0];
            if (!file) {
                return false
            }

            if (file.type !== 'video/mp4') {
                alert('{{$invalid_format}}');
                return false
            }

            $(".alert-danger").hide();
            $("video.view-video").hide();
            $("video").attr("src", "");
            $("#name_video").val('');
            $("#progress-bar").text('0');
            $('.progress-bar-striped').css('width', 0);
            $(".progress").removeAttr('hidden');
            $(".progress").show();
            $(".progress-extended").removeAttr('hidden');
            $(".progress-extended").show();
            $("#cancel").removeAttr('hidden');
            $("#cancel").removeAttr('style');

            AWS.config.update({
                accessKeyId: '{{$ACCESS_KEY_ID}}',
                secretAccessKey: '{{$SECRET_ACCESS_KEY}}',
                region: '{{$DEFAULT_REGION}}'
            });

            var s3bucket = new AWS.S3({params: {Bucket: '{{$BUCKET}}', ACL: 'public-read'}});

            var file_name_first = file.name;
            file_name = "{{$uniqueId}}" + "_" + file_name_first;

            var file_key = "videos/" + file_name;
            var params = {Key: file_key, ContentType: file.type, Body: file};

            up = s3bucket.upload(params, function (err, data) {
            });

            up.on('httpUploadProgress', function (progress) {
                var prog_percent = parseInt(progress.loaded / progress.total * 100, 10);
                $('.progress-extended').text(file_name_first + ' | ' + prog_percent + '% | ' + progress.loaded + "{{__('messages.video_of')}}" + progress.total + "{{__('messages.video_bytes')}}");
                $('.progress-bar-striped').css('width', prog_percent + '%');
                $('#progress-bar').text(prog_percent + '%');
                $('.progress-bar').attr('aria-valuenow', prog_percent);

                if (prog_percent === 100) {
                    $(".progress").hide();
                    $(".progress-extended").hide();
                    $("#name_video").val(file_key);
                    $("#remove").removeAttr('hidden');
                    $("#remove").show();
                    $("#cancel").hide();

                    setTimeout(function () {
                        $("video").attr("src", '{{$BUCKET_URL}}' + '/' + progress.key);
                        $("video.view-video").removeAttr('hidden');
                        $("video.view-video").css('display', 'block');
                    }, 3000)
                }
            });
            up.send();
        });

        $(document).on('click', '#cancel', function () {
            if (up) {
                try {
                    up.abort();
                } catch (e) {
                }

                $(".progress-extended").hide();
                $(".fileupload-progress").hide();
                $(this).hide();
            }
        });

        $(document).on('click', '#remove', function () {
            removeVideo('pose', file_name);
        });

        function removeVideo() {
            var name_video = $("#name_video").val();

            if ($("#name_video").val() && confirm('{{$confirm_message}}')) {
                $("video.view-video").hide();
                $("video").attr("src", "");
                $("#name_video").val('');
                $(".fileupload-progress").hide();
                $("#remove").hide();
                $(this).hide();

                $.ajax({
                    method: 'POST',
                    url: '/delete-video',
                    data: {'name': name_video, '_token': $('input[name=_token]').val()},
                    success: function (data) {
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            }
        }

        $("#kt_form").submit(function () {
            $('#duration').val(document.getElementById('video').duration);
        });
    </script>
@endsection
