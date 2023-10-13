@extends('layouts.admin')
@push('page-title')
    Admin Restaurant Tables Create
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Create Restaurant Table</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.restaurant-bookings.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> All Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.restaurant-bookings.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">First Name *</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }} example@example.com" required>
                                <small>If you do not have the customers email address please leave leave the above in or input reservations@mashtun-aberlour.com as the email address is required</small>
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="">Mobile Number</label>
                                <input type="tel" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Joining for *</label>
                                <select name="joining_for" id="joining_for" required>
                                    <option selected disabled> -- Select an option --</option>
                                    <option value="lunch">Lunch</option>
                                    <option value="evening">Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date *</label>
                                <input type="date" name="reservation_date" id="reservation_date"  max="{{ $max_date->addMonths(6)->format('Y-m-d') }}" value="{{ old('reservation_date') }}">
                                @error('reservation_date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Time *</label>
                                <select name="reservation_time" id="reservation_time" required>
                                    <option value="{{ old('reservation_time') }}">
                                        {{ old('reservation_time') }}
                                    </option>
                                </select>
                                @error('reservation_time')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Number of guests *</label>
                                <input type="number" name="no_of_guests" id="no_of_guests" required>
                                @error('no_of_guests')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Table *</label>
                                <select name="table_ids[]" id="table_ids" multiple required style="height: 100px;">
                                    @foreach($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->name }} - {{ $table->no_of_seats }} seats</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Dietary Information</label>
                                <textarea name="dietary_information" id="dietary_information" cols="30" rows="10">{{ old('dietary_information') }}</textarea>
                                @error('dietary_information')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Additional Information</label>
                                <textarea name="additional_information" id="additional_information" cols="30" rows="10">{{ old('additional_information') }}</textarea>
                                @error('additional_information')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="darkGoldBtn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            var selectedJoiningFor = '';

            $('#joining_for').change(function(){
                selectedJoiningFor = $(this).val();
                updateReservationTime(selectedJoiningFor);
            });

            function updateReservationTime(joiningFor) {
                var timeOptions = '';

                if(joiningFor === 'lunch') {
                    timeOptions =
                        '<option value="12:00">12:00</option>' +
                        '<option value="12:15">12:15</option>' +
                        '<option value="12:30">12:30</option>' +
                        '<option value="12:45">12:45</option>' +
                        '<option value="13:00">13:00</option>' +
                        '<option value="13:15">13:15</option>' +
                        '<option value="13:30">13:30</option>' +
                        '<option value="13:45">13:45</option>' +
                        '<option value="14:00">14:00</option>'
                }
                else if(joiningFor === 'evening') {
                    timeOptions =
                        '<option value="18:00">18:00</option>' +
                        '<option value="18:15">18:15</option>' +
                        '<option value="18:30">18:30</option>' +
                        '<option value="18:45">18:45</option>' +
                        '<option value="19:00">19:00</option>' +
                        '<option value="19:15">19:15</option>' +
                        '<option value="19:30">19:30</option>' +
                        '<option value="19:45">19:45</option>' +
                        '<option value="20:00">20:00</option>'
                }

                //Update the html element
                $('#reservation_time').html(timeOptions);
            }
        });
    </script>
@endsection
