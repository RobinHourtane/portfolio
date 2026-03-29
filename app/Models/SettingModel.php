<?php
namespace App\Models;

class SettingModel extends Model
{
    public function get(string $key, $default = null)
    {
        if (!\hasDatabase()) {
            return $default;
        }

        $stmt = $this->dbOrNull()->prepare('SELECT setting_value FROM settings WHERE setting_key = ?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();

        return $value === false ? $default : $value;
    }

    public function allKeyed(): array
    {
        $settings = [];
        $rows = $this->db()->query('SELECT setting_key, setting_value FROM settings')->fetchAll();

        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    public function saveMany(array $settings): void
    {
        $stmt = $this->db()->prepare(
            'INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?'
        );

        foreach ($settings as $key => $value) {
            $stmt->execute([$key, $value, $value]);
        }
    }
}
