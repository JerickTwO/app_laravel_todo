const draggableElements = document.querySelectorAll(".task");
const dropAreas = document.querySelectorAll(".swim-lane");

// Función para agregar la clase de arrastre
const addDragClass = (element) => {
    element.classList.add("is-dragging");
};

// Función para eliminar la clase de arrastre
const removeDragClass = (element) => {
    element.classList.remove("is-dragging");
};

// Función para manejar el evento de arrastre iniciado

const handleDragStart = (event) => {
    addDragClass(event.target);
};

// Función para manejar el evento de arrastre finalizado
const handleDragEnd = (event) => {
    removeDragClass(event.target);
};

// Función para manejar el evento de arrastre sobre un área de soltar
const handleDragOverArea = (event) => {
    event.preventDefault();
    const mouseY = event.clientY;
    const dropArea = event.currentTarget;
    const bottomTask = insertAboveTask(dropArea, mouseY);
    const currentTask = document.querySelector(".is-dragging");
    if (!bottomTask) {
        dropArea.appendChild(currentTask);
        
    } else {
        dropArea.insertBefore(currentTask, bottomTask);
    }
};

// Función para encontrar la tarea más cercana por encima de la posición del ratón
const insertAboveTask = (dropArea, mouseY) => {
    const tasks = dropArea.querySelectorAll(".task:not(.is-dragging)");

    let closestTask = null;
    let closestOffset = Number.NEGATIVE_INFINITY;

    tasks.forEach((task) => {
        const { top } = task.getBoundingClientRect();
        const offset = mouseY - top;

        if (offset < 0 && offset > closestOffset) {
            closestOffset = offset;
            closestTask = task;
        }
    });

    return closestTask;
};

// Agregar event listeners para el arrastre y soltar
draggableElements.forEach((element) => {
    element.addEventListener("dragstart", handleDragStart);
    element.addEventListener("dragend", handleDragEnd);
});

dropAreas.forEach((area) => {
    area.addEventListener("dragover", handleDragOverArea);
});