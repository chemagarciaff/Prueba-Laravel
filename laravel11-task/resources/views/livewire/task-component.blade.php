
<div>
    
    <button class="border border-gray-200 p-4 rounded mb-6 hover:text-gray-700" wire:click="openCreateModal" >Nueva tarea</button>

    <div class="overflow-x-auto w-full">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Título</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Descripción</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->task as $task)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2 text-sm text-gray-200 border border-gray-200">{{$task->title}}</td>
                    <td class="px-4 py-2 text-sm text-gray-200 border border-gray-200">{{$task->description}}</td>
                    <td class="px-4 py-2 text-sm border border-gray-200">
                        <button class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md">Editar</button>
                        <button class="px-4 py-2 text-white bg-red-500 hover:bg-red-700 rounded-md ml-2">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
    
    <!-- Modal -->
    
    @if ($modal)
    <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-200">
            <h2 class="text-lg font-semibold mb-4 text-black">Crear Tarea</h2>
            
            <!-- Formulario -->
            <form wire:submit.prevent="createTask">

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="title" wire:model="title" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full">
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="description" wire:model="description"  name="description" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" rows="4"></textarea>
                </div>
                
                <div class="flex justify-between">
                    <!-- Botón Guardar -->
                    <button type="submit" class="px-4 py-2 bg-blue-400 text-black rounded-md" wire:click.prevent="createTask">
                        Guardar
                    </button>
                    
                    <!-- Botón Cerrar -->
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md" wire:click.prevent="closeCreateModal">
                        Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @endif
</div>