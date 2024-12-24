<x-layout>
    <x-page-heading>Edit Your Password</x-page-heading>
    <x-forms.form class="flex flex-col items-center space-y-6 w-4xl" method="post" action="/editPassword"> <!-- Set a larger width for the container -->
        <x-forms.input label='Old Password' name='oldPassword' value="{{ old('password', $user->Password) }}" type="password"/> <!-- Full width -->
        <x-forms.input label='New Password' name='newPassword'  type="password"/>
        <x-forms.input label='New Password confirmation' name='newPassword_confirmation'  type="password"/>
            <x-forms.button class="flex ml-auto justify-end" >Update</x-forms.button>
    </x-forms.form>
</x-layout>