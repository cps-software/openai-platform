/*
|----------------------------------------------------------------------
| main.js
|----------------------------------------------------------------------
| Main JS file for todo app
*/

async function fetchTasks() {
  const response = await fetch('backend.php?action=getTasks');
  const tasks = await response.json();
  const taskList = document.getElementById('taskList');
  taskList.innerHTML = '';
  tasks.forEach(task => {
    const li = document.createElement('li');
    li.innerHTML = `${task.task} <button class="delete-btn" data-id="${task.id}">Delete</button>`;
    taskList.appendChild(li);
  });
}

async function addTask(task) {
  await fetch('backend.php?action=addTask', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ task })
  });
  fetchTasks();
}

async function deleteTask(id) {
  await fetch(`backend.php?action=deleteTask&id=${id}`);
  fetchTasks();
}

document.getElementById('taskForm').addEventListener('submit', e => {
  e.preventDefault();
  const task = document.getElementById('taskInput').value;
  if (task) {
    addTask(task);
    document.getElementById('taskInput').value = '';
  }
});

document.getElementById('taskList').addEventListener('click', e => {
  if (e.target.classList.contains('delete-btn')) {
    const id = e.target.getAttribute('data-id');
    deleteTask(id);
  }
});

fetchTasks();