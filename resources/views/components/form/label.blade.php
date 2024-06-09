@props(['id' => ''])

<label for="{{ $id }}">{{ $slot }}</label>

{{-- In Laravel, the "$slot" variable is used in Blade components to capture the content passed to the component. --}}




{{-- Named Slots --}}

{{-- 1. Modify the Blade component view (card.blade.php): --}}
{{--

<div class="card">
    <div class="card-header">
        {{ $header }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer">
        {{ $footer }}
    </div>
</div>

--}}

{{-- -------------------------- --}}

{{-- 2. Use named slots in a Blade view: --}}
{{--

<x-card>
    <x-slot name="header">
        <h1>Card Header</h1>
    </x-slot>

    <x-slot name="footer">
        <p>Card Footer</p>
    </x-slot>

    <p>This is the main content of the card.</p>
</x-card>

--}}

{{-- -------------------------- --}}

{{-- 3. OUTPUT --}}
{{--

<div class="card">
    <div class="card-header">
        <h1>Card Header</h1>
    </div>
    <div class="card-body">
        <p>This is the main content of the card.</p>
    </div>
    <div class="card-footer">
        <p>Card Footer</p>
    </div>
</div>

--}}
