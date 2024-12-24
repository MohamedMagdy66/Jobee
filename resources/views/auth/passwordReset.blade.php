<x-layout>
    <x-page-heading>Reset Your Password</x-page-heading>
    <x-forms.form class="flex flex-col space-y-6" method="post" action="/ChangePassword"> <!-- Set a larger width for the container -->
        <x-forms.input label='Email' name='email' type="email"/> <!-- Full width -->
        <x-forms.input label='New Password' name='password'  type="password"/>
        <x-forms.input label='New Password confirmation' name='password_confirmation' type="password"/>
        <input type="hidden" name="token" value="{{ $token }}">
        @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <x-forms.button class="flex ml-auto justify-end" >Reset</x-forms.button>
    </x-forms.form>
</x-layout>