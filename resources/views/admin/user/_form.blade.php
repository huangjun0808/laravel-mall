<div class="form-group">
    <label for="name" class="col-sm-3 control-label">用户名 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="user[name]" value="{{ isset(old('user')['name']) ? old('user')['name'] : (isset($user['name']) ? $user['name'] : '') }}" placeholder="请输入用户名" {{ isset($user['name']) ? 'readonly' : '' }} >
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('name') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-3 control-label">邮箱 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="email" name="user[email]" value="{{ isset(old('user')['email']) ? old('user')['email'] : (isset($user['email']) ? $user['email'] : '') }}" placeholder="请输入邮箱" {{ isset($user['email']) ? 'readonly' : '' }} >
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('email') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-3 control-label">密码 @if(!isset($user['id'])) <span class="require-star-red">*</span> @endif</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" id="password" name="user[password]" value="" placeholder="{{ !isset($user['id']) ? '请输入密码' : '若密码为空,则不更新密码' }}">
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('password') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="password_confirmation" class="col-sm-3 control-label">确认密码 @if(!isset($user['id'])) <span class="require-star-red">*</span> @endif</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" id="password_confirmation" name="user[password_confirmation]" value="" placeholder="{{ !isset($user['id']) ? '请再次输入密码' : '若密码为空,则不更新密码' }}">
    </div>
</div>
<div class="form-group">
    <label for="roles" class="col-sm-3 control-label">角色列表</label>
    <div class="col-sm-7">
        @if($user['id'] == 1)
            <p class="form-control-static">超级管理员(<span class="text-danger">不可更改</span>)</p>
        @else
            @if(!empty($roles))
            <div class="panel-group" id="role-list-group">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($roles as $role)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="role[]" value="{{ $role['id'] }}" {{ isset(old('role')[0]) ? (in_array($role['id'],old('role')) ? 'checked' : '') : (isset($user_roles) ? (in_array($role['id'],$user_roles) ? 'checked' : '') : '') }} >{{ $role['name'] }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
                <p class="form-control-static">暂无角色  <a href="{{ url('admin/role/create') }}">添加</a></p>
            @endif
        @endif
    </div>
</div>