window.addEventListener("DOMContentLoaded", function () {
    const myTodo = document.getElementById("mytodo");
    const myTodoFlag = myTodo.dataset.mytodo;

    if (myTodoFlag == 1) {
        const button = document.getElementById("mytodo-button");
        button.style.display = "none";
    }
});
