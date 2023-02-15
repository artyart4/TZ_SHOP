@extends('layouts.auth')
@section('title', 'забыл пароль')
@section('content')
    <x-forms.auth-forms title="забыл пароль" action="{{route('password.email')}}" method="POST" xmlns:x-slot="http://www.w3.org/1999/html"><form class="space-y-3">
            @csrf
            <x-forms.text-input :isError="$errors->has('email')" type="email" name="email" placeholder="email" required="true" />
            @error('email')
            <x-forms.error>
                {{$message}}
            </x-forms.error>
            @enderror

            <x-forms.primary-button>Отправить </x-forms.primary-button>

            <x-slot:buttons>
                <div class="space-y-3 mt-5">

                    <div class="text-xxs md:text-xs"><a href="{{route('login')}}" class="text-white hover:text-white/70 font-bold">Вход</a></div>
                </div>
            </x-slot:buttons>
            <x-slot:social></x-slot:social>
        </form></x-forms.auth-forms>
@endsection
