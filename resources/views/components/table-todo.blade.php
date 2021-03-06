<div class="pb-2 toggle-addTask" >
        <div class="grid grid-cols-10" >
            <div class="col-span-1 h-14">
                <div class="flex items-center mt-2 ml-1">
                    <input type="checkbox" value="yes" class="opacity-0 absolute h-8 w-8" wire:click="testToggle()"  />
                    <div class="bg-white border-2 rounded-full w-10 h-10 flex flex-shrink-0 justify-center items-center mr-2  @if($toggleAll and !empty($todo->all())) border-blue-600 @else border-blue-400 @endif">
                        <svg class="fill-current @if($toggleAll and empty($todo->all())) hidden @endif w-6 h-6 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(-9 -11)" fill="@if($toggleAll and !empty($todo->all())) #1F73F1 @endif" >
                            <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                            </g>
                        </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-span-9 text-xl h-14 pl-3">

                <input  id="nameTask" type="text" placeholder="O que precisa ser feito?"
                            class="w-full h-full focus:outline-none focus:border-none"
                            wire:keydown.enter="nameTask($event.target.value)"
                            x-on:keydown.enter="document.getElementById('nameTask').value=''">
            </div>
        </div>
</div>

<div class="pt-2">
    <div class="flex flex-col-reverse divide-y divide-y-reverse divide-gray-300">
        @foreach ($todo->sortBy('created_at') as $key => $todoList)
            
            <div class="grid grid-cols-10">
                
                <div class="col-span-1 h-14">
                    <div class="flex items-center mt-2 ml-1">
                        
                            <div class="bg-white border rounded-full @if($todoList->status == 'completed') border-blue-600 @else border-blue-400 @endif w-10 h-10 flex flex-shrink-0 justify-center items-center mr-2"
                            wire:click="updateStatusTask({{ $key }})"
                            >
                                <svg class="fill-current @if(!$todoList->status == 'completed')) hidden @endif  w-6 h-6 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(-9 -11)" fill=" @if($todoList->status == 'completed') #1F73F1 @endif" fill-rule="nonzero">
                                    <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                                    </g>
                                </g>
                                </svg>
                            </div>
                    </div>
                </div>
                
                <div class="col-span-8 h-14 pt-3">
                    @if ($todoList->status == 'pending')
                        <span class="font-mono text-2xl text-gray-800 font-medium">{{$todoList->name_task}}</span>
                    @else 
                        <span class="font-mono text-2xl text-gray-500 line-through font-medium">{{$todoList->name_task}}</span>
                    @endif
                   
                </div>
                <div class="col-span-1 h-14">
                    <div class="p-3 flex items-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-7 text-gray-400 ease-out transform cursor-pointer hover:text-gray-700"
                            wire:click="deleteTask({{ $key }})">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
    
            </div>
        
        @endforeach
        
    </div>
    
</div>

@if(session()->has('todoList') or !$todo->isEmpty())
    <div class="flex items-center justify-center h-14 mt-3 p-2 ">
    
        <div 
        class="pr-3 font-mono @if($filter == 'all') font-bold @endif text-lg text-gray-700 cursor-pointer hover:underline"
        wire:click="setFilter('all')"
        >
            <span>Todos</span>
        </div>
        
        <div 
        class="pl-3 font-mono @if($filter == 'pending') font-bold @endif text-lg text-gray-700 cursor-pointer hover:underline"
        wire:click="setFilter('pending')"
        >
            <span>Pendentes</span>
        </div>
        <div 
        class="pl-3 font-mono @if($filter == 'completed') font-bold @endif text-lg text-gray-700 cursor-pointer hover:underline"
        wire:click="setFilter('completed')"
        >
            <span>Tarefas completas</span>
        </div>
        @if($taskStatusCompleted)
            <div 
            class="pl-3 font-mono text-lg text-gray-700 cursor-pointer hover:underline"
            wire:click="deleteAllCompleted()"
            >
                <span>Limpar todos concluidos</span>
            </div>
        @endif
    </div>
@endif

<div>
    <div class="flex flex-col-reverse divide-y divide-y-reverse divide-gray-300 ">
        <div class="grid grid-cols-3 ">
            <div class="col-span-1 h-14 pt-3 pl-4">
                <span class="font-mono text-base text-gray-600">{{$tasksPending}} tarefas pendentes</span>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('clear-input', function() {
            document.getElementById('nameTask').value = '';

        })
    </script>
@endpush