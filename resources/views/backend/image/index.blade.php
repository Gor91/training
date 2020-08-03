@extends('layouts.master')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
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
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-admins-1"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{__('messages.images')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{action('Backend\ImageController@create')}}"
                               class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{__('messages.add')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="container">
                    <div class="row">

                        <!--begin: Datatable -->
                        @if($images)
                            @foreach($images as $image)
                                <div class="col-md-2 gallery__item">
                                    <img class="gallery__item__img"
                                         src="{{sprintf("%s/%s", env('AWS_URL_ACL'),$image )}}" alt="">
                                    <div class="gallery__item__copy">
                                        <input value="{{sprintf("%s/%s", env('AWS_URL_ACL'),$image )}}"
                                               type="text" class="form-control" readonly>
                                        <button type="button" onclick="copyLink(this)" class="btn btn-primary  ml-2"
                                                title="{{__('messages.copy_link')}}">
                                            <i class="flaticon2-copy"></i>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                    </div>
                </div>
            @endif
            <!--end: Datatable -->
            </div>
        </div>
    </div>
    <script>
        function copyLink(self) {
            $(self).prev('input[type=text]').select();
            document.execCommand("copy");
        }
    </script>
@endsection
