{{-- Page note individuelle, utilise composants default et note --}}
<x-default-layout :title="$note->title">
    <div class=" flex flex-wrap justify-evenly">
        {{-- Début note --}}
        <x-note :note="$note"/>
        {{-- Fin note --}}
    </div>
</x-default-layout>