@extends('layouts.pdf')
@section('content')
    <h3>
        {{__('messages.user_info')}}
    </h3>

    <!--begin: Datatable -->
    <table>
        <tbody>
        <tr>
            <td>
                <img class="kt-widget__img"
                     src="{{ asset(Config::get('constants.AVATAR_PATH_UPLOADED').$data->image_name)}}"
                     alt="image">

            </td>
            <td>
                <h4 class="text-blue">
                    {{$data->name." ".$data->surname." ".$data->father_name}}
                </h4>

                <p>
                    {{$data->user->email}}
                </p>
                <p>
                    {{$data->phone}}
                </p>
                <p>
                    {{$data->prof->profession}}
                </p>
            </td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th>{{__('messages.bday')}}</th>
            <th>{{__('messages.gender')}}</th>
            <th>{{__('messages.married_status')}}</th>
            <th>{{__('messages.passport')}}</th>
            <th>{{__('messages.date_of_issue')}}</th>
            <th>{{__('messages.date_of_expiry')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$data->bday}}</td>
            <td>{{$data->gender}}</td>
            <td>{{$data->married_status}}</td>
            <td>{{$data->passport}}</td>
            <td>{{$data->date_of_issue}}</td>
            <td>{{$data->date_of_expiry}}</td>

        </tr>
        </tbody>
    </table>
     <h4 class="dotted">
        {{__('messages.home_address')}}

    </h4>
    <table>
        <thead>
        <tr>
            <th>{{__('messages.region')}}</th>
            <th>{{__('messages.territory')}}</th>
            <th>{{__('messages.street')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$data->w_region}}</td>
            <td>{{$data->w_territory}}</td>
            <td>{{$data->w_street}}</td>

        </tr>
        <tr>
            <td colspan="3">
                 <h4 class="dotted">
                    {{__('messages.work_address')}}`
                    {{$data->workplace_name}}
                </h4>
            </td>
        </tr>
        <tr>
            <td>{{$data->h_region}}</td>
            <td>{{$data->h_territory}}</td>
            <td>{{$data->h_street}}</td>

        </tr>

        </tbody>
    </table>
     <h4 class="dotted">
        {{__('messages.education')}}
    </h4>
    <table>
        <thead>
        <tr>
            <th>{{__('messages.edu')}}</th>
            <th>{{__('messages.prof')}}</th>
            <th>{{__('messages.spec')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$data->profession->edu_name}}</td>
            <td>{{$data->profession->spec_name}}</td>
            <td>{{$data->profession->name}}</td>

        </tr>
        </tbody>
    </table>
   <h4>{{__('messages.diplomas')}}</h4>
    <!-- end:: Content -->
    @if(!empty($data->prof->diplomas))
        @php
            $diplomas = json_decode($data->prof->diplomas, true);
        @endphp
        @foreach($diplomas as $diploma)
            <img src="{{asset(\Illuminate\Support\Facades\Config::get('constants.DIPLOMA').$diploma)}}"
                 alt="diploma" class="diploma">
        @endforeach
    @endif
@endsection
