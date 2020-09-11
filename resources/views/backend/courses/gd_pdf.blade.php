@extends('layouts.pdf')
@section('content')
    <h3 class="kt-portlet__head-title">
        {{__('messages.courses')}}
    </h3>

    <!--begin: Datatable -->
    <table border="1" align="center">
        <thead>
        <tr>
            {!! implode(array_map(function ($item) {
                    return "<th>{$item}</th>";
                 }, $data->getModel()->headings()))!!}
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @foreach($data->all() as $course)
                <tr>
                    {!! implode(array_map(function ($item) {
                    return "<td>{$item}</td>";
                 }, $data->getModel()->exportData($course)))!!}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <!-- end:: Content -->
@endsection
