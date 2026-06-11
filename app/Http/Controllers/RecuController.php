<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRecuRequest;
use App\Models\Recu;
use App\Enums\StatutRecu;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RecuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecuRequest $request): RedirectResponse
    {
        $recu = Recu::create([
            'user_id' => auth()->id(),
            'texte_source' => $request->validated('texte_source'),
            'statut' => StatutRecu::EN_ATTENTE,
            'devise' => 'MAD',

        ]);

        return redirect()->route('recus.show', $recu->id)->with('success', 'Reçu créé avec succès. Traitement en cours.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recu $recu)
    {
       abort_if($recu->user_id !== auth()->id(), 403);
          $recu->load('depenses');
         return view('recus.show', compact('recu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recu $recu)
    {
          {
        abort_if($recu->user_id !== auth()->id(), 403);

        $recu->delete();

        return redirect()
            ->route('recus.index')
            ->with('success', 'Reçu supprimé avec succès.');
    }
    }
}
