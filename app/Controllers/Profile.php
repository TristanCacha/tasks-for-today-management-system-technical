<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(): string
    {
        $taskModel = model(TaskModel::class);
        $userId    = (int) session()->get('userId');
        $user      = model(UserModel::class)->getDemoUser();

        return $this->renderPage('profile/index', [
            'title'      => 'Profile',
            'user'       => $user,
            'taskTotal'  => count($taskModel->getAllTasksOrdered($userId)),
            'todayTotal' => count($taskModel->getTodayTasks($userId)),
            'counts'     => $taskModel->getStatusCounts(null, $userId),
            'activePage' => 'profile',
        ]);
    }
}
