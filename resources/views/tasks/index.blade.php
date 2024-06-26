<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="board">
                    <form action="{{ route('tasks.store') }}" method="POST" id="todo-form">
                        @csrf
                        <input name="title" type="text" placeholder="New TODO..." id="todo-input" required />
                        <button type="submit"> Add +</button>
                    </form>

                    <div class="lanes">
                        <div class="swim-lane" id="TODO">
                            <div class="lane_title">
                                <h2 class="heading_1">TODO</h2>
                            </div>
                            @foreach ($tasks->where('position', 'TODO') as $task)
                                <div class="task" id="task-{{ $task->id }}" data-id="{{ $task->id }}" draggable="true">
                                    <span id="task-title-{{ $task->id }}">{{ $task->title }}</span>
                                    <input type="hidden" name="position" value="TODO">
                                    <div class="container_icon">
                                        <form class="formDelete" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg viewBox="0 0 24 24" class="icon delete" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <button class="edit-button" data-task-id="{{ $task->id }}">
                                            <svg viewBox="0 0 24 24" class="icon edit" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.1497 7.93997L8.27971 19.81C7.21971 20.88 4.04971 21.3699 3.27971 20.6599C2.50971 19.9499 3.06969 16.78 4.12969 15.71L15.9997 3.84C16.5478 3.31801 17.2783 3.03097 18.0351 3.04019C18.7919 3.04942 19.5151 3.35418 20.0503 3.88938C20.5855 4.42457 20.8903 5.14781 20.8995 5.90463C20.9088 6.66146 20.6217 7.39189 20.0997 7.93997H20.1497Z" stroke="CurrentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M21 21H12" stroke="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swim-lane" id="DOING">
                            <div class="lane_title">
                                <h2 class="heading_2">DOING</h2>
                            </div>
                            @foreach ($tasks->where('position', 'DOING') as $task)
                                <div class="task" id="task-{{ $task->id }}" data-id="{{ $task->id }}" draggable="true">
                                    <span id="task-title-{{ $task->id }}">{{ $task->title }}</span>
                                    <input type="hidden" name="position" value="DOING">
                                    <div class="container_icon">
                                        <form class="formDelete" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg viewBox="0 0 24 24" class="icon delete" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <button class="edit-button" data-task-id="{{ $task->id }}">
                                            <svg viewBox="0 0 24 24" class="icon edit" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.1497 7.93997L8.27971 19.81C7.21971 20.88 4.04971 21.3699 3.27971 20.6599C2.50971 19.9499 3.06969 16.78 4.12969 15.71L15.9997 3.84C16.5478 3.31801 17.2783 3.03097 18.0351 3.04019C18.7919 3.04942 19.5151 3.35418 20.0503 3.88938C20.5855 4.42457 20.8903 5.14781 20.8995 5.90463C20.9088 6.66146 20.6217 7.39189 20.0997 7.93997H20.1497Z" stroke="CurrentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M21 21H12" stroke="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swim-lane" id="DONE">
                            <div class="lane_title">
                                <h2 class="heading_2">DONE</h2>
                            </div>
                            @foreach ($tasks->where('position', 'DONE') as $task)
                                <div class="task" id="task-{{ $task->id }}" data-id="{{ $task->id }}" draggable="true">
                                    <span id="task-title-{{ $task->id }}">{{ $task->title }}</span>
                                    <input type="hidden" name="position" value="DONE">
                                    <div class="container_icon">
                                        <form class="formDelete" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg viewBox="0 0 24 24" class="icon delete" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <button class="edit-button" data-task-id="{{ $task->id }}">
                                            <svg viewBox="0 0 24 24" class="icon edit" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.1497 7.93997L8.27971 19.81C7.21971 20.88 4.04971 21.3699 3.27971 20.6599C2.50971 19.9499 3.06969 16.78 4.12969 15.71L15.9997 3.84C16.5478 3.31801 17.2783 3.03097 18.0351 3.04019C18.7919 3.04942 19.5151 3.35418 20.0503 3.88938C20.5855 4.42457 20.8903 5.14781 20.8995 5.90463C20.9088 6.66146 20.6217 7.39189 20.0997 7.93997H20.1497Z" stroke="CurrentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M21 21H12" stroke="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <!-- Incluir el archivo JavaScript -->
                <script src="{{ asset('js/drag.js') }}" defer></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    (function() {
                        // Manejar la eliminación de tareas
                        const forms = document.querySelectorAll('.formDelete');
                        Array.prototype.slice.call(forms)
                            .forEach(function(form) {
                                form.addEventListener('submit', function(event) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                    Swal.fire({
                                        title: '¿Confirma la eliminación del registro?',
                                        icon: 'info',
                                        showCancelButton: true,
                                        confirmButtonColor: '#20c997',
                                        cancelButtonColor: '#6c757d',
                                        confirmButtonText: 'Confirmar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            this.submit();
                                            Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
                                        }
                                    });
                                }, false);
                            });

                        // Manejar la edición de tareas
                        const editButtons = document.querySelectorAll('.edit-button');
                        editButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const taskId = this.dataset.taskId;
                                const taskTitle = document.querySelector(`#task-title-${taskId}`).innerText;

                                Swal.fire({
                                    title: 'Editar Tarea',
                                    input: 'text',
                                    inputValue: taskTitle,
                                    showCancelButton: true,
                                    confirmButtonText: 'Guardar',
                                    cancelButtonText: 'Cancelar',
                                    showLoaderOnConfirm: true,
                                    preConfirm: (newTitle) => {
                                        return fetch(`/tasks/${taskId}`, {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                            },
                                            body: JSON.stringify({ title: newTitle })
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error(response.statusText);
                                            }
                                            return response.json();
                                        })
                                        .catch(error => {
                                            Swal.showValidationMessage(`Request failed: ${error}`);
                                        });
                                    },
                                    allowOutsideClick: () => !Swal.isLoading()
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        Swal.fire('Actualizado!', 'La tarea ha sido actualizada.', 'success')
                                            .then(() => {
                                                document.querySelector(`#task-title-${taskId}`).innerText = result.value.title;
                                            });
                                    }
                                });
                            });
                        });
                    })();
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
