namespace VendorAliHadi\EmailCampaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use VendorAliHadi\EmailCampaign\Models\{EmailCampaign, Customer, EmailDeliveryLog};
use VendorAliHadi\EmailCampaign\Mail\CampaignMail;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmail implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $campaign;
    public $customer;

    public function __construct(EmailCampaign $campaign, Customer $customer)
    {
        $this->campaign = $campaign;
        $this->customer = $customer;
    }

    public function handle()
    {
        try {
            Mail::to($this->customer->email)->send(new CampaignMail($this->campaign));
            EmailDeliveryLog::create([
                'campaign_id' => $this->campaign->id,
                'customer_id' => $this->customer->id,
                'status' => 'sent',
            ]);
        } catch (\Exception $e) {
            EmailDeliveryLog::create([
                'campaign_id' => $this->campaign->id,
                'customer_id' => $this->customer->id,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
