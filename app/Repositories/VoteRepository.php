<?php

namespace App\Repositories;

use App\Interfaces\VoteRepositoryInterface;
use App\Models\Vote;
use App\Models\Option;

class VoteRepository implements VoteRepositoryInterface
{
    public function create(array $data): Vote
    {
        return Vote::create($data);
    }

    public function hasUserVotedForQuestion(int $userId, int $questionId): bool
    {
        $optionIds = Option::where('question_id', $questionId)->pluck('id');

        return Vote::where('user_id', $userId)
            ->whereIn('option_id', $optionIds)
            ->exists();
    }
}
