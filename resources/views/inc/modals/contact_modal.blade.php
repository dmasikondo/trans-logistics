  <style>
  .help-block{color: #A8070A;}
  </style>
  <!-- Modal -->
  <div class="modal fade" id="contactModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Contact Details</h4>
        </div>
        <div class="modal-body">
          {!!Form::model($user,['action'=>['UsersController@update',$user->username],
          'class'=>'role','method'=>'PATCH','id'=>'contactForm'])!!}
          {!!Form::hidden('username',null)!!}
            <div class="form-group has-feedback {{ $errors->has('organisation') ? ' has-error' : '' }}">
              <label for="organisation"><span class="glyphicon glyphicon-compressed"></span> Organisation</label>
              {!!Form::text('organisation',null,['class'=>'form-control', 'placeholder'=>'Name?','id'=>'organisation'])!!}
            </div>
              @if ($errors->has('organisation'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('organisation') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('contact_person') ? ' has-error' : '' }}">
              <label for="contact_person"><span class="glyphicon glyphicon-link"></span> Contact Person</label>
              {!!Form::text('contact_person',null, ['class'=>'form-control',
               'id'=>'contact_person', 'placeholder'=>'How many?'])!!}
            </div>
              @if ($errors->has('contact_person'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('contact_person') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
              <label for="contact_phone"><span class="glyphicon glyphicon-phone-alt"></span> Contact Phone</label>
              {!!Form::text('contact_phone',null, ['class'=>'form-control',
               'id'=>'contact_phone', 'placeholder'=>'How many?'])!!}
            </div>
              @if ($errors->has('contact_phone'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('contact_phone') }}</strong>
                  </small>
               @endif 
            <div class="form-group has-feedback {{ $errors->has('whatsapp') ? ' has-error' : '' }}">
              <label for="whatsapp"><span class="glyphicon glyphicon-phone"></span> Whatsapp</label>
              {!!Form::text('whatsapp',null, ['class'=>'form-control',
               'id'=>'whatsapp', 'placeholder'=>'Number?'])!!}
            </div>
              @if ($errors->has('whatsapp'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('whatsapp') }}</strong>
                  </small>
               @endif  
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              {!!Form::text('email',null, ['class'=>'form-control',
               'id'=>'email', 'placeholder'=>'Address?'])!!}
            </div>
              @if ($errors->contact->has('email'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->contact->first('email') }}</strong>
                  </small>
               @endif 
            	<div class="form-group  has-feedback {{ $errors->has('roleList') ? ' has-error' : '' }}">
                	{!!Form::label('roleList','Select User Role')!!}
                	{!!Form::select('roleList[]', $rolz, null, ['class'=>'form-control', 'multiple', 'id'=>'roleList'])!!}
                </div> 
                  @if($errors->has('roleList'))<small class="help-block"> 
                  {{$errors->first('roleList')}}</small>@endif                                                           

                 <button type="submit" class="btn btn-block" id="contact"> Update 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          {!!Form::close()!!}
<!--errors  -->
<p>
<script>
$('#contactForm').submit(function(){
	$('#fleetForm').trigger('reset');
});
</script>  

 </p>          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>>
       
      </div>
    </div>
  </div>


{{-- @endif --}}