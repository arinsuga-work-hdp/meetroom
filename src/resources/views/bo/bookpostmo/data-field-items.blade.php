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
          <input {{ $disabled }} type="text" id="email" name="email" class="form-control" value="{{ ( $errors->any() ? old('email') : $viewModel->data->email ) }}">
          <p class="text-red">{{ $errors->first('email') }}</p>
        </div>
      </div>

      <div class="form-group">
        <label>Meeting Date</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="meetingdt" id="meetingdt"/>
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
        <label>Start</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="startdt" id="startdt"/>
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          @else
            <div class="col-md-4 col-sm-12">
              <input {{ $disabled }} type="text" id="startdt" name="startdt" class="form-control"
              value="{{ ( $errors->any() ? old('startdt') : \Arins\Facades\Formater::date($viewModel->data->startdt) ) }}">
            </div>
          @endif
        </div>
        <p class="text-red">{{ $errors->first('startdt') }}</p>
      </div> <!-- end form-group -->

      <div class="form-group">
        <label>End</label>
        <div class="row">
          @if ($fieldEnabled == true)
            <div class="input-group col-sm-12 col-md-6">
              <input type="text" class="form-control date" name="enddt" id="enddt"/>
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          @else
            <div class="col-md-4 col-sm-12">
              <input {{ $disabled }} type="text" id="enddt" name="enddt" class="form-control"
              value="{{ ( $errors->any() ? old('enddt') : \Arins\Facades\Formater::date($viewModel->data->enddt) ) }}">
            </div>
          @endif
        </div>
        <p class="text-red">{{ $errors->first('enddt') }}</p>
      </div> <!-- end form-group -->

      <div class="form-group">
        <label>Select Meeting Room</label>
        @if ($fieldEnabled == true)
          <select id="room_id" name="room_id" class="form-control select2">
                @foreach ($room as $key => $item)

                  @if ($errors->any())
                    {{ ($item->id == old('room_id') ? $selected = 'selected' : $selected = '') }}
                  @else
                    {{ ( $item->id == $viewModel->data->room_id ) ? $selected = 'selected' : $selected = '' }}
                  @endif
                  <option {{ $selected }} value="{{ $item->id }}">{{ $item->name }}</option>
                  
                @endforeach
          </select>
        @else
          <input type="hidden" name="room_id" value="{{ $viewModel->data->room_id }}" readonly>
          <div class="form-group">
              @if ($viewModel->data->room_id != null)
                <input disabled type="text" value="{{ $viewModel->data->room->name }}" class="form-control">
              @else
                <input disabled type="text" class="form-control">
              @endif
          </div>
        @endif
        <p class="text-red">{{ $errors->first('room_id') }}</p>
      </div>

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


