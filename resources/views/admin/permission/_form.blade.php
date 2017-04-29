<div class="form-group">
    <label for="name" class="col-sm-3 control-label">权限规则 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="permission[name]" value="{{ isset(old('permission')['name']) ? old('permission')['name'] : $permission['name'] }}" placeholder="请输入权限规则">
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('name') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="label" class="col-sm-3 control-label">权限名称 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="label" name="permission[label]" value="{{ isset(old('permission')['label']) ? old('permission')['label'] : $permission['label'] }}" placeholder="请输入权限名称">
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('label') }}</p>
    </div>
</div>
<div class="form-group">
    <label for="icon" class="col-sm-3 control-label">图标</label>
    <div class="col-sm-6">
        <button class="btn btn-default" id="icon" name="permission[icon]" data-cols="8" data-rows="6" data-iconset="fontawesome" data-icon="{{ isset(old('permission')['icon']) ? old('permission')['icon'] : ($permission['icon'] ? $permission['icon'] : 'fa-arrows') }}" role="iconpicker"></button>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-3 control-label">权限概述</label>
    <div class="col-sm-6">
        <textarea class="form-control" id="description" name="permission[description]" placeholder="请输入权限概述" rows="3">{{ isset(old('permission')['description']) ? old('permission')['description'] : $permission['description']}}</textarea>
    </div>
</div>