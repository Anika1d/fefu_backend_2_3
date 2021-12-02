<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Redirect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeNewsSlug extends Command
{
    protected $signature = 'change_news_slug {old_slug} {new_slug}';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $old_slug = $this->argument('old_slug');
        $new_slug = $this->argument('new_slug');

        $this->info($old_slug);
        $this->info($new_slug);

        if ($old_slug === $new_slug) {
            $error_slug = '$old_slug and $new_slug must be different.';

            $this->error_message($error_slug);
            return 1;
        }

        $same_redirect = Redirect::query()->where('old_slug',
            route('news_get_route', ['slug' => $old_slug], false))
            ->where('new_slug', route('news_get_route', ['slug' => $new_slug], false))
            ->first();

        if ($same_redirect !== null) {
            $error_slug = 'this redirect already exist.';

            $this->error_message($error_slug);
            return 1;
        }

        $news = News::query()->where('slug', $old_slug)->first();
        if ($news === null) {
            $error_slug = 'news was not found by $old_slug.';

            $this->error_message($error_slug);
            return 1;
        }

        DB::transaction(function () use ($news, $new_slug) {
            Redirect::query()->where('old_slug', route('news_get_route',
                ['slug' => $new_slug], false))->delete();
            $news->slug = $new_slug;
            $news->save();
        });

        return Command::SUCCESS;
    }

    private function error_message($error)
    {
        $this->newLine(1);
        $this->error(str_repeat(' ', strlen($error) + 4));
        $this->error('  ' . $error . '  ');
        $this->error(str_repeat(' ', strlen($error) + 4));
        $this->newLine(1);
    }

}
