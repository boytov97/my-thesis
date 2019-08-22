<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoCommits;

class VideoController extends Controller
{
    public $videoCommits;

    public function __construct(VideoCommits $videoCommits)
    {
        $this->videoCommits = $videoCommits;
    }

    public function getModel()
    {
        return new Video();
    }

    public function index()
    {
        $entities = $this->getModel()->active()->order()->get();

        return view('video.index', [
            'entities' => $entities
        ]);
    }

    public function show($id)
    {
        return view('video.show', [
            'entity' => $this->getModel()->findOrFail($id),
            'items'  => $this->videoCommits->getCommits($id),
            'count'  => $this->videoCommits->getCommitsCount($id)
        ]);
    }
}
