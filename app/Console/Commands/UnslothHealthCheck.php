<?php

namespace App\Console\Commands;

use App\Services\UnslothImageService;
use Illuminate\Console\Command;

class UnslothHealthCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unsloth:health
                            {--json : Output as JSON}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the health of the Unsloth AI service';

    /**
     * Execute the console command.
     */
    public function handle(UnslothImageService $unsloth): int
    {
        $status = [
            'service' => 'unsloth',
            'timestamp' => now()->toIso8601String(),
            'healthy' => false,
            'endpoint' => config('unsloth.api_endpoint'),
            'model' => config('unsloth.model'),
            'available_models' => [],
        ];

        try {
            $status['healthy'] = $unsloth->isHealthy();

            if ($status['healthy']) {
                $status['available_models'] = array_map(
                    fn ($model) => $model['id'] ?? $model,
                    $unsloth->getAvailableModels()
                );
            }
        } catch (\Exception $e) {
            $status['error'] = $e->getMessage();
        }

        if ($this->option('json')) {
            $this->line(json_encode($status, JSON_PRETTY_PRINT));

            return $status['healthy'] ? self::SUCCESS : self::FAILURE;
        }

        // Human-readable output
        $this->newLine();
        $this->info('Unsloth Health Check');
        $this->line('─────────────────────');
        $this->line("Endpoint: {$status['endpoint']}");
        $this->line("Model: {$status['model']}");
        $this->line('Status: ' . ($status['healthy'] ? '✓ Healthy' : '✗ Unhealthy'));

        if (!empty($status['available_models'])) {
            $this->newLine();
            $this->info('Available Models:');
            foreach ($status['available_models'] as $model) {
                $this->line("  - {$model}");
            }
        }

        if (isset($status['error'])) {
            $this->newLine();
            $this->error("Error: {$status['error']}");
        }

        $this->newLine();

        return $status['healthy'] ? self::SUCCESS : self::FAILURE;
    }
}
