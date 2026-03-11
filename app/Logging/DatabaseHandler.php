<?php
namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use App\Models\Log;
use Monolog\Logger;
use Monolog\LogRecord;

class DatabaseHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(LogRecord $record): void
    {
        Log::create([
            'level' => $record->level->getName(),
            'message' => $record->formatted,
            'context' => json_encode($record->context),
        ]);
    }
}

