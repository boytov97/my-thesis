<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\File;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use File;

    protected $config_path = 'users';

    public function getModel()
    {
        return new User();
    }

    public function showTags($id, $tag = false)
    {
        $view = 'index';

        if($tag) {
            $view = $tag;
        }

        return view('profile.'.$view, [
            'user' => $this->getModel()->findOrFail($id),
            'tag' => $view
        ]);
    }

    public function update(Request $request ,$id)
    {
        $this->validate($request, $this->getRules($request), [], []);

        $user = $this->getModel()->findOrFail($id);
        $user->update($request->all());

        if($request->hasFile('image')) {
            $this->deleteUploads($user, $this->config_path);
            $this->upload($request, $user, $this->config_path);
        }

        return redirect()->back()->with('message', trans('auth.update_success'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            '_token'                => 'required',
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ], [
            '_token.required'                => 'Паролду алмаштыруу үчүн, алгач каталыңыз',
            'password.required'              => 'Жаңы паролду көрсөтүнүз',
            'password.min'                   => 'Пароль 8 символдон көбүрөөк болуусу керек',
            'password_confirmation.required' => 'Жаңы паролду тастыктаңыз',
            'password_confirmation.same'     => 'Паролдор шайкеш келген жок',
        ]);

        $user = $this->getModel()->findOrFail($id);
        $password = $request->get('password');

        $user->forceFill([
            'password'       => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        return redirect()->back()->with('message', trans('auth.update_pass_success'));
    }

    protected function getRules($request)
    {
        return [
            'fullname' => 'required|max:255',
            'city' => 'required|max:255',
            'birthday' => 'required|date|max:255',
        ];
    }

}
