const draggableElements = document.querySelectorAll(".task");
const dropAreas = document.querySelectorAll(".swim-lane");

const addDragClass = (element) => {
    element.classList.add("is-dragging");
};

const removeDragClass = (element) => {
    element.classList.remove("is-dragging");
};

const handleDragStart = (event) => {
    addDragClass(event.target);
};

const handleDragEnd = (event) => {
    removeDragClass(event.target);
    const currentTask = event.target;
    const newLane = currentTask.closest('.swim-lane');
    updateTaskPosition(currentTask.dataset.id, newLane.id);
};

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

const updateTaskPosition = (taskId, newPosition) => {
    fetch(`/tasks/${taskId}/update-position`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ position: newPosition })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Task position updated successfully');
        } else {
            console.error('Failed to update task position');
        }
    })
    .catch(error => console.error('Error:', error));
};

// Add event listeners
draggableElements.forEach((element) => {
    element.addEventListener("dragstart", handleDragStart);
    element.addEventListener("dragend", handleDragEnd);
});

dropAreas.forEach((area) => {
    area.addEventListener("dragover", handleDragOverArea);
});