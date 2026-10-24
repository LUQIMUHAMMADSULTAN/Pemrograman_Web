<?php
if (!function_exists('e')) {
    function e($value): string {
        return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rupiah')) {
    function rupiah($number): string {
        return 'Rp ' . number_format((float) ($number ?? 0), 0, ',', '.');
    }
}

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string {
        return BASEURL . '/' . ltrim($path, '/');
    }
}

if (!function_exists('take_flash')) {
    function take_flash(): ?array {
        if (empty($_SESSION['flash'])) return null;
        $f = $_SESSION['flash']; 
        unset($_SESSION['flash']); 
        return $f;
    }
}

if (!function_exists('write_log')) {
    function write_log(string $message, string $level = 'INFO'): void {
        $logDir = ROOT_PATH . '/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        
        $logFile = $logDir . '/app_' . date('Y-m-d') . '.log';
        $time = date('Y-m-d H:i:s');
        $logEntry = "[$time] [$level] $message" . PHP_EOL;
        
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}