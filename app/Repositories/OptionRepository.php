<?php

namespace App\Repositories;

use App\Interfaces\OptionRepositoryInterface;
use App\Models\Option;
use Illuminate\Support\Collection;

class OptionRepository implements OptionRepositoryInterface
{
    public function getResultsByQuestionId(int $questionId): Collection
    {
        return Option::where('question_id', $questionId)
            ->withCount('votes')
            ->get()
            ->map(function ($option) {
                return [
                    'option' => $option->text,
                    'votes' => $option->votes_count
                ];
            });
    }
}
