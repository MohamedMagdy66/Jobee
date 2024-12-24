<x-layout>
    <x-page-heading>New Job</x-page-heading>
    <x-forms.form method="POST" actions='/jobs'>
    <x-forms.input label='Title' name='title' placeholder='Enter Job Title' />
    <x-forms.input label='Salary' name='salary' placeholder='$90,000 USD' />
    <x-forms.input label='Location' name='location' placeholder="Florida USA"/>
    <x-forms.select label='schedule' name='schedule'>
        <option>Part Time</option>
        <option>Full Time</option>
    </x-forms.select>
    <x-forms.input label='url' name='url' placeholder='https://www.example.com'/>
    <x-forms.checkbox label='Feature (Costs Extra)' name='featured'/>
    <x-forms.divider/>
    <x-forms.input label="Tags (Comma Separated)" name="tags" placeholder="SoftwareEngineer, BackendDeveloper"/>
    <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>