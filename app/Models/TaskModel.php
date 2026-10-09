<?php

namespace App\Models;

use CodeIgniter\Model;

/** Reads tasks using the exact table supplied in the assessment. */
class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'title', 'status', 'task_date', 'created_at'];

    // The required schema has created_at but no updated_at column.
    protected $useTimestamps = false;

    /** @return list<array<string, mixed>> */
    public function getTodayTasks(?int $userId = null): array
    {
        $builder = $this->where('task_date', date('Y-m-d'));
        if ($userId !== null) {
            $builder->where('user_id', $userId);
        }

        return $builder
            ->orderBy('created_at', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    /** @return list<array<string, mixed>> */
    public function getAllTasksOrdered(?int $userId = null): array
    {
        $builder = $this->builder();
        if ($userId !== null) {
            $builder->where('user_id', $userId);
        }

        return $builder->orderBy('task_date', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();
    }

    /** @return array{pending:int, in_progress:int, completed:int} */
    public function getStatusCounts(?string $taskDate = null, ?int $userId = null): array
    {
        $builder = $this->builder();

        if ($taskDate !== null) {
            $builder->where('task_date', $taskDate);
        }
        if ($userId !== null) {
            $builder->where('user_id', $userId);
        }

        $rows = $builder->select('status, COUNT(*) AS total')
            ->groupBy('status')
            ->get()
            ->getResultArray();

        $counts = ['pending' => 0, 'in_progress' => 0, 'completed' => 0];
        foreach ($rows as $row) {
            $status = (string) $row['status'];
            if (array_key_exists($status, $counts)) {
                $counts[$status] = (int) $row['total'];
            }
        }

        return $counts;
    }

    public function getForUser(int $id, int $userId): ?array
    {
        $task = $this->where('id', $id)->where('user_id', $userId)->first();

        return is_array($task) ? $task : null;
    }
}
