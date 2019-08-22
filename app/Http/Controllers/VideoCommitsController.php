<?php

namespace App\Http\Controllers;

use App\VideoCommits;
use Illuminate\Http\Request;

class VideoCommitsController extends Controller
{
    public function getModel()
    {
        return new VideoCommits();
    }

    public function getRules()
    {
        return [
            'text' => 'required|max:65535'
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->getRules(), [], []);

        $this->getModel()->create($request->all());

        $items = $this->getModel()->getCommits($request->input('video_id'));
        $returnHTML = view('video._commits')->with('items', $items)->render();

        return response()->json([
            'success' => true,
            'html'    => $returnHTML,
            'count'   => $this->getModel()->getCommitsCount($request->input('video_id'))
        ]);
    }
}
