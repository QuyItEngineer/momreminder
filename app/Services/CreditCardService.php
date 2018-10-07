<?php
/**
 * Created by PhpStorm.
 *
 * @author quyhbn <quyhbn@nal.vn>
 */

namespace App\Services;

use App\Exceptions\ChargeException;
use App\Exceptions\UpdateCreditCardException;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use PhpParser\Node\Expr\Cast\Object_;
use Stripe\Charge;
use Stripe\Stripe;

class CreditCardService implements \App\Contracts\CreditCardService
{

    /**
     * Create or Update credit card
     *
     * @param $token
     * @throws UpdateCreditCardException
     * @author quyhbn <quyhbn@nal.vn>
     */
    public function storeCreditCardWithNumberCard($token)
    {
        $user = User::find(\Auth::user()->id);

        try {
            if (empty($user->stripe_id)) {
                $user->createAsStripeCustomer($token);
            } else {
                $user->updateCard($token);
            }
        } catch (\Exception $ex) {
            \Log::error("Can not update credit card. " . $ex->getMessage());
            throw new UpdateCreditCardException();
        }
    }

    /**
     * Update amount to your account
     *
     * @param User $user
     * @param int $credits
     * @return bool
     * @throws ChargeException
     * @author quyhbn <quyhbn@nal.vn>
     */
    public function updateCreditWithAmountCard(User $user, $credits)
    {
        if ($credits == 0) {
            return true;
        }
        try {
            $amount = $this->getAmountByCredit($credits);
            $user->charge($amount);
            $user->increment('credit', $credits);

            return true;
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            throw new ChargeException();
        }

    }

    /**
     * @param $credits
     * @return float|int
     * @author vuldh <vuldh@nal.vn>
     */
    public function getAmountByCredit($credits)
    {
        $amount = 0;
        if ($credits > 0 and $credits <= 1000) {
            $amount = $credits * 9;
        } else if ($credits > 1000 and $credits <= 2500) {
            $amount = $credits * 8.5;
        } else if ($credits > 2500 and $credits <= 5000) {
            $amount = $credits * 7.5;
        } else if ($credits > 5000 and $credits <= 10000) {
            $amount = $credits * 7.0;
        } else if ($credits > 10000 and $credits <= 25000) {
            $amount = $credits * 6.5;
        } else if ($credits > 25000 and $credits <= 50000) {
            $amount = $credits * 6.0;
        } else if ($credits > 50000) {
            $amount = $credits * 5.5;
        }
        return $amount;
    }

}