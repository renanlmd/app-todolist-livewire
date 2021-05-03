@extends('layouts.app')

@section('content')
    
    <div class="flex justify-center w-full">
        <div class="grid gap-4 grid-cols-2 w-full h-4/5">
            <div class="h-full max-h-full rounded-lg shadow-xl">
                @livewire('todo-list')
            </div>
            <div class=" h-4/5 max-h-80 relative">
                @include('components.timer-pomodoro')
            </div>
            
        </div>
    </div>

@endsection