<?php

namespace App\Http\Controllers\API;

use App\Models\Vote;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\VoteRepositoryInterface;

class VoteController extends Controller
{
    protected $voteRepository;

    public function __construct(VoteRepositoryInterface $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'option_id' => 'required|exists:options,id'
        ]);

        $option = Option::with('question')->find($validated['option_id']);

        $alreadyVoted = $this->voteRepository->hasUserVotedForQuestion(auth()->id(), $option->question_id);

        if ($alreadyVoted) {
            return response()->json(['message' => 'Ya votaste en esta pregunta'], 403);
        }

        $vote = $this->voteRepository->create([
            'user_id' => auth()->id(),
            'option_id' => $option->id
        ]);

        return response()->json($vote, 201);
    }
}
