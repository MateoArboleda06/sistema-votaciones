<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface QuestionRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): mixed;

    public function findWithOptions(int $id): mixed;
}
