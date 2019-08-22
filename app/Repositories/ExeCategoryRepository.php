<?php

namespace App\Repositories;

use App\ExeCategories as Model;

class ExeCategoryRepository
{
    public function getNextPrevId($id)
    {
        $current = Model::find($id);

        $prev = Model::where('grammar_id', $current->grammar_id)->where('id', '<', $id)->max('id');
        $next = Model::where('grammar_id', $current->grammar_id)->where('id', '>', $id)->min('id');

        return ['prev' => $prev, 'next' => $next];
    }
}
