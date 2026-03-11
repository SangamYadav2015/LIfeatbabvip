<form method="POST" action="{{ route('applicant.updatePersonalInfo', $applicant->id) }}">
    @csrf
    @method('PUT')

    <!-- Name Fields -->
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $applicant->personalInformation->first_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Middle Name</label>
        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $applicant->personalInformation->middle_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $applicant->personalInformation->last_name ?? '') }}">
    </div>

    <!-- Contact Info -->
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $applicant->personalInformation->email ?? '') }}">
    </div>

    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $applicant->personalInformation->phone ?? '') }}">
    </div>

    <!-- Gender -->
    <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="">Select</option>
            <option value="male" {{ old('gender', $applicant->personalInformation->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $applicant->personalInformation->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $applicant->personalInformation->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <!-- Address Fields -->
    <div class="form-group">
        <label>House No</label>
        <input type="text" name="house_no" class="form-control" value="{{ old('house_no', $applicant->personalInformation->house_no ?? '') }}">
    </div>

    <div class="form-group">
        <label>Landmark</label>
        <input type="text" name="landmark" class="form-control" value="{{ old('landmark', $applicant->personalInformation->landmark ?? '') }}">
    </div>

    <div class="form-group">
        <label>Area</label>
        <input type="text" name="area" class="form-control" value="{{ old('area', $applicant->personalInformation->area ?? '') }}">
    </div>

    <div class="form-group">
        <label>Current Address</label>
        <input type="text" name="current_address" class="form-control" value="{{ old('current_address', $applicant->personalInformation->current_address ?? '') }}">
    </div>

    <div class="form-group">
        <label>Permanent Address</label>
        <input type="text" name="permanent_address" class="form-control" value="{{ old('permanent_address', $applicant->personalInformation->permanent_address ?? '') }}">
    </div>

    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $applicant->personalInformation->city ?? '') }}">
    </div>

    <div class="form-group">
        <label>State</label>
        <input type="text" name="state" class="form-control" value="{{ old('state', $applicant->personalInformation->state ?? '') }}">
    </div>

    <div class="form-group">
        <label>Zip</label>
        <input type="text" name="zip" class="form-control" value="{{ old('zip', $applicant->personalInformation->zip ?? '') }}">
    </div>

    <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $applicant->personalInformation->country ?? '') }}">
    </div>

    <!-- DOB -->
    <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $applicant->personalInformation->date_of_birth ?? '') }}">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save and Next</button>
</form>
