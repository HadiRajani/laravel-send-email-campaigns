use Illuminate\Support\Facades\Route;
use VendorAliHadi\EmailCampaign\Http\Controllers\CampaignController;

Route::prefix('email-campaign')->group(function () {
    Route::post('/campaigns', [CampaignController::class, 'store']);
    Route::post('/campaigns/{id}/send', [CampaignController::class, 'send']);
    Route::get('/customers/filter', [CampaignController::class, 'filterCustomers']);
});