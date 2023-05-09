@extends('layout.client')
@section('content')
    <section class="content">
        
        <register-form
            :data="{{ json_encode([
                'urlStore' => route('register.store'),
                'urlBack' => route('login.create'),
                'urlCheckEmail' => route('register.checkMail'),
            ]) }}">
        </register-form>
    </section>
@endsection
