@extends('layouts.app')
@section('content')
    <x-content-title>Preferences</x-content-title>
    <x-breadcrumbs></x-breadcrumbs>
    <div class="row">
        <div class="grid grid-cols-1 mb-5">
            <div class="bg-white text-sm border border-gray-200 border-t-0 dark:border-gray-900 dark:bg-gray-800">
                <ul class="grid w-full gap-2 mb-4 p-5">
                    <li>
                        <a class="font-medium text-gray-600 dark:text-gray-500 hover:underline"
                            href="{{ route('dosen.edit', ['dosen' => Auth::user()->dosen->id]) }}">Edit
                            Profile</a>
                    </li>
                    <li>
                        <a class="font-medium text-gray-600 dark:text-gray-500 hover:underline"
                            href="{{ route('dosen.editPassword', ['user' => Auth::user()->id]) }}">Ganti
                            Password</a>
                    </li>

                </ul>

            </div>


        </div>


    </div>
@endsection
