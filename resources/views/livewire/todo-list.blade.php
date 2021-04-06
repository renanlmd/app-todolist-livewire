<div class="flex justify-center w-full">
    <div class="grid gap-4 grid-cols-2 w-full h-4/5">
        <div class="h-full max-h-full rounded-lg shadow-xl">
            <h2 class="text-center font-sans font-semibold text-8xl text-red-400 text-opacity-50">Todos</h2>
            @include('components.table-todo')
        </div>
        <div class="bg-green-600 h-4/5 max-h-80">
            @include('components.timer-pomodoro')
        </div>
        
      </div>
</div>

