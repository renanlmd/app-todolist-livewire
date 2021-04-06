<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TodoLists;
use Livewire\Component;
use App\Models\TodoList as Todo;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public $paginateConfig = 8;
   
    public $newTask;
    
    public $filter = 'all';

    public $toggleAll;

    public $taskStatusCompleted = false;
    
    public function render()
    {
        $todo = $this->filter == 'all' ? Todo::orderBy('created_at', 'desc') : Todo::status($this->filter)->orderBy('created_at', 'desc');
        $todo = $todo->paginate($this->paginateConfig);
        
        $todoToggle = collect($todo->items());
        if ($todoToggle->where('status', 'completed')->count() == $todoToggle->count()) {
            $this->toggleAll = true;
        } else {
            $this->toggleAll = false;
        }
        
        $verifyStatusCompleted = Todo::status('completed');
        $verifyStatusCompleted = $verifyStatusCompleted->paginate($this->paginateConfig);
        $verifyStatusCompleted = collect($verifyStatusCompleted->items());
        if($verifyStatusCompleted->where('status', 'completed')->count()){
            $this->taskStatusCompleted = true;
        } else{
            $this->taskStatusCompleted = false;
        }
        return view('livewire.todo-list', ['todo'=> $todo]);
    }
    public function mount() 
    {
        $this->toggleAll = false;
        
    }
    public function nameTask($newNameTask)
    {
        
        if($newNameTask){

            Todo::create([
                'name_task' => $newNameTask,
                'status' => Todo::PENDING,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->newNameTask = null;
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

    public function deleteAllCompleted($idTodos)
    {
        Todo::whereIn('id', $idTodos)
            ->where('status', 'completed')
            ->delete();
    }
    
}

