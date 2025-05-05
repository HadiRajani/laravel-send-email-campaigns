namespace VendorAliHadi\EmailCampaign\Mail;

use Illuminate\Mail\Mailable;
use VendorAliHadi\EmailCampaign\Models\EmailCampaign;

class CampaignMail extends Mailable
{
    public $campaign;

    public function __construct(EmailCampaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function build()
    {
        return $this->subject($this->campaign->subject)
                    ->html($this->campaign->body);
    }
}
