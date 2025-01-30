<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $description;
    public $id;
    public $miTarea = null;
    public $modal = false;
    public $users = [];
    public $user_id;
    public $permiso;
    public $modalShare = false;

  /**
 * Método que se ejecuta al montar el componente de Livewire.
 * Inicializa las tareas y los usuarios en el componente.
 * 
 * @return void
 */
public function mount()
{
    // Recupera todas las tareas del usuario autenticado y las ordena por 'id' de forma descendente.
    $this->tasks = $this->getTasks()->sortByDesc('id');
    // Recupera todos los usuarios excepto el usuario autenticado.
    $this->users = User::where('id', '!=', auth()->user()->id)->get();
}

/**
 * Método para renderizar todas las tareas, ordenadas de manera descendente.
 * 
 * @return void
 */
public function renderAllTasks()
{
    // Vuelve a recuperar las tareas del usuario autenticado, ordenadas por 'id' de forma descendente.
    $this->tasks = $this->getTasks()->sortByDesc('id');
}

/**
 * Recupera todas las tareas asociadas al usuario autenticado.
 * 
 * @return \Illuminate\Database\Eloquent\Collection
 */
public function getTasks()
{
  
    return Task::where('user_id', auth()->user()->id)->get();
}


/**
 * Método privado para limpiar los campos del formulario 
 * (título, descripción, etc.).
 * 
 * @return void
 */
private function clearFields()
{
    $this->title = '';
    $this->description = '';
    $this->id = '';
    $this->miTarea = null;
}

/**
 * Abre el modal para crear o editar una tarea.
 * Si se pasa una tarea, se carga en los campos de edición.
 * 
 * @param \App\Models\Task|null $task
 * @return void
 */
public function openCreateModal(Task $task = null)
{

    if ($task) {
        // Si se pasa una tarea, cargamos sus valores en los campos.
        $this->miTarea = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->id = $task->id;
    } else {
        // Si no se pasa una tarea, limpiamos los campos.
        $this->clearFields();
    }

    // Abrimos el modal.
    $this->modal = true;
}

/**
 * Cierra el modal de creación o edición de tarea.
 * 
 * @return void
 */
public function closeCreateModal()
{
    // Cierra el modal.
    $this->modal = false;
}

/**
 * Crea una nueva tarea o actualiza una existente.
 * Si se pasa una tarea, se realiza la actualización; si no, se crea una nueva.
 * 
 * @return void
 */
public function createorUpdateTask()
{

    // Validación para asegurarse de que los campos no estén vacíos
    if (empty($this->title) || empty($this->description)) {
        // Puedes agregar una validación aquí (mostrar mensaje de error, etc.)
        session()->flash('error', 'El título y la descripción son obligatorios.');
        return; // Evita continuar con la creación o actualización
    }
    
    if ($this->miTarea->id) {
        // Si la tarea tiene un ID (es una tarea existente), la actualizamos.
        $task = Task::find($this->miTarea->id);
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    } else {
        // Si no tiene ID, creamos una nueva tarea.
        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->user()->id,
        ]);
    }

    // Limpiamos los campos y cerramos el modal.
    $this->clearFields();
    $this->modal = false;
    
    // Actualizamos la lista de tareas.
    $this->tasks = $this->getTasks()->sortByDesc('id');
}

/**
 * Elimina una tarea existente.
 * 
 * @param \App\Models\Task $task
 * @return void
 */
public function deleteTask(Task $task)
{
    // Elimina la tarea.
    $task->delete();
    
    // Actualiza la lista de tareas después de la eliminación.
    $this->tasks = $this->getTasks()->sortByDesc('id');
}



}