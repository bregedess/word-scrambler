<?php

namespace App\Http\Controllers;

use App\DataTables\WordsDataTable;
use App\Word;
use Facade\FlareClient\Http\Exceptions\NotFound;

class WordsController extends Controller
{
    public function index(WordsDataTable $dataTable) {
        return $dataTable->render('words.index');
    }

    public function create()
    {
        return view('words.create');
    }

    public function store() {
        $data = $this->validateRequest();

        $word = Word::create($data);

        return $word;
    }

    public function edit(Word $word)
    {
        return view('words.edit', $word);
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

    public function guess()
    {
        request()->validate([
            'id'    => 'required',
            'value' => 'required',
        ]);

        $word = Word::where('id', request('id'))
            ->where('value', request('value'))
            ->first();

        if (!$word) {
            return redirect('home');
        }

        return $word;
    }

    public function validateRequest() {
        return \request()->validate([
            'value' => 'required|not_regex:/\s/'
        ]);
    }
}
