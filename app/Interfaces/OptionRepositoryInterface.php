<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface OptionRepositoryInterface
{
    public function getResultsByQuestionId(int $questionId): Collection;
}
