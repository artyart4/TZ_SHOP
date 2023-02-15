@extends('layouts.auth')
@section('title', 'восстановление пароля')
@section('content')
    <x-forms.auth-forms title="восстановление пароля"  value="{{request('email')}}" action="{{route('password.update')}}" method="POST" xmlns:x-slot="http://www.w3.org/1999/html">
            @csrf

            <input type="hidden" name="token" value="{{$token}}"/>
            <x-forms.text-input :isError="$errors->has('email')" type="email" name="email" placeholder="email" required="true" />
            @error('email')
            <x-forms.error>
                {{$message}}
            </x-forms.error>
            @enderror



            <x-forms.text-input :isError="$errors->has('password')" type="password" name="password" placeholder="password" required="true" />
            @error('password')
            <x-forms.error>
                {{$message}}
            </x-forms.error>
            @enderror

            <x-forms.text-input :isError="$errors->has('password_confirmation')" type="password" name="password_confirmation" placeholder="password_confirmation" required="true" />
            @error('password_confirmation')
            <x-forms.error>
                {{$message}}
            </x-forms.error>
            @enderror
 <x-slot:social></x-slot:social>
 <x-slot:buttons></x-slot:buttons>
        <x-forms.primary-button>Изменить пароль</x-forms.primary-button>



     </x-forms.auth-forms>
@endsection
