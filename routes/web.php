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
    $domains = DB::table('domains')->paginate(2);

    return view('domains', ['domains' => $domains]);
}]);

/*
 * Form
 */
$router->post('domains', ['as' => 'domains.store', function (Request $request) {
    $this->validate($request, ['url' => 'active_url']);

    $url = $request->input('url');

    $id = DB::table('domains')->insertGetId(
        [
            'name' => $url,
            'created_at' => Carbon::now()
        ]
    );

    return redirect()->route('domains.show', ['id' => $id]);
}]);
