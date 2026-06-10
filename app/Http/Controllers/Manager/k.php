functionpublic propositions( $id)
{
$propositions = session('propositions_' . $id);
$conge = Conge::findOrFail($id);
return view('manager.conge.propositions', compact('propostitions', 'conge'));
}

functionpublic proposer(Request $request, $id)
{
$manager = Auth::user();
$conge = Conge::findOrFail($id);
$remplacant = User::findOrFail($id);

$matchingService = app(MatchingService::class);
$remplacement = $matchingService->proposerRemplacant($conge, $remplacant, $manager);

return redirect()->route('manager.conges.index')
->with('success', 'Proposition envoyée à ' . $remplacant->name);
}

functionpublic accepterRemplacement( $id)
{
$remplacement = Remplacement::findOrFail($id);
if ($remplacement->remplacant_id != Auth::id()) {
abort(403);
}
$matchingService = app(MatchingService::class);
$matchingService->accepterRemplacement($remplacement);

return redirect()->route('employe.dashboard')
->with('success', 'Vous avez accepté le remplacement Les tâches ont été transfér');
}

functionpublic refuserRemplacement( $id)
{
$remplacement = Remplacement::findOrFail($id);
if ($remplacement->remplacant_id != Auth::id()) {
abort(403);
}
$remplacement->refuser();
return redirect()->route('employe.dashboard')
->with('info', 'Vous avez refussé le remplacement');
}















$propositions = app(MatchingService::class)->trouverRemplacants($demande);
session(['propositions_' . $demande->id => $propositions]);
