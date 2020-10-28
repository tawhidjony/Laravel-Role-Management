
    <div class="box-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="input-10"
                   name="name" placeholder="Enter Role Name" value="@if($role->name){{$role->name}}@else{{old('name')}}@endif">
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
     </div>


    <div class="box-body">
        <div class="form-group">
            <div class="well">

                <ul class="checkbox-tree root">
                    <li>
                        <input type="checkbox" id="select-all"/>
                        <label for="select-all">Select All </label>
                    </li>
                </ul>

                @foreach($route_tree as $key => $route)

                    @if(is_array($route))

                        <ul class="checkbox-tree root">
                            <li class="parent-menu">
                                @php $count =0; @endphp

                                @foreach($route as $k => $rm)
                                {{-- <li>all {{$key.'.'.$rm}}</li> --}}
                                    @if($role->name && $role->hasPermissionTo($key.'.'.$rm)) @php $count++; @endphp  @endif
                                @endforeach

                                <span class="collapsed float-left"><i class="fa fa-angle-right"></i></span>
                                <input type="checkbox" id="md_checkbox_{{$key}}" class="filled-in chk-col-info parent"
                                       name="" @if($count == count($route)) checked @endif/>
                                <label for="md_checkbox_{{$key}}">{{$key}}</label>

                                <ul class="menu">
                                    @foreach($route as $k => $rm)
                                        <li>
                                            <input type="checkbox" id="md_checkbox_{{$key.$k}}"
                                                   class="filled-in chk-col-info children"
                                                   @if($role->name && $role->hasPermissionTo($key.'.'.$rm)) checked @endif
                                                   name="permissions[]" value="{{$key.'.'.$rm}}"/>
                                            <label for="md_checkbox_{{$key.$k}}">{{$rm}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @else

                        <ul class="checkbox-tree root">
                            <li class="single-menu">
                                <input type="checkbox" id="md_checkbox_{{$key}}" class="filled-in chk-col-info children"
                                       @if($role->name && $role->hasPermissionTo($route)) checked @endif
                                       name="permissions[]" value="{{$route}}"/>
                                <label for="md_checkbox_{{$key}}">{{$route}}</label>
                            </li>
                        </ul>

                    @endif
                @endforeach
            </div>
        </div>
     </div>




