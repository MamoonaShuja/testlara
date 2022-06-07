<?php

namespace App\Http\Controllers;

use App\Models\UserUrl;
use App\Http\Requests\StoreUserUrlRequest;
use App\Http\Requests\UpdateUserUrlRequest;
use Illuminate\Support\Facades\Redirect;

class UserUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(StoreUserUrlRequest $request)
    {
        $url = new UserUrl();
        $rand_str = $this->generateRandomString();
        $find = UserUrl::whereRandStr($rand_str)->count();
        while($find != 0){
            $rand_str = $this->generateRandomString();
        }
        $url->rand_str = $rand_str;
        $url->url = $request->url;
        $url->save();
        $rand = env("APP_URL" , "localhost")."/".$rand_str;
        return redirect()->back()->with('success' , "The url you have to visit is ". $rand);

    }

    private function generateRandomString($length = 5) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserUrl  $userUrl
     * @return \Illuminate\Http\Response
     */
    public function redirect($url)
    {
        $dat = UserUrl::whereRandStr($url)->first();
        return Redirect::to($dat->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserUrl  $userUrl
     * @return \Illuminate\Http\Response
     */
    public function edit(UserUrl $userUrl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserUrlRequest  $request
     * @param  \App\Models\UserUrl  $userUrl
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserUrlRequest $request, UserUrl $userUrl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserUrl  $userUrl
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserUrl $userUrl)
    {
        //
    }
}
