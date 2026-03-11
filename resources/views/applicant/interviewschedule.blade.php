@extends('applicant.body.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Interview Availability</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('interview.store.availability', ['applicant_id' => $applicant->id]) }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $applicant->name) }}" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $applicant->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div id="availability-group">
                        <div class="availability-slot row">
                            <!-- Date -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="availability[0][date]" required>
                                    @error('availability.0.date')
                                        <div class="alert alert-danger">
                                            <strong>Oops!</strong> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- From -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">From</label>
                                    <input type="time" class="form-control" name="availability[0][from]" required>
                                    @error('availability.0.from')
                                        <div class="alert alert-danger">
                                            <strong>Oops!</strong> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- To -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">To</label>
                                    <input type="time" class="form-control" name="availability[0][to]" required>
                                    @error('availability.0.to')
                                        <div class="alert alert-danger">
                                            <strong>Oops!</strong> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-slot d-none">Remove</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-slot" class="btn btn-secondary mt-2">Add Another Slot</button>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Submit Availability</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- 👇 JavaScript for handling slots and removing them -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let slotIndex = 1;

        // Add another slot
        document.getElementById('add-slot').addEventListener('click', function () {
            const group = document.getElementById('availability-group');
            const currentSlots = group.querySelectorAll('.availability-slot');

            if (currentSlots.length >= 2) {
                alert("You can only provide up to 2 availability slots.");
                return;
            }

            const newSlot = currentSlots[0].cloneNode(true);

            // Clear the values of the newly added slot
            newSlot.querySelectorAll('input').forEach(input => {
                input.value = '';
                const nameAttr = input.getAttribute('name');
                const newName = nameAttr.replace(/\[\d+\]/, `[${slotIndex}]`);
                input.setAttribute('name', newName);
            });

            newSlot.querySelector('.remove-slot').classList.remove('d-none');

            group.appendChild(newSlot);
            slotIndex++;
        });

        // Remove a slot
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-slot')) {
                const group = document.getElementById('availability-group');
                if (group.querySelectorAll('.availability-slot').length > 1) {
                    e.target.closest('.availability-slot').remove();
                    slotIndex--;
                }
            }
        });
    });
</script>
