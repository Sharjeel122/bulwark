
<div class="form-group">
    <label class="form-labels" for="username"><strong>Full Name*:</strong></label>
    <input type="text" class="form-control form-feilds" name="name" placeholder="Enter Full Name" value="{{ $employee->name }}">
    @if ($errors->has('name'))
        <span role="alert">
              <strong class="text-danger">{{ $errors->first('name') }}</strong>
         </span>
    @endif
</div>

<div class="form-group">
    <label class="form-labels" for="username"><strong>Email*:</strong></label>
    <input type="text" class="form-control form-feilds" name="email" placeholder="Enter Email" value="{{ $employee->email }}">
    @if ($errors->has('email'))
        <span role="alert">
              <strong class="text-danger">{{ $errors->first('email') }}</strong>
         </span>
    @endif
</div>

<div class="form-group">
    <label class="form-labels" for="username"><strong>Contact:</strong></label>
    <input type="tel" class="form-control form-feilds" name="contact" placeholder="Enter Contact#" value="{{ $employee->contact }}">
</div>
