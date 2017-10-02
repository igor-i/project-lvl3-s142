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
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Artisan;

use Carbon\Carbon;

use App\Jobs\DoWebpageRequestJob;

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
    // TODO ВНИМАНИЕ! Здесь вручную выполняются задания из очереди, это не правильно!
    // В нормальном приложении задания из очереди должны отслеживаться Супервизором или выполняться по расписанию в cron
    // (но в Heroku планировщик платный, поэтому в учебном проекте решил вставить такой жуткий костыль)
//    Artisan::call('queue:work', ['--once' => true]);
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
    // валидация формы
    $this->validate($request, ['url' => 'active_url']);

    // сохраняем url в базу
    $id = DB::table('domains')->insertGetId(
        [
            'name' => $request->input('url'),
            'created_at' => Carbon::now()
        ]
    );

    // ставим задание в очередь (задание запрашивает url и собирает информацию по странице)
    Queue::push(new DoWebpageRequestJob($id));

    return redirect()->route('domains.show', ['id' => $id]);
}]);
