<?php

namespace App;

use Admin\Helper;

class Setting
{
    public DB $db;
    public array $settings;
    public string $file;

    public function __construct($file)
    {
        $c = Register::get('container');
        $pdo = Helper::getPdo($c['config']['db']);
        $this->db = new Db($pdo);
        $this->file = pathinfo($file, PATHINFO_FILENAME);
        $this->settings = require ROOT . '/settings/' . $file . '.php';
    }

    public static function toArray($rows): array
    {
        $data = [];
        foreach ($rows as $row) {
            $data[$row['setting_name']] = $row['setting_value'];
        }
        return $data;
    }

    public function getSettings($group = '', $key = ''): array
    {
        $settings = [];
        foreach ($this->settings as $g => $setting) {
            $sql = "SELECT * FROM bgo_setting WHERE setting_group=:group";
            $stmt = $this->db->query($sql, ['group' => $g]);
            $rows = $stmt->fetchAll();
            $data = self::toArray($rows);
            foreach ($setting as $k => $item) {
                if (isset($data[$k]) && strlen($data[$k]) > 0) {
                    if (is_array($item['value']) || !empty($item['i18n'])) {
                        $value = json_decode($data[$k], true);
                    } else {
                        $value = $data[$k];
                    }
                    $item['value'] = $value;
                }
                $setting[$k] = $item;
            }
            $settings[$g] = $setting;
        }

        return $group ? ($key ? $settings[$group][$key] : $settings[$group]) : $settings;
    }

    public function getValues($group = '', $key = ''): array
    {
        $settings = [];
        foreach ($this->settings as $g => $setting) {
            $sql = "SELECT * FROM bgo_setting WHERE setting_group=:group";
            $stmt = $this->db->query($sql, ['group' => $g]);
            $rows = $stmt->fetchAll();
            $data = self::toArray($rows);
            foreach ($setting as $k => $item) {
                $value = $item['value'];
                if (isset($data[$k]) && strlen($data[$k]) > 0) {
                    if (is_array($item['value']) || !empty($item['i18n'])) {
                        $value = json_decode($data[$k], true);
                    } else {
                        $value = $data[$k];
                    }
                }
                if (is_array($value) && isset($item['options']) && is_array($item['options'])) {
                    $values = [];
                    foreach ($value as $val) {
                        $values[$val] = $item['options'][$val];
                    }
                    $value = $values;
                }
                $setting[$k] = $value;
            }
            $settings[$g] = $setting;
        }

        return $group ? ($key ? $settings[$group][$key] : $settings[$group]) : $settings;
    }

    public function saveSettings($post): int
    {
        $data = [];
        foreach ($this->settings as $group => $setting) {
            foreach ($setting as $key => $item) {
                $value = $post[$key] ?? $item['value'];
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $data[] = [
                    'setting_file'  => $this->file,
                    'setting_group' => $group,
                    'setting_name'  => $key,
                    'setting_value' => $value
                ];
            }
        }

        $data = array_filter($data, function ($v) {
            return strlen($v['setting_value']) > 0;
        });

        foreach ($data as $item) {
            $sql = "REPLACE INTO bgo_setting(setting_file, setting_group, setting_name, setting_value) VALUES(:setting_file, :setting_group, :setting_name, :setting_value)";
            $this->db->query($sql, $item);
        }

        return count($data);
    }
}
