@section('before_css')
    @include('layouts.datatables_css')
@endsection
<form method="GET" id="search-form" class="form-inline" role="form">
    @csrf
    <div class="form-group">
        <label for="name">Keyword</label>
        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="search">
    </div>
    <div class="form-group">
        <label for="form_date">Form Date</label>
        <input type="date" class="form-control" name="from_date" id="from_date" data-date-format="mm-dd-yyyy">
        {{--<input type="date" class="form-control date date-picker" name="from_date" id="from_date">--}}
    </div>
    <div class="form-group">
        <label for="to_date">To Date</label>
        <input type="date" class="form-control" name="to_date" id="to_date" data-date-format="mm-dd-yyyy">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Group</label>
            {{Form::select('groups',$groups->pluck('name', 'id') ,null, ['id' => 'groups', 'class'=>'form-control', 'placeholder'=> 'All'])}}
    </div>
    <div style="margin-top: 10px;">
        <button type="submit" class="btn btn-primary"><span class="fa fw fa-search"></span> Search</button>
        <button type="button" id="contact-reset-button" class="btn btn-default"> <span class="fa fw fa-refresh"></span>     Reset</button>
    </div>
</form>

{!! $dataTable->table(['width' => '100%', 'id' => 'list-customer-table-id', 'class' => 'table table-bordered table-striped'], true) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $('#search-form').on('submit', function (e) {
            $('#list-customer-table-id').DataTable().draw();
            e.preventDefault();
        });
    </script>

    <script type="text/javascript">
        $("#contact-reset-button").on("click", function () {
            window.location.href = '/contacts';
        });
    </script>

@endsection


