<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TodoList as Todo;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class TodoList extends Component
{
    use WithPagination;

    public $paginateConfig = 3;
   
    public $newTask;
    
    public $filter = 'all';

    public $toggleAll;

    public $taskStatusCompleted = false;
    
    public $tasksPending;

    public $todoList;

    public function render()
    {
       
        $todo = $this->getCollectioPerFilter();
        $todo = $this->paginate($todo, $this->paginateConfig);
        if(Session::has('todoList')){
            
            $this->tasksPending =  $this->verifyStatus('pending')->count();

            $todoToggle = collect($todo->items());
        
            $countCompleted = $this->verifyStatus('completed');
            if ($countCompleted->count() == $todoToggle->count()) {
                $this->toggleAll = true;
            } else {
                $this->toggleAll = false;
            }   

            // dd($this->getCollectioPerFilter());
        
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

    public function paginate($items, $perPage = null , $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->gotoPage(1);
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
                    'status' => Todo::PENDING, 
                    'created_at' => now(), 
                    'updated_at' => now()
                ]);
                Session::push('todoList', $data);
            }else{
                $data = collect([
                    'name_task' => $newNameTask, 
                    'status' => Todo::PENDING, 
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
        
        
        // $todo = Todo::findOrFail($idTodo);
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

        if($this->page != 1 && $this->filter != 'all'){
            $this->gotoPage($this->page - 1);
        }

    }

    public function updateAllStatus($statusRequired){

        $todo = json_encode(Session::get('todoList'));
        $todo = collect(json_decode($todo));
        
        foreach ($todo as $key => $todoList) {
            
            session("todoList.".$key)['status'] = $statusRequired;
                
        }
    }

    public function deleteTask($idTask, $countTodosPerPage): void
    {
        session()->forget("todoList.".$idTask);

        if($countTodosPerPage == 1 && $this->page != 1){
            $this->gotoPage($this->page - 1);
        }

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

