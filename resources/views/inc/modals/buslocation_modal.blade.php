
  <!-- Modal -->
  <div class="modal fade" id="buslocationModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-transfer"></span> Business Location</h4>
        </div>
        <div class="modal-body">
    @if(count($user->buslocation)>0) 
    	@foreach($user->buslocation as $location)
          {!!Form::model($location,['action'=>['BuslocationsController@update',$ref->id],
          'class'=>'role','method'=>'PATCH','id'=>'refForm'])!!}
       	@endforeach
    @else
          {!!Form::open(['action'=>['BuslocationsController@store'],
          'class'=>'role','id'=>'refForm1'])!!}
          {!!Form::hidden('user_id',$user->id)!!}    
   	@endif
            <div class="form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
              <label for="address1"><span class="glyphicon glyphicon-random"></span> Address</label>
              {!!Form::text('address',null, ['class'=>'form-control',
               'id'=>'address', 'placeholder'=>'Address?'])!!}
            </div>
              @if ($errors->has('address'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('address') }}</strong>
                  </small>
               @endif    
            <div class="form-group has-feedback {{ $errors->has('city') ? ' has-error' : '' }}">
              <label for="city"><span class="glyphicon glyphicon-tower"></span> City / Town</label>
              {!!Form::text('city',null,['class'=>'form-control', 'placeholder'=>'City?','id'=>'city'])!!}
            </div>
              @if ($errors->has('city'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('city') }}</strong>
                  </small>
              @endif   

            <div class="form-group has-feedback {{ $errors->has('country') ? ' has-error' : '' }}">
              <label for="phone"><span class="glyphicon glyphicon-flag"></span> Country</label>
              {!!Form::text('country',null, ['class'=>'form-control',
               'id'=>'country', 'placeholder'=>'Country?'])!!}
            </div>
              @if ($errors->has('country'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('country') }}</strong>
                  </small>
               @endif
              <button type="submit" class="btn btn-block">Upload 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          {!!Form::close()!!}
      
<!--errors  -->
<p>   
  

 </p>   
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
       
      </div>
    </div>
  </div>
