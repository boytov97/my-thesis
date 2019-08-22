<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CheckedExercise extends Model
{
    protected $table = 'checked_exercise';

    protected $fillable = ['user_id', 'exercise_id', 'user_answers'];

    /**
     * Возвращает проверенную упражнени с ответом пользователья
     *
     * @param $id
     * @return mixed
     */
    public function getCheckedExercise($id)
    {
        return $this->where('user_id', Auth::user()->id)->where('exercise_id', $id)->get();
    }
}
