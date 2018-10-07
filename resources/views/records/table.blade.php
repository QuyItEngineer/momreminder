@section('css')
    @include('layouts.datatables_css')
@endsection

<div class="table-responsive mt-1">
{!! $dataTable->table(['width' => '100%', 'class' => 'table table-bordered table-striped']) !!}
</div>

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection