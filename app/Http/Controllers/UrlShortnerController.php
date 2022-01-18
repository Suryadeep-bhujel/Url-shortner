<?php

namespace App\Http\Controllers;

use App\Models\Admin\UtmTracking\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlShortnerController extends Controller
{
    public function __construct(ShortUrl $url)
    {
        $this->url = $url;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $urls = $this->url->latest()->paginate();
        $data = [
            'urls' => $urls,
        ];
        return view('admin.urls.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'urlInfo' => null,
            "title" => "Add New Url",
            "route" => route('urls.store'),
            "method" => "POST",
        ];
        return view('admin.urls.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string',
            'original_url' => "required|url|unique:short_urls,original_url",
            "status" => "required|boolean",
            'length' => "required|numeric"
        ]);
        // dd($request->all());
        try {
            DB::beginTransaction();
            $params = parse_url($request->original_url, $component = -1);
            // dd($params);
            do {
                $url_code = \Str::random($request->length ?? 6);
                $repated = $this->url->where("url_code", $url_code)->first();
            } while ($repated != null);
            // dd($url_code);
            $data = [
                'original_url' => $request->original_url,
                'title' => $request->title,
                'status' => $request->status ?? false,
                "url_code" => $url_code,
                "length" => $request->length,
                "params" => $params['query'],
                'added_by' => auth()->user()->id,
            ];
            $this->url->create($data);
            DB::Commit();
            $request->session()->flash('success', 'New Url successfully added.');
            return redirect()->route('urls.index');
        } catch (\Throwable$th) {
            // throw $th;
            DB::rollback();
            $request->session()->flash('error', 'There was problem while adding new url.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $url = $this->url->where('url_code', $id)->first();
        if(!$url){
            request()->session()->flash("error", "Url information not found.");
            return redirect()->route("urls.index");
        }

        $data = [
            'urlInfo' => $url,
            "title" => "Edit Url",
            "route" => route('urls.update', $url->url_code),
            "method" => "PUT",
        ];
        return view('admin.urls.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       

        $url = $this->url->where('url_code', $id)->first();
        if(!$url){
            request()->session()->flash("error", "Url information not found.");
            return redirect()->route("urls.index");
        }
       
        $this->validate($request, [
            'title' => 'required|string',
            'original_url' => "required|url|unique:short_urls,original_url,$url->id",
            "status" => "required|boolean",
            'length' => "required|numeric"
        ]);
        try {
            DB::beginTransaction();
            $params = parse_url($request->original_url, $component = -1);
            $url_code =$url->url_code;
            if($request->length != $url->length ){
                do {
                    $url_code = \Str::random($request->length ?? 6);
                    $repated = $this->url->where("url_code", $url_code)->where("id", '!=', $url->url_code)->first();
                } while ($repated != null);
    
            }
            // dd($url_code);
            $data = [
                'original_url' => $request->original_url,
                'title' => $request->title,
                'status' => $request->status ?? false,
                "url_code" => $url_code,
                "length" => $request->length,
                "params" => $params['query'],
                // 'added_by' => auth()->user()->id,
            ];
            $url->fill($data)->save();
            DB::Commit();
            $request->session()->flash('success', 'URL has been  successfully updated.');
            return redirect()->route('urls.index');
        } catch (\Throwable$th) {
            // throw $th;
            DB::rollback();
            $request->session()->flash('error', 'There was problem while updating  url.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function urlshortner(Request $request, $code)
    {
        $url = $this->url->where('url_code', $code)->where('status', true)->first();
        if (!$url) {
            $request->session()->flash('info', "The Url you are looking for not found.");
            return redirect()->route('index');
        }
        return redirect($url->original_url, 302);
    }
}
