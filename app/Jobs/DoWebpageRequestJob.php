<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use GuzzleHttp\Client;

use DiDom\Document;

class DoWebpageRequestJob extends Job
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 120;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 5;

    /**
     * The ID of record in Domains table
     *
     * @var int
     */
    protected $id;

    /**
     * DoWebpageRequestJob constructor.
     *
     * @param $id
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // достаём URL домена
        $url = DB::table('domains')->where('id', $this->id)->value('name');

        // делаем http-запрос по URL, достаём заголовки и тело
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET');
        $code = (int) $response->getStatusCode();
        if ($response->hasHeader('Content-Length')) {
            $contentLength = (int) $response->getHeaderLine('Content-Length');
        } else {
            $contentLength = null;
        }
        $body = (string) $response->getBody();

        // парсим тело
        $dom = new Document($body);
        $h1 = $dom->first('h1');
        $h1Text = empty($h1) ? null : $h1->text();
        $keywords = $dom->first('meta[name=keywords]');
        $keywordsContent = empty($keywords) ? null : $keywords->getAttribute('content');
        $description = $dom->first('meta[name=description]');
        $descriptionContent = empty($description) ? null : $description->getAttribute('content');

        // сохраняем результат в БД
        DB::table('domains')
            ->where('id', $this->id)
            ->update(
                [
                    'content_length' => $contentLength,
                    'code' => $code,
                    'body' => $body,
                    'h1' => $h1Text,
                    'keywords' => $keywordsContent,
                    'description' => $descriptionContent,
                    'updated_at' => Carbon::now()
                ]
            );
    }
}
