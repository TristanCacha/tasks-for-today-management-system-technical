-- EverTask / Tasks for Today - local MySQL setup
-- Import this file once into phpMyAdmin or the MySQL command line.
-- The fixed UTC+08:00 session makes CURDATE() match Asia/Manila.

CREATE DATABASE IF NOT EXISTS ever_task
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE ever_task;
SET time_zone = '+08:00';

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  title VARCHAR(150) NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'pending',
  task_date DATE NOT NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_tasks_user_date (user_id, task_date)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'owner',
  created_at DATETIME NOT NULL
);

ALTER TABLE tasks
  ADD CONSTRAINT fk_tasks_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL;

INSERT INTO tasks (title, status, task_date, created_at) VALUES
('Review the priorities for the day', 'completed', CURDATE(), NOW()),
('Prepare notes for the web systems class', 'in_progress', CURDATE(), NOW()),
('Organize project reference files', 'pending', CURDATE(), NOW()),
('Check yesterday’s unfinished notes', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Organize the weekly study plan', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Review the database lesson', 'in_progress', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Draft a plan for the next study session', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Prepare questions for consultation', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Set aside time for a short break', 'completed', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW());

INSERT INTO users (username, full_name, email, created_at) VALUES
('everdemo', 'Demo User', 'demo.user@example.test', NOW());
