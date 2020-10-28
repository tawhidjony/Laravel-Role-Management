
        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label form-control-label">{{ __('Name') }}</label>
            <div class="col-lg-9">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="@if($user->name){{$user->name}}@else{{ old('name') }}@endif" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                @endif
            </div>

        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-3 col-form-label form-control-label">Upload User Image</label>
            <div class="col-md-9">
                <input id="photo" type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}"
                       name="photo" accept="image/*" onchange="readURL(this);" value="@if($user->photo){{$user->photo}}@else{{ old('photo') }}@endif"
                       autofocus>
                @if ($errors->has('photo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
                {{--<img id="image" src="{{URL::to('public/images/',$user->photo)}}" style="width: 100px; height: 100px; margin-top: 5px;" >--}}
            </div>
        </div>

