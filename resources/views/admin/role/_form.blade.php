<div class="form-group">
    <label for="name" class="col-sm-3 control-label">角色名称 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="role[name]" value="{{ isset(old('role')['name']) ? old('role')['name'] : $role['name'] }}" placeholder="请输入角色名称">
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('name') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-3 control-label">角色概述</label>
    <div class="col-sm-6">
        <textarea class="form-control" id="description" name="role[description]" placeholder="请输入角色概述" rows="3">{{ isset(old('role')['description']) ? old('role')['description'] : $role['description']}}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-3 control-label">权限列表</label>
    <div class="col-sm-7">
        <div class="panel-group" id="permission-list-group">
            @foreach($permissions as $permission)
                @if(isset($permission['children']))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <span>
                                {{$permission['label']}}
                            </span>
                                <a class="pull-right" href="#collapse{{$permission['id']}}" data-toggle="collapse">
                                    <i class="fa fa-angle-double-up"></i> 折叠
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{$permission['id']}}" class="panel-collapse collapse in">
                            <div class="panel-body">
                                @foreach($permission['children'] as $child)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="permission[]" value="{{$child['id']}}" {{ isset(old('permission')[0]) ? (in_array($child['id'],old('permission')) ? 'checked' : '') : ( isset($role_permissions) ? (in_array($child['id'],$role_permissions) ? 'checked' : '') : '') }} >{{$child['label']}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@section('script_desc')
    <script type="text/javascript">
        $(function () {
            $("#permission-list-group .panel-collapse").on("show.bs.collapse", function () {
                var _id = $(this).attr('id');
                $("a[href='#"+_id+"']").html('<i class="fa fa-angle-double-up"></i> 折叠');
            })
            $("#permission-list-group .panel-collapse").on("hide.bs.collapse", function () {
                var _id = $(this).attr('id');
                $("a[href='#"+_id+"']").html('<i class="fa fa-angle-double-down"></i> 展开');
            })

        })
    </script>
@endsection