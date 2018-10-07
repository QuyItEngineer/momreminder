<?php
/**
 * Created by PhpStorm.
 * User: quyhbn <hoangbuingocquy@gmail.com>
 * Date: 8/28/18
 * Time: 11:15 PM
 */

namespace App\Contracts;


use App\Models\User;

interface CreditCardService
{

    public function storeCreditCardWithNumberCard($token);

    public function updateCreditWithAmountCard(User $user, $credits);

}