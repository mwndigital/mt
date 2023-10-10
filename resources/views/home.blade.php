@if(Auth()::user()->hasRole(['super admin', 'admin']))
    <script>
        window.location = '{{ route('admin.dashboard') }}';
    </script>
@elseif(Auth()::user()->hasRole('customer'))
    <script>
        window.location = '{{ route('customer.dashboard') }}';
    </script>
@else
    <div class="row">
        <div class="col-12 text-center">
            <h1>
                You do not belong here
            </h1>
        </div>
    </div>
@endif

