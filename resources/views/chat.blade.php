@extends('layouts.app')

@section('content')
    <div class="container">
        <chat-component :user="{{ $user }}" :auth="{{ auth()->user() }}"></chat-component>
    </div>
@endsection
