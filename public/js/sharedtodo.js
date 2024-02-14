window.addEventListener("DOMContentLoaded", function () {
    const sharedTodoWorking = document.getElementById("shared-todo-working")
        .dataset.working;
    if (sharedTodoWorking == 1) {
        const sharedTodo = document.getElementById("shared-todo");
        sharedTodo.style.opacity = "0.5";
    }

    const button = document.getElementById("mytodo-button");
    button.style.display = "none";
});
