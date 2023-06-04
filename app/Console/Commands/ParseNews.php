<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Console\Command;

class ParseNews extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse news from newsapi';

    /**
     * Execute the console command.
     */
    public function handle(NewsService $newsService)
    {
        $result = $newsService->getLatestNews();
        $insertData = $result->map(function ($item) {
            return [
                'author' => $item['author'],
                'title' => $item['title'],
                'content' => $item['content'],
                ];
        });
        News::query()->insert($insertData->toArray());
    }
}
