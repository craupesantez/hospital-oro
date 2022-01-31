@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([ 'type' => 'date', 'class' => 'form-control rounded-pill border-0 shadow-sm px-4 flatpickr']) !!}>
{{-- <input type="date" {{ $disabled ? 'disabled' : '' }}> --}}