<x-layout>
    <x-page-heading>LogIn</x-page-heading>
    @if (session('alert'))
    <x-forms.flashMsg msg="{{ session('alert') }}" bg='bg-red-500' />
    @endif
    <x-forms.form method='POST' action="/login" > 
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.input label="Password" name="password" type="password"/>
        <x-forms.divider></x-forms.divider>
        <div class="flex justify-between items-center mt-4">
            <x-forms.button>Login</x-forms.button>
            <a href="/passwordReset" class=" underline hover:text-blue-500">Forget Password..?</a>
        </div>
    </x-forms.form>
</x-layout>