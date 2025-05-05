use Illuminate\Support\Facades\Route;
use VendorAliHadi\EmailCampaign\Http\Controllers\CampaignController;

Route::prefix('api/email-campaign')->group(function () {
    Route::post('/import-customers', [CampaignController::class, 'import']);
    Route::post('/create', [CampaignController::class, 'create']);
    Route::post('/send/{campaign}', [CampaignController::class, 'send']);
});