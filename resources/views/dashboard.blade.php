@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="col-xl-8 col-12">
    <div class="box bg-primary-light">
        <div class="box-body d-flex px-0">
            <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/custom-1.svg)">
                    <h2>Welcome back, <strong>{{$user->name}}</strong></h2>

                    <p class="text-dark my-10 fs-16">
                        You have <strong class="text-warning">{{count($user->notes)}}</strong> notes.
                    </p>
            </div>
        </div>
    </div>
</div>

@stop
