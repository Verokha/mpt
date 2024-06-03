<?php

namespace App\Console\Commands;

use App\Models\Request;
use DateTime;
use Illuminate\Console\Command;

class FlushArchiveRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:flush-archive-request {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $day = $this->argument('day');
        $beforeDate = (new DateTime("- $day days"))->setTime(23, 59, 59);
        $requests = Request::where('created_at', '<=', $beforeDate)
            ->where('status', '=', Request::ARCHIVE)
            ->get();
        $requests->each(fn (Request $request) => $request->delete());

        return Command::SUCCESS;
    }
}
