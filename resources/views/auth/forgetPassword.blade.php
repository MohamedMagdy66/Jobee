<x-layout>
    <x-page-heading>Email Verification</x-page-heading>
        {{-- Session Messages --}}
        @if (session('status'))
        <x-forms.flashMsg msg="{{ session('status') }}" />
    @endif
    <x-forms.form method='POST' action="/passwordReset" > 
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.divider></x-forms.divider>
        <div class="flex justify-between items-center mt-4">
            <x-forms.button>Submit</x-forms.button>
            <span>Do u have account? 
            <a href="/login" class="font-bold underline hover:text-blue-500 ">Sign In</a>
        </span>
        </div>
    </x-forms.form>
</x-layout>