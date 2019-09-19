<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

//class Serial
//{
//    protected
//
//        $nameSerial = null,
//        $nameChapter = null,
//        $dateChapter = null,
//        $urlInfoChapter = null;
//
//
//    /**
//     * @return null
//     */
//    public function getNameSerial()
//    {
//        return $this->nameSerial;
//    }
//
//    /**
//     * @param null $nameSerial
//     * @return Product
//     */
//    public function setNameSerial($nameSerial)
//    {
//        $this->nameSerial = $nameSerial;
//        return $this;
//    }
//
//    /**
//     * @return null
//     */
//    public function getNameChapter()
//    {
//        return $this->nameChapter;
//    }
//
//    /**
//     * @param null $nameChapter
//     * @return Product
//     */
//    public function setNameChapter($nameChapter)
//    {
//        $this->nameChapter = $nameChapter;
//        return $this;
//    }
//
//
//    /**
//     * @return null
//     */
//    public function getDateChapter()
//    {
//        return $this->dateChapter;
//    }
//
//    /**
//     * @param null $dateChapter
//     * @return Product
//     */
//    public function setDateChapter($dateChapter)
//    {
//        $this->dateChapter = $dateChapter;
//        return $this;
//    }
//
//
//    /**
//     * @return null
//     */
//    public function getUrlInfoChapter()
//    {
//        return $this->urlInfoChapter;
//    }
//
//    /**
//     * @param null $urlInfoChapter
//     * @return Product
//     */
//    public function setUrlInfoChapter($urlInfoChapter)
//    {
//        $this->urlInfoChapter = $urlInfoChapter;
//        return $this;
//    }
//
//
//}

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $chaptersArr = [];

        for ($i = 1; $i <= 10; $i++) {

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

        Chapter::insert($chaptersArr);
    }
    public function list(Request $request){
        $model = Chapter::where('id','<',10)->get()->sortBy('date');

        dd($model);
        return view('index', ['model' => $model]);
    }
}
