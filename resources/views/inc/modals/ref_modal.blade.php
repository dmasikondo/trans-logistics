
  <!-- Modal -->
  <div class="modal fade" id="refModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-thumps-up"></span> Trade Reference</h4>
        </div>
        <div class="modal-body">
    @if(count($user->traderef)>0) 
    	@foreach($user->traderef as $ref)
          {!!Form::model($ref,['action'=>['TraderefController@update',$ref->id],
          'class'=>'role','method'=>'PATCH','id'=>'refForm'])!!}
       	@endforeach
    @else
          {!!Form::open(['action'=>['TraderefController@store'],
          'class'=>'role','id'=>'refForm1'])!!}
          {!!Form::hidden('user_id',$user->id)!!}    
   	@endif
            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name"><span class="glyphicon glyphicon-list"></span> Trade Reference</label>
              {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Name?','id'=>'name1'])!!}
            </div>
              @if ($errors->has('name'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('name') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
              <label for="address1"><span class="glyphicon glyphicon-tent"></span> Address</label>
              {!!Form::text('address',null, ['class'=>'form-control',
               'id'=>'address', 'placeholder'=>'Address?'])!!}
            </div>
              @if ($errors->has('address'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('address') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone"><span class="glyphicon glyphicon-phone"></span> Contact Phone</label>
              {!!Form::text('phone',null, ['class'=>'form-control',
               'id'=>'phone', 'placeholder'=>'Contact Phone?'])!!}
            </div>
              @if ($errors->has('phone'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('phone') }}</strong>
                  </small>
               @endif
              <button type="submit" class="btn btn-block">Update 
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
