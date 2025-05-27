<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\QuestionRepositoryInterface;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        return $this->questionRepository->all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required'
        ]);

        $question = $this->questionRepository->create($validated);

        return response()->json($question, 201);
    }

    public function show($id)
    {
        $question = $this->questionRepository->findWithOptions($id);

        if (!$question) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        return response()->json($question);
    }
}
