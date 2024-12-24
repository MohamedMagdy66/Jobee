<x-dashboard-layout>
    <x-panel>
    <x-page-heading>Welcome {{Auth::user()->name}}..</x-page-heading>
    <x-forms.divider/>

<div class="flex justify-center items-center space-x-6">
    <a href="/editEmployer" class="hover:text-blue-600" >Edit Name</a>
    <a href="/editPassword" class="hover:text-blue-600">Change Password</a>
</div>
</x-panel>
<section class="mt-6">
    <x-section-heading >Your Jobs</x-section-heading>
    <div class="mt-6 space-y-6">
        @foreach ($jobs as $job )
        <x-job-card :$job />  
        <div class="mt-3">
        <a href="/editJob/{{$job->id}}" class="bg-transparent rounded py-2 px-7 font-bold  hover:bg-blue-800 " >Edit</a>
        <form method="POST" action="/dashboard/{{$job->id}}" style="display:inline;">
            @csrf
            @method('DELETE')
            <x-forms.button class="bg-transparent  hover:bg-red-800">Delete</x-forms.button> 
        </form>
    </div>
            @endforeach

    </div>
   

</section>
</x-dashboard-layout>