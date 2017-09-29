<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use \Carbon\Carbon;

//use Log;

class DomainsController extends Controller
{

    /**
     * @param $id
     * @return $this
     */
    public function showItem($id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();
        return view('domains', ['domains' => [$domain]]);
    }

    /**
     * @return $this
     */
    public function showAll()
    {
        $domains = DB::table('domains')->get();
        return view('domains', ['domains' => $domains]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['url' => 'active_url']);

        $url = $request->input('url');

        $id = DB::table('domains')->insertGetId(
            [
                'name' => $url,
                'created_at' => Carbon::now()
            ]
        );

        return redirect()->route('showItemDomain', ['id' => $id]);
    }
}
