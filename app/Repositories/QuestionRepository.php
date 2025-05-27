<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function all(): Collection
    {
        return Question::with('options')->get();
    }

    public function create(array $data): Question
    {
        DB::beginTransaction();
        
        $question = Question::create([
            'title' => $data['title']
        ]);

        foreach ($data['options'] as $optionText) {
            $question->options()->create(['text' => $optionText['text']]);
        }

        DB::commit();

        return $question->load('options');
    }

    public function findWithOptions(int $id): ?Question
    {
        return Question::with('options')->find($id);
    }
}
