@props(['employer', 'width' => 90])

<img src="{{ asset('storage/' . $employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">