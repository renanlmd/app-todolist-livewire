<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class TodoList extends Component
{
   
    public $newTask;
    
    public $filter = 'all';

    public $toggleAll;

    public $taskStatusCompleted = false;
    
    public $tasksPending;


    public function render()
    {
       
        $todo = $this->getCollectioPerFilter();
        if(Session::has('todoList')){
            
            $this->tasksPending =  $this->verifyStatus('pending')->count();
            
            $countCompleted = $this->verifyStatus('pending');
            if ($countCompleted->count() == 0 or $this->filter == 'completed') {
                $this->toggleAll = true;
            } else {
                $this->toggleAll = false;
            }   
        
            $verifyStatusCompleted = $this->verifyStatus('completed');
            
            if($verifyStatusCompleted->count()){
                $this->taskStatusCompleted = true;
            } else{
                $this->taskStatusCompleted = false;
            }
        }
        
        return view('livewire.todo-list', ['todo'=> $todo]);

    }
    
    public function getCollectioPerFilter(){
        if($this->filter == 'all'){
            $todo = json_encode(Session::get('todoList'));
            return $todo = collect(json_decode($todo));
        }
        else if ($this->filter == 'pending'){
            $todo = json_encode(Session::get('todoList'));
            $todo = collect(json_decode($todo));
            $pendings = collect();
            foreach ($todo as $key => $todoList) {
                if($todoList->status == 'pending'){
                    $pendings[$key] = $todoList;
                }
            }
            return $pendings;
        }
        else if($this->filter == 'completed'){
            $todo = json_encode(Session::get('todoList'));
            $todo = collect(json_decode($todo));
            $completed = collect();
            foreach ($todo as $key => $todoList) {
                if($todoList->status == 'completed'){
                    $completed[$key] = $todoList;
                }
            }
            return $completed;
        }
    }

    public function verifyStatus($status){

        if(Session::has('todoList')){
            $todo = json_encode(Session::get('todoList'));
            $todo = collect(json_decode($todo));
            $pendings = collect();
            foreach ($todo as $key => $todoList) {
                if($todoList->status == $status){
                    $pendings[$key] = collect($todoList);
                }
            }
            return $pendings;
        }
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function mount() 
    {
        $this->toggleAll = false;
    }

    public function nameTask($newNameTask)
    {
        
        if ($newNameTask){
            if(Session::has('todoList')){
                
                $todo = json_encode(Session::get('todoList'));
                $todo = collect(json_decode($todo));
                
                $data = collect([
                    'name_task' => $newNameTask, 
                    'status' => 'pending', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ]);
                Session::push('todoList', $data);
            }else{
                $data = collect([
                    'name_task' => $newNameTask, 
                    'status' => 'pending', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ]);
                Session::push('todoList', $data);
            }            
            

        }
        $this->dispatchBrowserEvent('clear-input');

    }

    public function updateStatusTask($idTodo)
    {
        
        $todo = Session::get('todoList');
        $task = $todo[$idTodo]->toArray();
        
        if ($task['status'] == 'pending'){
           
            session("todoList.".$idTodo)['status'] = 'completed';
        }
        elseif ($task['status']== 'completed'){
            
            session("todoList.".$idTodo)['status'] = 'pending';

        }

    }

    public function testToggle()
    {
        $statusRequired = $this->toggleAll ? 'pending' : 'completed';
        
        $this->updateAllStatus($statusRequired);

    }

    public function updateAllStatus($statusRequired){

        $todo = json_encode(Session::get('todoList'));
        $todo = collect(json_decode($todo));
        
        foreach ($todo as $key => $todoList) {
            
            session("todoList.".$key)['status'] = $statusRequired;
                
        }
    }

    public function deleteTask($idTask): void
    {
        session()->forget("todoList.".$idTask);

    }

    public function deleteAllCompleted()
    {
        
        if($this->taskStatusCompleted){
            $todo = json_encode(Session::get('todoList'));
            $todo = collect(json_decode($todo));
            
            foreach ($todo as $key => $todoList) {
                if($todoList->status == 'completed'){
                    session()->forget("todoList.".$key);
                    
                }
            }
        }
        $this->reset();
    }
    
}

