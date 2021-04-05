<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TodoList as Todo;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public $paginateConfig = 10;
   
    public $newTask;
    
    public $toggleAll;
    
    public function render()
    {
        $todo = Todo::orderBy('created_at', 'desc');
        $todo = $todo->paginate($this->paginateConfig);
        
        $todoToggle = collect($todo->items());
        if ($todoToggle->where('status', 'completed')->count() == $todoToggle->count()) {
            $this->toggleAll = true;
        } else {
            $this->toggleAll = false;
        }
        
        return view('livewire.todo-list', ['todo'=> $todo]);
    }
    public function mount() 
    {
        $this->toggleAll = false;
    }
    public function nameTask()
    {
        if($this->newTask){

            Todo::create([
                'name_task' => $this->newTask,
                'status' => Todo::PENDING,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->newTask = null;
    }

    public function updateStatusTask(Todo $todo)
    {
        if ($todo->status == Todo::PENDING){
            $todo->update([
                'status' => Todo::COMPLETED
            ]);
        }
        elseif ($todo->status == Todo::COMPLETED){
            $todo->update([
                'status' => Todo::PENDING
            ]);
        }
    }

    public function testToggle($todos)
    {
        
        $statusDesejado = $this->toggleAll ? 'pending' : 'completed';

        Todo::whereIn('id', json_decode($todos))
            ->statusNot($statusDesejado)
            ->update([
                'status' => $this->toggleAll ? 'pending' : 'completed',
            ]);
    }

    public function deleteTask($idTask): void
    {
        Todo::where('id', $idTask)
            ->delete();
    }
}

