<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CheckedTests extends Model
{
    protected $table = 'checked_tests';

    protected $fillable = ['user_id', 'test_id', 'user_answers', 'common_result'];

    /**
     * Возвращает проверенную тест с ответом и резултатом пользователья
     *
     * @param $id
     * @return mixed
     */
    public function getCheckedTest($id)
    {
        return $this->where('test_id', $id)->where('user_id', Auth::user()->id)->get();
    }
}
