<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('pages.question.index', compact('questions'));
    }

    public function create()
    {
        return view('pages.question.create');
    }

    public function store(StoreQuestionRequest $request)
    {

        Question::create($request->all());
        return redirect()->route('question.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        // dd($question);
        return view('pages.question.edit', compact('question'));
    }

    public function update(StoreQuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('question.index');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('question.index');
    }
}