@php (($fieldEnabled == true ? $disabled='' : $disabled='disabled'))
<div class="card" style="margin-bottom: 20px; width: 50%;
margin-left: auto; margin-right:auto;">
    <div class="card-body">

      <!-- text input -->
      <div class="form-group">
        <label>Name</label>
        <input type="text" id="name" name="name" class="form-control">
        <p class="text-red">{{ $errors->first('name') }}</p>
      </div>

      <div class="form-group">
        <label>Meeting Date</label>
        <div class="input-group col-sm-12 col-md-6">
            <input type="text" class="form-control date" name="meetingdt" id="meetingdt"/>
            <div class="input-group-append">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>

        <!-- Start Date -->
        <div class="form-group">
            <label>Start/End Time:</label>
            <div class="row">
                <div class="input-group col-sm-12 col-md-6">
                    <input type="text" class="form-control date" name="startdt" id="startdt"/>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

                <div class="input-group col-sm-12 col-md-6">
                    <input type="text" class="form-control date" name="enddt" id="enddt"/>
                    <div class="input-group-append" >
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end form-group -->


        <div class="form-group">
            <label>Status</label>
            <select name="orderstatus_id" class="form-control select2">
                <option selected value="">All</option>
                @php ($selected = '')
                @foreach ($orderstatus as $key => $item)

                    @if ($errors->any())
                        {{ ($item->id == old('orderstatus_id') ? $selected = 'selected' : $selected = '') }}
                    @endif
                    <option {{ $selected }} value="{{ $item->id }}">{{ $item->name }}</option>
                
                @endforeach
            </select>
            <p class="text-red">{{ $errors->first('orderstatus_id') }}</p>
        </div> <!-- end form-group -->

        <!-- text input -->
        <div class="form-group">
            <label>Meeting Subject</label>
            <input type="text" id="subject" name="subject" class="form-control">
            <p class="text-red">{{ $errors->first('subject') }}</p>
        </div> <!-- end form-group -->

      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="snack" id="snack">
          <label class="form-check-label" for="snack">Snack</label>
        </div>
      </div> <!-- end form-group -->

    </div> <!-- end card-body -->
</div> <!-- end card -->


