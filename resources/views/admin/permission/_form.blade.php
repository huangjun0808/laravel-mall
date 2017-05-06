<div class="form-group">
    <label for="name" class="col-sm-3 control-label">权限规则 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="permission[name]" value="{{ isset(old('permission')['name']) ? old('permission')['name'] : $permission['name'] }}" placeholder="请输入权限规则">
        <span class="help-block">规则1：单个规则  例如：规则</span>
        <span class="help-block">规则2：多个规则(#分割)  例如：规则一#规则二</span>
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
<div class="form-group" style="display: none;" id="form-group-uri">
    <label for="uri" class="col-sm-3 control-label">路由地址 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="uri" name="permission[uri]" value="{{ isset(old('permission')['uri']) ? old('permission')['uri'] : $permission['uri'] }}" placeholder="请输入路由地址">
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('uri') }}</p>
    </div>
</div>
{{--@if((isset($cid) && $cid != 0) || (isset($permission['cid']) && $permission['cid'] != 0))--}}
<div class="form-group">
    <label for="type" class="col-sm-3 control-label">是否菜单 <span class="require-star-red">*</span></label>
    <div class="col-sm-6">
        <label class="radio-inline">
            <input type="radio" name="permission[type]" value="0" {{ isset(old('permission')['type']) ? (old('permission')['type']==0 ? 'checked' : '') : ( $permission['type']==0 ? 'checked' : '') }} >权限(默认)
        </label>
        <label class="radio-inline">
            <input type="radio" name="permission[type]" value="1" {{ isset(old('permission')['type']) ? (old('permission')['type']==1 ? 'checked' : '') : ( $permission['type']==1 ? 'checked' : '') }} >左侧菜单
        </label>
    </div>
    <div class="col-sm-3">
        <p class="form-control-static text-danger">{{ $errors->first('type') }}</p>
    </div>
</div>
{{--@endif--}}
<div class="form-group">
    <label for="icon" class="col-sm-3 control-label">图标</label>
    <div class="col-sm-6">
        <button class="btn btn-default" id="icon" name="permission[icon]" data-cols="8" data-rows="6" data-iconset="fontawesome" data-icon="{{ isset(old('permission')['icon']) ? old('permission')['icon'] : ($permission['icon'] ? $permission['icon'] : 'fa-circle-o') }}" role="iconpicker"></button>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-3 control-label">权限概述</label>
    <div class="col-sm-6">
        <textarea class="form-control" id="description" name="permission[description]" placeholder="请输入权限概述" rows="3">{{ isset(old('permission')['description']) ? old('permission')['description'] : $permission['description']}}</textarea>
    </div>
</div>
@section('script_desc')
    <script>
        $(function () {
            var _type = '{{ $permission['type'] }}';
            var _cid = '{{ $permission['cid'] ? $permission['cid'] : (isset($cid) ? $cid : '') }}';
            var _old_type = '{{ old('permission')['type'] }}';
            //初始化表单
            if((_type == '0' || _type == '') && (_old_type == '0' || _old_type == '') && (_cid == '0' || _cid == '')){
                $('#form-group-uri').hide();
            }else{
                $('#form-group-uri').show();
            }
            console.log(_type);
            //权限表单权限类型改变事件
            $(document).on('change', 'input[name="permission[type]"]', function(){
                if($(this).val() == 1 || (_cid != '' && _cid != '0')){
                    $('#form-group-uri').slideDown();
                }else{
                    $('#form-group-uri').slideUp();
                }
            });
        })
    </script>
@endsection