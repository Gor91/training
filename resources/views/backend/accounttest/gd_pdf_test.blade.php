@extends('layouts.pdf')
@section('content')

    <h3>
        {{__('messages.test')}}
    </h3>
    @php
        $test = $data['random_tests'];
        $data = $data['test'];

    @endphp
    @if(!empty($data->account))
        <h4>
            {{$data->account->name." ". $data->account->surname." ".$data->account->father_name}}
        </h4>
        <h4>
            {{__('messages.phone'). " - ".$data->account->phone}}
        </h4>
    @endif
    @if(!empty($data))
        <h4>
            @if(!empty($data->course->name)){{$data->course->name}}@endif
        </h4>

        <h6>
            <i>
                @php
                    if(!empty($data->course->credit))
                        echo html_entity_decode(creditNameByKey($data->course->credit));
                @endphp
            </i>
        </h6>
        <h6>
            <ul>
                <li><i>
                        @if(!empty($data->course->credit))
                            {{__('messages.result')." - ".$data->percent.__('messages.percent')}}
                        @endif
                    </i></li>
                <li><i>
                        @if(!empty($data->count))
                            {{__('messages.count')." - ".$data->count}}
                        @endif
                    </i></li>
            </ul>
        </h6>

        @if(!empty($test))
            @foreach($test as $key=>$v)
                <h5>{{($key+1).". ".$v->question}}</h5>

                @php
                    $answers = json_decode($v->answers, true);
                    $a_answers = (array)json_decode($data->test);
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
                                                      echo "<li class='$class'>" . html_entity_decode($answer['inp']) . "</li>";
                                                      $class = "";
                                                      $isCheck = false;
                                                  }
                    @endphp
                </ul>
            @endforeach
        @endif
    @endif
@endsection
