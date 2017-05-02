@if(Session::has('success'))
    <div class="callout callout-success callout-out">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
@if(Session::has('error'))
    <div class="callout callout-warning callout-out">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif
<script>
    setTimeout(function () {
        $(".callout-out").fadeOut();
    },2000);
</script>