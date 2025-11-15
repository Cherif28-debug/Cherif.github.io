<?php
ini_set('session.save_path', __DIR__ . '/../sessions/');
if (!is_dir(__DIR__ . '/../sessions')) {
    mkdir(__DIR__ . '/../sessions', 0700, true);
}
