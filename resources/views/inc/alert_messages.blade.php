<div class="mt-2">
    @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
    @endif
    
    
    @if (strlen(Session::get('error_message') > 1) && $error_message = Session::get('error_message'))
    @php
      Session::put('error_message', '');
    @endphp
    <div class="alert alert-danger">
      {!! $error_message !!}
    </div>
    @endif
    
    
    @if (strlen(Session::get('success_message') > 1) && $success_message = Session::get('success_message'))
    @php
      Session::put('success_message', '');
    @endphp
    <div class="alert alert-success">
      {!! $success_message !!}
    </div>
    @endif    
</div>