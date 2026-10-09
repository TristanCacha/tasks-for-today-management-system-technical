<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index(): string
    {
        $taskModel = model(TaskModel::class);
        $userId    = (int) session()->get('userId');
        $tasks     = $taskModel->getAllTasksOrdered($userId);
        $counts    = $taskModel->getStatusCounts(null, $userId);

        return $this->renderPage('tasks/index', [
            'title'      => 'All tasks',
            'tasks'      => $tasks,
            'counts'     => $counts,
            'totalTasks' => count($tasks),
            'summaryItems' => [
                ['label' => 'All tasks', 'value' => count($tasks), 'icon' => '▤', 'tone' => 'total'],
                ['label' => 'Pending', 'value' => $counts['pending'], 'icon' => '○', 'tone' => 'pending'],
                ['label' => 'In progress', 'value' => $counts['in_progress'], 'icon' => '◌', 'tone' => 'progress'],
                ['label' => 'Completed', 'value' => $counts['completed'], 'icon' => '✓', 'tone' => 'complete'],
            ],
            'activePage' => 'tasks',
        ]);
    }

    public function newTask(): string
    {
        return $this->renderPage('tasks/form', [
            'title' => 'Add a task',
            'task' => ['title' => '', 'task_date' => date('Y-m-d'), 'status' => 'pending'],
            'formAction' => site_url('tasks/create'),
            'activePage' => 'tasks',
            'errors' => session()->getFlashdata('formErrors') ?? [],
        ]);
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $rules = ['title' => 'required|max_length[150]', 'task_date' => 'required|valid_date[Y-m-d]'];
        if (! $this->validate($rules)) {
            return redirect()->to(site_url('tasks/new'))->withInput()->with('formErrors', $this->validator->getErrors());
        }

        model(TaskModel::class)->insert([
            'user_id' => (int) session()->get('userId'),
            'title' => trim((string) $this->request->getPost('title')),
            'status' => 'pending',
            'task_date' => (string) $this->request->getPost('task_date'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task added.');
    }

    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $task = model(TaskModel::class)->getForUser($id, (int) session()->get('userId'));
        if ($task === null) {
            return redirect()->to(site_url('tasks'))->with('error', 'That task could not be found.');
        }

        return $this->renderPage('tasks/form', [
            'title' => 'Edit task',
            'task' => $task,
            'formAction' => site_url("tasks/{$id}/update"),
            'activePage' => 'tasks',
            'errors' => session()->getFlashdata('formErrors') ?? [],
        ]);
    }

    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $model = model(TaskModel::class);
        if ($model->getForUser($id, (int) session()->get('userId')) === null) {
            return redirect()->to(site_url('tasks'))->with('error', 'That task could not be found.');
        }

        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'required|in_list[pending,in_progress,completed]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->to(site_url("tasks/{$id}/edit"))->withInput()->with('formErrors', $this->validator->getErrors());
        }

        $model->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'task_date' => (string) $this->request->getPost('task_date'),
            'status' => (string) $this->request->getPost('status'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task updated.');
    }

    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $model = model(TaskModel::class);
        if ($model->getForUser($id, (int) session()->get('userId')) === null) {
            return redirect()->to(site_url('tasks'))->with('error', 'That task could not be found.');
        }

        $model->delete($id);

        return redirect()->to(site_url('tasks'))->with('success', 'Task deleted.');
    }

    public function toggle(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $model = model(TaskModel::class);
        $task = $model->getForUser($id, (int) session()->get('userId'));
        if ($task !== null) {
            $model->update($id, ['status' => $task['status'] === 'completed' ? 'pending' : 'completed']);
        }

        $returnTo = $this->request->getPost('return_to') === 'home' ? '/' : 'tasks';

        return redirect()->to(site_url($returnTo));
    }
}
