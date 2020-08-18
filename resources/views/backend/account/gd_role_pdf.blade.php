@extends('layouts.pdf')
@section('content')

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('messages.image_name')." ".__('messages.surname')." ".__('messages.father_name')}}</th>
            <th>{{__('messages.name')." ".__('messages.surname')." ".__('messages.father_name')}}</th>
            <th>{{__('messages.phone')}}</th>
            <th>{{__('messages.email')}}</th>
            <th>{{__('messages.home_address')}}</th>
            <th>{{__('messages.workplace_name')}}</th>
            <th>{{__('messages.work_address')}}</th>
            <th>{{__('messages.education')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $d)

            <tr>
                <td>{{$key +1}}</td>
                <td>
                    @php
                        $img = Config::get('constants.AVATAR_PATH_UPLOADED').'default.jpg';

                    @endphp
                    @if(file_exists(Config::get('constants.AVATAR_PATH').$d->image_name));
                    @php
                        $img = Config::get('constants.AVATAR_PATH').$d->image_name;

                    @endphp
                    @endif
                    <img class="kt-widget__img"
                         src="{{ asset($img)}}"
                         alt="image">

                </td>
                <td> @if(!empty($d->name) && !empty($d->surname) && !empty($d->father_name))
                        {{$d->name." ".$d->surname." ".$d->father_name}}@endif</td>
                <td>@if(!empty($d->phone))
                        {{$d->phone}}@endif</td>
                <td>@if(!empty($d->email))
                        {{$d->user->email}}@endif</td>

                <td>@if(!empty($d->w_region) && !empty($d->w_territory) && !empty($d->w_street))
                        {{$d->w_region." ". $d->w_territory. " ".$d->w_street}}@endif</td>
                <td>@if(!empty($d->workplace_name)){{$d->workplace_name}}@endif</td>
                <td>@if(!empty($d->h_region) && !empty($d->h_territory) && !empty($d->h_street))
                        {{$d->h_region." ".$d->h_territory." ".$d->h_street}}@endif</td>
                <td>@if(!empty($d->profession->edu_name) && !empty($d->profession->spec_name))
                    {{$d->profession->edu_name." ".$d->profession->spec_name}}@endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>

