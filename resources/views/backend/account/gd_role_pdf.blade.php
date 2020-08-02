@extends('layouts.pdf')
@section('content')

    <table >
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('messages.image_name')." ".__('messages.surname')." ".__('messages.father_name')}}</th>
            <th>{{__('messages.name')." ".__('messages.surname')." ".__('messages.father_name')}}</th>
            <th>{{__('messages.phone')}}</th>
            <th>{{__('messages.email')}}</th>
{{--            <th>{{__('messages.spec')}}</th>--}}
{{--            <th>{{__('messages.bday')}}</th>--}}
{{--            <th>{{__('messages.passport')}}</th>--}}
            <th>{{__('messages.home_address')}}</th>
            <th>{{__('messages.workplace_name')}}</th>
            <th>{{__('messages.work_address')}}</th>
            <th>{{__('messages.education')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datas as $key => $data)
<!--           --><?php //dd($data->profession);?>
            <tr>
                <td>{{$key +1}}</td>
                <td>
                    @php
                        $img = Config::get('constants.AVATAR_PATH_UPLOADED').'default.jpg';

                    @endphp
                    @if(file_exists(Config::get('constants.AVATAR_PATH').$data->image_name));
                    @php
                        $img = Config::get('constants.AVATAR_PATH').$data->image_name;

                    @endphp
                    @endif
                    <img class="kt-widget__img"
                         src="{{ asset($img)}}"
                         alt="image">

                </td>
                <td> {{$data->name." ".$data->surname." ".$data->father_name}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->user->email}}</td>
{{--                <td>{{$data->prof->profession}}</td>--}}
{{--                <td>{{$data->bday}}</td>--}}
{{--                <td>{{$data->passport}}</td>--}}
                <td>{{$data->w_region." ". $data->w_territory. " ".$data->w_street}}</td>
                <td>{{$data->workplace_name}}</td>
                <td>{{$data->h_region." ".$data->h_territory." ".$data->h_street}}</td>
                <td>{{$data->profession->edu_name." ".$data->profession->spec_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

