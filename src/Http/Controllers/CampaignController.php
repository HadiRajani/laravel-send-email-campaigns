namespace VendorAliHadi\EmailCampaign\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create(Request $request)
    {
        // validate and create campaign
        return response()->json(['message' => 'Campaign created']);
    }

    public function send($campaignId)
    {
        // queue email sending
        return response()->json(['message' => "Campaign $campaignId queued"]);
    }

    public function import(Request $request)
    {
        // import customers
        return response()->json(['message' => 'Customers imported']);
    }
}
