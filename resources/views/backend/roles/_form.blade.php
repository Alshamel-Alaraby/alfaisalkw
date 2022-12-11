<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">الأسم</label>
            <input type="text" value="{{$role->name??''}}" name="name" id="name" class="form-control" placeholder="@lang('tr.Enter Role Name')" required>
        </div>
    </div>
</div>


	@if(count($permissions))
        @foreach( string_grouping($permissions) as $permission_base_name => $permission_data)
            @if(is_array($permission_data))
                <hr/>
                <div style="padding: 10px; border: 2px solid #eee;margin-bottom:10px;">
                    @if($loop->iteration==1)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="selectAll"> <input type="checkbox" id="selectAll"> Select All</label>
                            </div>
                        </div>
                    </div>
                    @endif
                    <h4>{{ $permission_base_name }}</h4><br>
                    <div class="row">
                        @foreach( $permission_data as $permission_value => $permission_name)
                        <div class="col-lg-2">
                            <div class="form-group" style="background: #eeeeee54; padding: 10px; text-align: center; color: black; font-weight: bold; border: 2px solid #eee;">
                                <input type="checkbox" name="permissions[]" value="{{ $permission_value }}" id="{{$permission_value}}" @if($role->hasPermissionTo($permission_value)) checked @endif ><br/>
                                <label for="{{$permission_value}}">{{\Illuminate\Support\Str::ucfirst($permission_name)}} {{$permission_base_name}}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @else
                <hr/>
                <div style="padding: 10px; border: 2px solid #eee;margin-bottom:10px;">
                    <h4>{{ $permission_base_name }}</h4><br>
                    <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group" style="background: #eeeeee54; padding: 10px; text-align: center; color: black; font-weight: bold; border: 2px solid #eee;">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission_base_name }}" id="{{$permission_value}}" @if($role->hasPermissionTo($permission_base_name)) checked @endif ><br/>
                                    <label for="{{$permission_base_name}}">{{\Illuminate\Support\Str::ucfirst($permission_data)}} {{$permission_base_name}}</label>
                                </div>
                            </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
@push('js')
    <script>
        $("#selectAll").change(function(){
            if( $(this).is(":checked") ){
                $("input[type=checkbox]").prop('checked',true);
            }else{
                $("input[type=checkbox]").each(function(){
                    $(this).prop('checked',false);
                });
            }
        });
    </script>
@endpush
