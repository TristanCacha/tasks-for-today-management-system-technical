<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index(): string
    {
        $taskModel = model(TaskModel::class);
        $userId    = (int) session()->get('userId');
        $tasks     = $taskModel->getTodayTasks($userId);
        $counts    = $taskModel->getStatusCounts(date('Y-m-d'), $userId);

        return $this->renderPage('home/index', [
            'title'      => 'Today',
            'tasks'      => $tasks,
            'counts'     => $counts,
            'totalToday' => count($tasks),
            'summaryItems' => [
                ['label' => 'For today', 'value' => count($tasks), 'icon' => '◷', 'tone' => 'total'],
                ['label' => 'Pending', 'value' => $counts['pending'], 'icon' => '○', 'tone' => 'pending'],
                ['label' => 'In progress', 'value' => $counts['in_progress'], 'icon' => '◌', 'tone' => 'progress'],
                ['label' => 'Completed', 'value' => $counts['completed'], 'icon' => '✓', 'tone' => 'complete'],
            ],
            'todayLabel' => date('l, F j, Y'),
            'greeting'   => $this->greeting(),
            'activePage' => 'today',
        ]);
    }

    private function greeting(): string
    {
        $hour = (int) date('G');

        return match (true) {
            $hour < 12 => 'Good morning',
            $hour < 18 => 'Good afternoon',
            default    => 'Good evening',
        };
    }
}
