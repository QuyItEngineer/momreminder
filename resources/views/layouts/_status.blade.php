@if($status == \App\Models\BaseModel::STATUS_ACTIVE)
    <td><span class="label label-success">{{trans('labels.status.items')[$status]}}</span></td>
@endif
@if($status == \App\Models\BaseModel::STATUS_IN_ACTIVE)
    <td><span class="label label-danger">{{trans('labels.status.items')[$status]}}</span></td>
@endif
