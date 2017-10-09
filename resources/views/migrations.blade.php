@extends('vendor.installer.layouts.master')

@section('title', trans('installer::messages.migrations.title'))
@section('container')

    <ul class="list">
        @foreach($migrations as $class)
            <li class="list__item success">{{ $class }}</li>
        @endforeach
    </ul>

    @if(!isset($permissions['errors']))
        <div class="buttons">
            <a class="button" href="{{ route('LaravelInstaller::admin') }}">
                {{ trans('installer::messages.next') }}
            </a>
        </div>
    @endif

@stop