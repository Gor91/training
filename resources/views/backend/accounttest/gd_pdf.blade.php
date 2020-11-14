@extends('layouts.pdf')
@section('content')
    @if(!empty($data['account']))
        <h4>
            {{$data['account']->name." ". $data['account']->surname." ".$data['account']->father_name}}
        </h4>
        <h4>
            {{__('messages.phone'). " - ".$data['account']->phone}}
        </h4>
    @endif

    <h3>
        {{__('messages.tests')}}
    </h3>

    @if(!empty($data['at']))
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('messages.name')}}</th>
                <th>{{__('messages.credit')}}</th>
                <th>{{__('messages.result')}}</th>
                <th>{{__('messages.count')}}</th>
            </tr>
            </thead>
            @foreach($data['at'] as $key=> $test)
                <tbody>
                <tr>
                    <td>{{$key+ 1}}</td>
                    <td>@if(!empty($test->course->name)){{$test->course->name}}@endif</td>
                    <td>@php if(!empty($test->course->credit)) echo html_entity_decode(creditNameByKey($test->course->credit)) @endphp
                    </td>
                    <td>@if(!empty($test->percent)){{$test->percent}}%@endif</td>
                    <td @if(!empty($test->count) && $test->count == 3) {{'class= table-danger'}}
                            @endif>@if(!empty($test->count)){{$test->count}}@endif
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    @endif
@endsection
