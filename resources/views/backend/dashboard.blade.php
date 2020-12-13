@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-6">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            Մասնակիցներ
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="kt_gchart_3" style="height:300px;"></div>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
        <div class="col-lg-6">

            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            Դասընթացների տեսակներ
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="kt_gchart_1" style="height:300px;"></div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            Դասընթացներ
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Դասընթաց</th>
                            <th>Դիտումների քանակ</th>
                            <th>Վճարովի/Անվճար</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$courses->isEmpty())
                            @foreach($courses as $key => $course)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->total}}</td>
                                    <td>{{$course->isPaid ? 'Վճարովի' : 'Անվճար'}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>

            </div>
            <!--end::Portlet-->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            Մասնակիցների արդյունքները
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="kt-portlet__body">
                            <div id="kt_gchart_4" style="height:300px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="kt-portlet__body">
                            <div id="kt_gchart_5" style="height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            Ըստ մարզերի աշխատավայրերի
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-hover table-checkable">
                        <thead>
                        <tr>
                            <th>Մարզ</th>
                            <th>Աշխատավայր</th>
                            <th>Դիմորդների քանկը</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($workplace_region))
                            @foreach($workplace_region as $key => $region)
                                <tr class="text-center">
                                    <td rowspan="{{count((array)$region['workplace'])+1}}">{{$region['region']}}</td>
                                </tr>
                                @foreach($region['workplace'] as $workplace)
                                    <tr>
                                        <td>{{$workplace['workplace_name']}}</td>
                                        <td>{{$workplace['total']}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection

@section('stylesheets')

@endsection

@section('script')
    <script src="https://www.google.com/jsapi" type="text/javascript"></script>
    <script src="{{asset('js/charts/google-charts.js')}}" type="text/javascript"></script>
@endsection
