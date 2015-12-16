<?php

namespace Speednet;

final class UploadProgress
{
    /** @var string */
    private $prefix;

    /** @var string */
    private $name;

    public function __construct()
    {
        $this->prefix = ini_get("session.upload_progress.prefix");
        $this->name = ini_get("session.upload_progress.name");
    }

    public function progress($uploadName)
    {
        $key = $this->getKey($uploadName);

        if (! isset($_SESSION[$key])) {
            return 100;
        }

        $progress = $_SESSION[$key]['bytes_processed'] / $_SESSION[$key]['content_length'];

        return round($progress * 100, 2);
    }

    private function getKey($uploadName)
    {
        return sprintf('%s%s', $this->prefix, $uploadName);
    }
}
