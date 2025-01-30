<!-- ====== Table Section Start -->

<!-- Wire:poll -> enviar solicitudes a intervalos regulares en busca de actualizaciones -->
<section class="bg-white " wire:poll="renderAllTasks">
    <div class="container">

        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="max-w-full overflow-x-auto relative flex flex-col gap-8">
                    <button class="bg-purple-800 border border-700-black text-gray px-4 py-2 rounded-md hover:bg-purple-700 my-6 mb-8 mx-auto relative left-0" wire:click="openCreateModal" style="border: 2px solid #e8b32e">
                        Nueva Tarea
                    </button>
                    <table class="table-auto w-full">
                        <thead>

                            <tr class="bg-[#ea832e] text-center">
                                <th
                                    class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            border-l border-transparent
                            ">
                                    Titulo
                                </th>
                                <th
                                    class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            ">
                                    Descripcion
                                </th>
                                <th
                                    class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            ">
                                    Acciones
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr class="border border-black">
                                <td
                                    class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-[#F3F6FF]
                            border-b border-l border-[#E8E8E8]
                            ">
                                    {{ $task->title }}

                                </td>
                                <td
                                    class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-white
                            border-b border-[#E8E8E8]
                            ">
                                    {{ $task->description }}
                                </td>
                                <td
                                    class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-[#F3F6FF]
                            border-b border-[#E8E8E8]
                            ">
                                    @if( (isset($task->pivot) && $task->pivot->permission == 'edit') ||(auth()->user()->id == $task->user_id))
                                    <div class="flex flex-row justify-center gap-4">
                                        <button wire:click="openCreateModal({{ $task }})" class="px-4 py-2 rounded-md text-white " style="background-color: #e8b32e">
                                            Editar
                                        </button>
                                        <button class=" px-4 py-2 rounded-md text-white " style="background-color: #B91C1C" wire:click="deleteTask({{ $task }})" wire:confirm="¿Seguro que quieres eliminar la tarea?">
                                            Borrar
                                        </button>

                                    </div>

                                    @endif
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Main modal -->
    @if ($modal)

    <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
        <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
            <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                    <div class="mb-8">
                        <h1 class="mb-4 text-3xl font-extrabold">Crear nueva tarea</h1>

                        <!-- Mostrar el mensaje de error si está presente -->
                        @if (session()->has('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                        @endif


                        <form>
                            <div class="mb-4">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Título</label>
                                <input wire:model="title" type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Introduce aquí el título de la tarea">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Descripción</label>
                                <input wire:model="description" type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Introduce aquí la descripción de la tarea">

                            </div>
                        </form>

                    </div>

                    <div class="flex flex-row gap-8">
                        <button class="p-3 bg-white border rounded-full w-full text-white"
                            wire:click="createorUpdateTask" style="background-color: #e8b32e">Añadir</button>

                        </button>
                        <button class="p-3 bg-white border rounded-full w-full text-white" wire:click.prevent="closeCreateModal" style="background-color: #B91C1C">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</section>
<!-- ====== Table Section End -->