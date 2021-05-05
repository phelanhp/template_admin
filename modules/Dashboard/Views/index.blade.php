@extends('Base::layouts.master')

@section('content')
    @php var_dump(\Illuminate\Support\Facades\Lang::getLocale()) @endphp
@endsection
