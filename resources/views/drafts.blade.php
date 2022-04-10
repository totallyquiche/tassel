@section('title', config('app.name') . ' - Drafts')

<x-app-layout>
    <x-slot name="header">Drafts</x-slot>

    @livewire('draft-cards')

    <br/><br/>
</x-app-layout>
