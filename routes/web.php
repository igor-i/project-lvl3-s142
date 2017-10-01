<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use GuzzleHttp\Client;

use DiDom\Document;
use DiDom\Query;

/*
 * Home
 */
$router->get('/', ['as' => 'home', function () use ($router) {

    return view('home');
}]);

/*
 * Domains/{id}
 */
$router->get('domains/{id}', ['as' => 'domains.show', function ($id) {
    $domain = DB::table('domains')->where('id', $id)->first();

    return view('domain', ['domain' => $domain]);
}]);

/*
 * Domains
 */
$router->get('domains', ['as' => 'domains.index', function () {
    $domains = DB::table('domains')->paginate(5);

    return view('domains', ['domains' => $domains]);
}]);

/*
 * Form
 */
$router->post('domains', ['as' => 'domains.store', function (Request $request) {
    $this->validate($request, ['url' => 'active_url']);

    $url = $request->input('url');
    $client = new Client(['base_uri' => $url]);
    $response = $client->request('GET');
    $code = (int) $response->getStatusCode();
    if ($response->hasHeader('Content-Length')) {
        $contentLength = (int) $response->getHeaderLine('Content-Length');
    } else {
        $contentLength = null;
    }
    $body = (string) $response->getBody();

    $dom = new Document($body);
    $h1Text = empty($h1 = $dom->first('h1')) ? null : $h1->text();
    $keywordsContent =
        empty($keywords = $dom->first('meta[name=keywords]')) ? null : $keywords->getAttribute('content');
    $descriptionContent =
        empty($description = $dom->first('meta[name=description]')) ? null : $description->getAttribute('content');

    $id = DB::table('domains')->insertGetId(
        [
            'name' => $url,
            'content_length' => $contentLength,
            'code' => $code,
            'body' => $body,
            'h1' => $h1Text,
            'keywords' => $keywordsContent,
            'description' => $descriptionContent,
            'created_at' => Carbon::now()
        ]
    );

    return redirect()->route('domains.show', ['id' => $id]);
}]);
