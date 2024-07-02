{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('layouts.app')

@section('styles')
<style>
    /* Modal styles for simplicity */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
</style>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    {{-- <div class="row"> --}}
        {{-- <div class="content-header mb-40 justify-content-between">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Profile</h3>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body pull-up">
                <div class="media align-items-center">
                </div>
            </div>
        </div> --}}
                {{-- <div class="box-footer">
                    <a href="javascript:history.back()" class="btn btn-warning me-1">
                        <i class="ti-trash"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div> --}}

{{-- </section> --}}
<!-- /.content -->
<section class="content">
    <div class="col-12">
        <div class="card-header pb-0 d-flex justify-content-between">
            <h3 class="box-title">Profile</h3>
        </div>
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')

    </div>
</section>
@stop
