<?php

namespace App\Models;

use CodeIgniter\Model;

/** Reads the one demo profile required by the assessment. */
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'full_name', 'email', 'password_hash', 'role', 'created_at'];

    // The required schema has created_at but no updated_at column.
    protected $useTimestamps = false;

    /** Return the signed-in account; null is handled by the page controller. */
    public function getDemoUser(): ?array
    {
        $userId = session()->get('userId');
        $user   = is_numeric($userId)
            ? $this->select('id, username, full_name, email, role, created_at')->find((int) $userId)
            : null;

        return is_array($user) ? $user : null;
    }

    public function hasConfiguredAccount(): bool
    {
        return $this->where('password_hash IS NOT NULL', null, false)
            ->where('password_hash !=', '')
            ->countAllResults() > 0;
    }

    public function getById(int $id): ?array
    {
        $user = $this->find($id);

        return is_array($user) ? $user : null;
    }

    public function getByUsername(string $username): ?array
    {
        $user = $this->where('username', $username)->first();

        return is_array($user) ? $user : null;
    }

    public function getFirstAccountId(): ?int
    {
        $user = $this->orderBy('id', 'ASC')->first();

        return is_array($user) ? (int) $user['id'] : null;
    }
}
