<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 5/17/18
 * Time: 5:23 PM
 */

namespace App\Observers;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait RecordFingerPrintTrait
 * @package App\Observers
 * @author Lai Vu <vuldh@nal.vn>
 *
 * @property User createdBy
 * @property User updatedBy
 *
 * @method static \Eloquent observe($obj)
 * @method HasOne hasOne($related, $foreignKey = null, $localKey = null)
 */
trait RecordFingerPrintTrait
{
    public static function bootRecordFingerPrintTrait()
    {
        static::observe(new RecordFingerPrintObserver());
    }

    /**
     * @return HasOne
     * @author Lai Vu <vuldh@nal.vn>
     */
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * @return HasOne
     * @author Lai Vu <vuldh@nal.vn>
     */
    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    /**
     * @return HasOne
     * @author Lai Vu <vuldh@nal.vn>
     */
    public function deletedBy()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
