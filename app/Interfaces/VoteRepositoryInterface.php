<?php

namespace App\Interfaces;

use App\Models\Vote;

interface VoteRepositoryInterface
{
    public function create(array $data): Vote;

    public function hasUserVotedForQuestion(int $userId, int $questionId): bool;
}
