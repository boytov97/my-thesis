<?php

namespace App\Http\Controllers;

use App\User;
use App\Tests;
use App\CheckedTests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CategoryRepository;

class TestController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getModel()
    {
        return new Tests();
    }

    public function getUserModel()
    {
        return new User();
    }

    public function getCheckedTestsModel()
    {
        return new CheckedTests();
    }

    public function index()
    {
        return view('test.index');
    }

    public function showTestByCategorySlug($slug)
    {
        $results = null;

        $category = $this->categoryRepository->getCategoryBySlug($slug);
        $entities = $this->getModel()->where('category_id', $category->id)->order()->get();
        $items = $this->getCheckedTestsModel()->getCheckedTest($category->id);

        if (count($items)) {
            $results     = json_decode($items[0]->common_result);
            $userAnswers = json_decode($items[0]->user_answers);

            foreach ($entities as $entity) {
                $key = 'answ' . $entity->id;
                $entity->user_answer = $userAnswers->$key;
            }
        }

        return view('test.show', [
            'entities' => $entities,
            'category' => $category,
            'results'  => $results
        ]);
    }

    public function check(Request $request, $id)
    {
        $this->validate($request, $this->getRules($request), $this->getMessages(), []);

        $answers = $request->all();
        $entities = $this->getModel()->where('category_id', $id)->order()->get();

        $result = [];

        foreach ($entities as $entity) {
            if ($answers['answ' . $entity->id] === $entity->answer) {
                $result['answ' . $entity->id] = 1;
            } else {
                $result['answ' . $entity->id] = $entity->answer;
            }
        }

        $this->storeTestScore($result);
        $commonResult = $this->count($result);
        $this->storeResults($id, $answers, $commonResult);

        return response()->json([
            'result'        => $result,
            'common_result' => $commonResult
        ]);
    }

    protected function count($result)
    {
        $correct = 0;

        foreach ($result as $key => $value) {
            if ($value) {
                $correct += (int)$value;
            }
        }

        $percent = round(100 / count($result) * (int)$correct);

        return ['question_count' => count($result), 'corrects' => $correct, 'percent' => $percent];
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

    protected function storeTestScore(array $result): void
    {
        $user = $this->getUserModel()->findOrFail(Auth::user()->id);

        $score = $user->score_test;
        foreach ($result as $answer) {
            if ((int)$answer) {
                $score = $score + 5;
            }
        }

        $user->forceFill([
            'score_test' => $score,
        ])->save();
    }

    protected function storeResults($id, $answers, $commonResult)
    {
        $this->getCheckedTestsModel()->create([
            'user_id'       => Auth::user()->id,
            'test_id'       => $id,
            'user_answers'  => json_encode($answers),
            'common_result' => json_encode($commonResult)
        ]);
    }
}
