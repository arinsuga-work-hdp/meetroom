@php (($fieldEnabled == true ? $disabled='' : $disabled='disabled'))
<div class="card" style="margin-bottom: 20px; width: 50%;
margin-left: auto; margin-right:auto;">
    <div class="card-body">

      <!-- text input -->
      <div class="form-group">
        <label>Name</label>
        <input {{ $disabled }} type="text" id="name" name="name" class="form-control" value="{{ ( $errors->any() ? old('name') : $viewModel->data->name ) }}">
        <p class="text-red">{{ $errors->first('name') }}</p>
      </div>

      <!-- text input -->
      <div class="form-group">
        <label>Phone / Ext</label>
        <input {{ $disabled }} type="text" id="phone_ext" name="phone_ext" class="form-control" value="{{ ( $errors->any() ? old('phone_ext') : $viewModel->data->phone_ext ) }}">
        <p class="text-red">{{ $errors->first('phone_ext') }}</p>
      </div>

      <!-- text input -->
      <div class="form-group">
        <label>Email</label>
        <input {{ $disabled }} type="text" id="email" name="email" class="form-control" value="{{ ( $errors->any() ? old('email') : $viewModel->data->email ) }}">
        <p class="text-red">{{ $errors->first('email') }}</p>
      </div>

      <!-- text input -->
      <div class="row">
        <div class="form-group col-md-2 col-sm-12">
          <label>Participants</label>
          <input {{ $disabled }} type="text" id="participants" name="participants" class="form-control" value="{{ ( $errors->any() ? old('participants') : $viewModel->data->participants ) }}">
        </div>
        <div class="col-md-1- col-sm-12">
          <p class="text-red">{{ $errors->first('participants') }}</p>
        </div>
      </div>

      <div class="form-group">
        <label>Meeting Date</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="meetingdt" id="meetingdt" value="{{ ( $errors->any() ? old('meetingdt') : $viewModel->data->meetingdt ) }}"/>
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          @else
            <div class="col-md-4 col-sm-12">
              <input {{ $disabled }} type="text" id="meetingdt" name="meetingdt" class="form-control"
              value="{{ ( $errors->any() ? old('meetingdt') : \Arins\Facades\Formater::date($viewModel->data->meetingdt) ) }}">
            </div>
          @endif
        </div>
        <p class="text-red">{{ $errors->first('meetingdt') }}</p>
      </div>

      <div class="form-group">
        <label>Start (06:00 - 24:00)</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="startdt" id="startdt" value="{{ ( $errors->any() ? old('startdt') : Arins\Facades\Formater::timeshort($viewModel->data->startdt) ) }}"/>
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-clock"></i></div>
              </div>
            </div>
          @else
            <div class="col-md-4 col-sm-12">
              <input {{ $disabled }} type="text" id="startdt" name="startdt" class="form-control"
              value="{{ ( $errors->any() ? old('startdt') : \Arins\Facades\Formater::time($viewModel->data->startdt) ) }}">
            </div>
          @endif
        </div>
        <p class="text-red">{{ $errors->first('startdt') }}</p>
      </div> <!-- end form-group -->

      <div class="form-group">
        <label>End (06:00 - 24:00)</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="enddt" id="enddt" value="{{ ( $errors->any() ? old('enddt') : Arins\Facades\Formater::timeshort($viewModel->data->enddt) ) }}"/>
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-clock"></i></div>
              </div>
            </div>
          @else
            <div class="col-md-4 col-sm-12">
              <input {{ $disabled }} type="text" id="enddt" name="enddt" class="form-control"
              value="{{ ( $errors->any() ? old('enddt') : \Arins\Facades\Formater::time($viewModel->data->enddt) ) }}">
            </div>
          @endif
        </div>
        <p class="text-red">{{ $errors->first('enddt') }}</p>
      </div> <!-- end form-group -->

      <!-- text input -->
      <div class="form-group">
        <label>Meeting Subject</label>
        <input {{ $disabled }} type="text" id="subject" name="subject" class="form-control" value="{{ ( $errors->any() ? old('subject') : $viewModel->data->subject ) }}">
        <p class="text-red">{{ $errors->first('subject') }}</p>
      </div>

      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="snack" id="snack" {{ ( $viewModel->data->snack == 1 ? 'checked' : '' ) }}>
          <label class="form-check-label" for="exampleCheck1">Snack</label>
        </div>
      </div>

      <!-- textarea -->
      <div class="form-group">
        <label>Additional Request</label>
        <textarea {{ $disabled }} id="description" name="description" class="form-control" rows="3" placeholder="">{{ ( $errors->any() ? old('description') : $viewModel->data->description ) }}</textarea>
        <p class="text-red">{{ $errors->first('description') }}</p>
      </div>

    </div>
</div>


