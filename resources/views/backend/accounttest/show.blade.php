@extends('layouts.master')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label col-7">
                <h3 class="kt-portlet__head-title ">
                    {{__('messages.test').__('messages.i') .__('messages.result').__('messages.y')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar col-5">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm "
                                    title="change state" data-toggle="modal"
                                    data-target="#kt_modal_6"
                                    class="display float-lg-left btn-primary px-2 myButton">
                                <i class="fa fa-comments"></i>
                                {{__('messages.send_email')}}
                            </button>

                        </div>
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> {{__('messages.export')}}
                            </button>

                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">

                                    <li class="kt-nav__item">
                                        <a href="{{action('Backend\AccountTestController@gdPDFTest', ['a_id'=>$account->id, 'id'=>$id])}}"
                                           class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">{{__('messages.PDF')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="{{action('Backend\AccountController@index', "user")}}"
                           class="btn btn-warning btn-sm ">
                            <i class="la la-undo"></i>
                            {{__('messages.back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_widget2_tab1_content">
                    @php
                        $test = $tests['test'];
                        $tests = $tests['random_tests'];

                    @endphp
                    <div class="kt-widget2">
                        <h5>
                            @if(!empty($test->course->name)){{$test->course->name}}@endif
                        </h5>
                        <div class="kt-space-10"></div>
                        <div class="row">
                            <h6 class="col-3">
                                <i>
                                    @php
                                        if(!empty($test->course->credit))
                                            echo html_entity_decode(creditNameByKey($test->course->credit));
                                    @endphp
                                </i>
                            </h6>
                            <h6 class="col-3">
                                <ul>
                                    <li><i>
                                            @if(!empty($test->course->credit))
                                                {{__('messages.result')." - ".$test->percent.__('messages.percent')}}
                                            @endif
                                        </i></li>
                                    <li><i>
                                            @if(!empty($test->count))
                                                {{__('messages.count')." - ".$test->count}}
                                            @endif
                                        </i></li>
                                </ul>
                            </h6>
                        </div>
                        <div>
                            {{--@php--}}
                            {{--dd($test->course->test);--}}
                            {{--@endphp--}}
                            <div class="kt-widget2__info">

                                @if(!empty($tests))
                                    @foreach($tests as $key=>$v)
                                        <h5>{{($key+1).". ".$v->question}}</h5>
                                        <div class="kt-space-10"></div>
                                        @php
                                            $answers = json_decode($v->answers, true);
                                            $a_answers = (array)json_decode($test->test);

                                        @endphp
                                        <ul>
                                            @php
                                                $class = "";
                                                $isCheck = false;
                                                foreach ($answers as $k => $answer) {
                                                    if (!empty($answer['check'])) {
                                                        $class = "success";
                                                        $isCheck = true;
                                                    }
                                                    if (
                                                        array_key_exists($key + 1, (array)$a_answers[$k + 1]) && !$isCheck)
                                                        $class = "danger";
                                                    echo "<li><div  class='kt-widget2__title kt-widget2__item kt-widget2__item--" . $class . "'>" . html_entity_decode($answer['inp']) . "</div></li>";
                                                    $class = "";
                                                    $isCheck = false;
                                                }
                                            @endphp
                                        </ul>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle">{{__('messages.send_email')}} {{$account->user->email}}
                        հասցեին
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="kt-form" method="post" action="{{action('Backend\AccountTestController@sendAttachment')}}">
                        @csrf
                        <input type="hidden" name="email" value="{{$account->user->email}}">
                        <input type="hidden" name="id" value="{{$account->id}}">
                        <input type="hidden" name="name" value="{{$account->name." ".$account->surname}}">
                        <input type="hidden" name="test_id" value="{{$test->id}}">
                        <div class="form-group row">
                            <label for="subject"
                                   class=" col-lg-3 col-form-label text-capitalize">{{__('messages.topic')}}*:</label>
                            <div class="col-lg-12">
                                <input id="subject" type="text"
                                       name="subject" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message"
                                   class="text-right col-lg-4 col-form-label text-capitalize">{{__('messages.message')}}
                                *:</label>
                            <div class="col-lg-12">
                                        <textarea id="message" name="message"
                                                  class="form-control"
                                                  style="max-height: 200px; min-height: 200px; max-width: 100%; min-width: 100%"></textarea>
                            </div>
                        </div>
                            <div class="form-group row">

                                <div class="col-lg-12 row">
                                    <input type="checkbox" name="test" id="t" class="form-control col-1" style="max-height: 20px; min-height: 20px;">
                                    <label for="t" class="text-capitalize">{{__('messages.attach_test')}}</label>
                                </div>
                            </div>


                        <div class="form-group row justify-content-end">
                            <button type="submit"
                                    class="p-15 col-3 btn btn-primary align-self-end">{{__('messages.send')}}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
