-- Run this once against the existing ever_task database to preserve its records.
USE ever_task;

ALTER TABLE users
  ADD COLUMN password_hash VARCHAR(255) NULL AFTER email,
  ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'owner' AFTER password_hash;

ALTER TABLE tasks
  ADD COLUMN user_id INT NULL FIRST,
  ADD INDEX idx_tasks_user_date (user_id, task_date),
  ADD CONSTRAINT fk_tasks_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL;

-- Existing records remain intact. First-time setup assigns unowned sample tasks to the new owner.
