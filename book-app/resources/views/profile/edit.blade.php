@extends('layouts.app')

@section('title', 'Profile Page')

@section('content') 

@if(session('error'))
    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
@endif 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))
            <div class="bg-indigo-500 text-white text-center p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.upload-profile-picture')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>  
        </div>
    </div>
@endsection

