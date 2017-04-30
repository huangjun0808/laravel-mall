@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible alert-out">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><i class="icon fa fa-check"></i> {{ Session::get('success') }}</strong>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-warning alert-dismissible alert-out">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><i class="icon fa fa-warning"></i> {{ Session::get('error') }}</strong>
    </div>
@endif
<script>
    setTimeout(function () {
        $(".alert-out").fadeOut();
    },3000);
</script>