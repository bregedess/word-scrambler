<?php

namespace App\Http\Controllers;

use App\Word;

class WordsController extends Controller
{
    public function index() {
        return Word::paginate();
    }
    public function store() {
        $data = $this->validateRequest();

        return Word::create($data);
    }

    public function update(Word $word)
    {
        $word->update($this->validateRequest());

        return redirect($word->path());
    }

    public function destroy(Word $word)
    {
        $word->delete();

        return redirect('/words');
    }

    public function show(Word $word)
    {
        return $word;
    }

    public function validateRequest() {
        return \request()->validate([
            'value' => 'required|not_regex:/\s/'
        ]);
    }
}
