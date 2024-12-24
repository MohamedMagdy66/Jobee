<x-layout>
    <x-page-heading>Edit Your Name</x-page-heading>
    <x-forms.form class="flex flex-col items-center space-y-6 w-4xl" method="post" action="/editEmployer"> <!-- Set a larger width for the container -->
        <x-forms.input label='User  Name' name='name' value="{{ old('name', $user->name) }}"/> <!-- Full width -->
        <x-forms.input label='Employer Name' name='employer_name'  value="{{ old('name', $user->employer->name) }}"/> <!-- Full width -->
            <x-forms.button class="flex ml-auto justify-end" >Update</x-forms.button>
    </x-forms.form>
</x-layout>