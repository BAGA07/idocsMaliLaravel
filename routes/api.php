use App\Http\Controllers\DeclarationController;
 
Route::get('/statut-declaration/{numero}', [DeclarationController::class, 'statutDeclaration']); 