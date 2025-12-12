<?php

if (!function_exists('app_version')) {
    function app_version()
    {
        $file = base_path('.version');
        if (!file_exists($file)) return '0.0.0';
        $data = json_decode(file_get_contents($file), true);
        return $data['version'] ?? '0.0.0';
    }
}

if (!function_exists('app_version_description')) {
    function app_version_description()
    {
        $file = base_path('.version');
        if (!file_exists($file)) return '0.0.0';
        $data = json_decode(file_get_contents($file), true);
        return $data['description'] ?? '0.0.0';
    }
}
