@extends('errors::minimal')

@section('code', '401')
@section('title', '401')

@section('image')
    <div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, url has been expired or deleted.'))