@extends('layouts.pdf')
@section('content')
    <h3 class="kt-portlet__head-title">
        Օգտագործողների ցանկ
    </h3>

    <!--begin: Datatable -->
    <table border="1" align="center">
        <thead>
        <tr>
            <th>Անվանում</th>
            <th>Էլ. փոստ</th>
            <th>Գրանցման օրը</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @foreach($data as $key => $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>

                    <td>
                        {{$user->created_at}}
                    </td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <!-- end:: Content -->
@endsection
