<?php

namespace App\Http\Controllers;

use App\CheckedExercise;
use App\Exercise;
use App\Repositories\ExeCategoryRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    protected $exeCategoryRepository;

    public function __construct(ExeCategoryRepository $exeCategoryRepository)
    {
        $this->exeCategoryRepository = $exeCategoryRepository;
    }

    public function getModel()
    {
        return new Exercise();
    }

    public function getUserModel()
    {
        return new User();
    }

    public function getCheckedExerciseModel()
    {
        return new CheckedExercise();
    }

    public function index($id)
    {
        $checked = false;
        $entities = $this->getModel()->getExerciseByCategoryId($id);
        $items = $this->getCheckedExerciseModel()->getCheckedExercise($id);

        if (count($items)) {
            $checked = true;
            $user_answers = json_decode($items[0]->user_answers);

            foreach ($entities as $entity) {
                $key = 'answer'.$entity->id;
                $entity->user_answer = $user_answers->$key;
            }
        }

        return view('exercise.index', [
            'entities'              => $entities,
            'categoryId'            => $id,
            'prevNextExeCategoryId' => $this->exeCategoryRepository->getNextPrevId($id),
            'checked'               => $checked
        ]);
    }

    public function check(Request $request, $id)
    {
        $items = $this->getCheckedExerciseModel()->getCheckedExercise($id);

        if (count($items)) {
            return response()->json(['checked' => true]);
        }

        $this->validate($request, $this->getRules($request), $this->getMessages(), []);

        $answers = $request->all();
        $entities = $this->getModel()->where('exe_category_id', $id)->active()->order()->get();

        $result = [];

        foreach ($entities as $entity) {
            if ($answers['answer' . $entity->id] === $entity->answer) {
                $result['answer' . $entity->id] = 1;
            } else {
                $result['answer' . $entity->id] = $entity->answer;
            }
        }

        $this->setExerciseScore($result);
        $this->noteAsChecked($id, $answers);

        return response()->json(['result' => $result]);
    }

    protected function setExerciseScore(array $result): void
    {
        $user = $this->getUserModel()->findOrFail(Auth::user()->id);

        $score = $user->score_exe;
        foreach ($result as $answer) {
            if ((int)$answer) {
                $score = $score + 5;
            }
        }

        $user->forceFill([
            'score_exe' => $score,
        ])->save();
    }

    protected function noteAsChecked($id, $answers)
    {
        $this->getCheckedExerciseModel()->create([
            'user_id'      => Auth::user()->id,
            'exercise_id'  => $id,
            'user_answers' => json_encode($answers)
        ]);
    }

    protected function getRules($request)
    {
        $rules = [];

        foreach ($request->all() as $key => $value) {
            $rules[$key] = 'required';
        }

        return $rules;
    }

    protected function getMessages()
    {
        return [
            'required' => 'Баардык суроолорго жооп бергенге аракет кылыныз.'
        ];
    }
}
