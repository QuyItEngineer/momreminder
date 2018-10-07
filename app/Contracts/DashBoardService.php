<?php
/**
 * Created by PhpStorm.
 * User: macintosh
 * Date: 8/20/18
 * Time: 10:21 PM
 */

namespace App\Contracts;


interface DashBoardService
{
    public function totalUsers($id);
    public function totalSMS($id);
    public function totalVoices($id);
    public function totalReply($id);

}