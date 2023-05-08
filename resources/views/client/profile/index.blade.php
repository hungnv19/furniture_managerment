@extends('client.layouts.client')
@section('content')
    <br>

    <user-profile
        :data="{{ json_encode([
            'user' => $user,
            'urlBack' => route('home'),
            'urlUpdate' => route('profile-update'),
        ]) }}">
    </user-profile>
    <br>
@endsection
