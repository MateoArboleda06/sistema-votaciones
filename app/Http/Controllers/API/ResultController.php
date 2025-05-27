<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Interfaces\OptionRepositoryInterface;

class ResultController extends Controller
{
    protected $optionRepository;

    public function __construct(OptionRepositoryInterface $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    public function show(Question $question)
    {
        $results = $this->optionRepository->getResultsByQuestionId($question->id);

        return response()->json([
            'question' => $question->title,
            'results' => $results
        ]);
    }
}

