<?php

namespace App\Http\Controllers;

use App\Enums\StatutRecu;
use App\Http\Requests\StoreRecuRequest;
use App\Models\Recu;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RecuController extends Controller
{
    public function index(): View
    {
        $recus = auth()->user()
            ->recus()
            ->withCount('depenses')
            ->latest()
            ->paginate(10);

        return view('recus.index', compact('recus'));
    }

    public function create(): View
    {
        return view('recus.create');
    }

    public function store(StoreRecuRequest $request): RedirectResponse
    {
        $recu = Recu::create([
            'user_id' => auth()->id(),
            'texte_source' => $request->validated('texte_source'),
            'statut' => StatutRecu::EN_ATTENTE,
            'devise' => 'MAD',
        ]);

        return redirect()
            ->route('recus.show', $recu)
            ->with('success', 'Reçu créé avec succès. Traitement en cours.');
    }

    public function show(Recu $recu): View
    {
        abort_if($recu->user_id !== auth()->id(), 403);

        $recu->load('depenses');

        return view('recus.show', compact('recu'));
    }

    public function destroy(Recu $recu): RedirectResponse
    {
        abort_if($recu->user_id !== auth()->id(), 403);

        $recu->delete();

        return redirect()
            ->route('recus.index')
            ->with('success', 'Reçu supprimé avec succès.');
    }
}