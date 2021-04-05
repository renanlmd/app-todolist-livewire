
<div class="pb-2 toggle-addTask" >
    <form wire:submit.prevent="nameTask">
        <div class="grid grid-cols-10" >
            <div class="col-span-1 h-14">
                <div class="flex items-center mt-2 ml-1">
                    <input type="checkbox" id="A3-yes" name="A3-confirmation" value="yes" class="opacity-0 absolute h-8 w-8" wire:click="testToggle('{{ json_encode(collect($todo->items())->map->id->toArray()) }}')" />
                    <div class="bg-white border-2 rounded-full border-blue-400 w-10 h-10 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                        <svg class="fill-current @if($toggleAll) text-blue-800 @else text-blue-400 hidden @endif w-6 h-6 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero">
                            <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                            </g>
                        </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-span-9 text-xl h-14 pl-3">
                <input wire:model="newTask" placeholder="O que precisa ser feito?" class="w-full h-full focus:outline-none focus:border-none ">
            </div>
        </div>
    </form>
</div>
<div class="pt-2">
    <div class="grid grid-cols-10 gap-4">
        @forelse ($todo as $todoList)
            
            <div class="col-span-1 h-14 ">
                    <div class="flex items-center mt-2 ml-1">
                        @if ($todoList->status == \App\Models\TodoList::COMPLETED)
                            <input type="checkbox" id="A3-yes" name="A3-confirmation" value="yes" class="opacity-0 absolute h-8 w-8" wire:click="updateStatusTask({{ $todoList->id }})" />
                            <div class="bg-white border-2 rounded-full border-blue-400 w-10 h-10 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                <svg class="fill-current w-6 h-6 text-blue-600 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero">
                                    <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                                    </g>
                                </g>
                                </svg>
                            </div>
                        
                        @else 
                            <input type="checkbox" id="A3-yes" name="A3-confirmation" value="yes" class="opacity-0 absolute h-8 w-8" wire:click="updateStatusTask({{ $todoList->id }})" />
                            <div class="bg-white border-2 rounded-full border-blue-400 w-10 h-10 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                <svg class="fill-current hidden w-6 h-6 text-blue-600 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero">
                                    <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                                    </g>
                                </g>
                                </svg>
                            </div>
                        @endif
                        
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
                        wire:click="deleteTask({{ $todoList->id }} )">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        @empty
            nenhum
        @endforelse
    </div>
    
        
</div>