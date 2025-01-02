const taskForm = document.getElementById('taskForm');
const taskInput = document.getElementById('taskInput');
const taskList = document.getElementById('taskList');

// Fetch tasks from the server
async function fetchTasks() {
  const response = await fetch('backend.php');
  const tasks = await response.json();
  renderTasks(tasks);
}

// Render tasks in the list
function renderTasks(tasks) {
  taskList.innerHTML = '';
  tasks.forEach(task => {
    const li = document.createElement('li');
    li.textContent = task.task;
    li.dataset.id = task.id;

    const deleteBtn = document.createElement('span');
    deleteBtn.textContent = '❌';
    deleteBtn.className = 'delete';
    deleteBtn.onclick = () => deleteTask(task.id);

    li.appendChild(deleteBtn);
    taskList.appendChild(li);
  });
}

// Add a new task
taskForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  const task = taskInput.value.trim();
  if (!task) return;

  const response = await fetch('backend.php', {
    method: 'POST',
    body: new URLSearchParams({ task }),
  });

  const newTask = await response.json();
  fetchTasks();
  taskInput.value = '';
});

// Delete a task
async function deleteTask(id) {
  await fetch(`backend.php`, {
    method: 'DELETE',
    body: new URLSearchParams({ id }),
  });
  fetchTasks();
}

// Load tasks on page load
fetchTasks();
