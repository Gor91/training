@extends('layouts.pdf')
@section('content')
    <h3 class="kt-portlet__head-title">
        {{__('messages.users_list')}}
    </h3>

    <!--begin: Datatable -->
    <table border="1" align="center">
        <thead>
        <tr>
            <th>{{__('messages.name')}}</th>
            <th>{{__('messages.created_at')}}</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @foreach($data as $key => $type)
                <tr>
                    <td>
                        {{$type->name}}
                    </td>
                    <td>
                        {{$type->created_at}}
                    </td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <!-- end:: Content -->
@endsection
