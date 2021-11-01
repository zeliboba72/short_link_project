<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'link' => 'required|min:10',
        ]);
        $inputLink = $data["link"];

        $row = ShortLink::where('link', '=', $inputLink)->first();

        if ($row) {
            $url = url($row->token);
            return redirect()->route('home')->with('url', $url);
        }

        $newToken = Str::random(6);
        while (ShortLink::where('token', '=', $newToken)->first()) {
            $newToken = Str::random(6);
        }
        $newRow = new ShortLink();
        $newRow->token = $newToken;
        $newRow->link = $inputLink;
        $newRow->save();
        $url = url($newToken);
        return redirect()->route('home')->with('url', $url);
    }

    public function redirectTrueLink($token)
    {
        $row = ShortLink::where('token', '=', $token)->first();
        if ($row) {
            return redirect()->away($row->link);
        }
        return abort(404);
    }

    public function index()
    {
        return view('home');
    }
}
