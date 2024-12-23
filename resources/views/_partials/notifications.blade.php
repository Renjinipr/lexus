
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable"  style="padding-left:40% !important;">
 {{ $message }}
</div>
{{ Session::forget('success') }}
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable">
{{ $message }}
</div>
{{ Session::forget('error') }}
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning:</strong> {{ $message }}
</div>
{{ Session::forget('warning') }}
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>FYI:</strong> {{ $message }}
</div>
{{ Session::forget('info') }}
@endif


