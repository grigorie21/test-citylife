<?php

namespace App\Console\Commands;

use App\Models\Chapter;
use Illuminate\Console\Command;

class parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     *
     */
    public function handle()
    {
        $chaptersArr = [];

        $url = "https://www.lostfilm.tv/new";
        $html = file_get_contents($url);
        $html = \phpQuery::newDocumentHTML($html);

        //for quick test
        $lastPage = 10;

        // will take 5 or more minutes
        // $lastPage = (int)pq($html)->find('.pagging-pane a:eq(6)')->text();

        for ($i = 1; $i <= $lastPage; $i++) {

            $url = "https://www.lostfilm.tv/new/page_{$i}";
            $html = file_get_contents($url);
            $html = \phpQuery::newDocumentHTML($html);


            foreach (pq($html)->find('.row') as $node) {

                $chapter = [
                    'serial_title_ru' => pq($node)->find('.name-ru')->text(),
                    'serial_title_en' => pq($node)->find('.name-en')->text(),
                    'chapter_title_ru' => pq($node)->find('.details-pane div:eq(0)')->text(),
                    'chapter_title_en' => pq($node)->find('.details-pane div:eq(1)')->text(),
                    'url' => 'https://www.lostfilm.tv'.pq($node)->find('a:eq(0)')->attr('href'),
                    'date' => preg_replace('/(Дата выхода Ru: )/', '', pq($node)->find('.details-pane div:eq(3)')->text()),
                ];
                array_push($chaptersArr, $chapter);
            }
        }
        Chapter::truncate();
        Chapter::insert($chaptersArr);
    }
}
