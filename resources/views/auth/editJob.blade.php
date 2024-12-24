<x-layout>
    <x-page-heading>Edit Job</x-page-heading>
    <x-forms.form method="POST" actions='/editJob/{{$job->id}}'>
        <x-forms.input label='Title' name='title' value="{{ old('title', $job->title) }}"/>
            <x-forms.input label='Salary' name='salary' value="{{ old('salary', $job->salary) }}" />
            <x-forms.input label='Location' name='location' value="{{ old('location', $job->location) }}"/>
                <x-forms.select label='schedule' name='schedule' value="{{ old('featured', $job->schedule) }}">
                    <option>Part Time</option>
                    <option>Full Time</option>
                </x-forms.select>
                <x-forms.input label='URL' name='url' value="{{ old('url', $job->url) }}"/>
            <x-forms.checkbox label='Feature (Costs Extra)' name='featured' value="{{ old('featured', $job->featured) }}"/>
                <x-forms.divider/>
            <x-forms.input label="Tags (Comma Separated)" name="tags" value="{{ old('tags', $job->tags) }}" />
            <x-forms.button>Update</x-forms.button>
    </x-forms.form>
</x-layout>