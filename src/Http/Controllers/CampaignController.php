namespace VendorAliHadi\EmailCampaign\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VendorAliHadi\EmailCampaign\Models\{Customer, EmailCampaign, EmailDeliveryLog};
use Illuminate\Support\Facades\Mail;
use VendorAliHadi\EmailCampaign\Jobs\SendCampaignEmail;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $campaign = EmailCampaign::create($data);

        return response()->json(['message' => 'Campaign created', 'campaign' => $campaign]);
    }

    public function filterCustomers(Request $request)
    {
        $request->validate([
            'status' => 'nullable|string',
            'days_until_expiry' => 'nullable|integer'
        ]);

        $query = Customer::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->days_until_expiry) {
            $query->whereBetween('plan_expiry_date', [
                now(), now()->addDays($request->days_until_expiry)
            ]);
        }

        return response()->json($query->get());
    }

    public function send(Request $request, $id)
    {
        $campaign = EmailCampaign::findOrFail($id);

        $customers = Customer::query();

        if ($request->status) {
            $customers->where('status', $request->status);
        }

        if ($request->days_until_expiry) {
            $customers->whereBetween('plan_expiry_date', [
                now(), now()->addDays($request->days_until_expiry)
            ]);
        }

        foreach ($customers->get() as $customer) {
            SendCampaignEmail::dispatch($campaign, $customer);
        }

        return response()->json(['message' => 'Emails are being sent']);
    }
}
