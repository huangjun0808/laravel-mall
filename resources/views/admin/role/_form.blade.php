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
    <div class="col-sm-6">

    </div>
</div>