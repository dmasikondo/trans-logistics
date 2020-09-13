  <!-- Modal -->
  <div class="modal fade" id="fleetModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-bed"></span> Fleet</h4>
        </div>
        <div class="modal-body">
      @if(count($user->fleet)>0) 
        @foreach($user->fleet as $fleet)
          {!!Form::model($fleet,['action'=>['FleetController@update',$fleet->id],
          'class'=>'role','method'=>'PATCH','id'=>'fleetForm'])!!}
        @endforeach
      @else
          {!!Form::open(['action'=>['FleetController@store'],
          'class'=>'role','id'=>'fleetForm'])!!}
          {!!Form::hidden('user_id',$user->id)!!}       
      @endif
            <div class="form-group has-feedback {{ $errors->has('horses') ? ' has-error' : '' }}">
              <label for="horses"><span class="glyphicon glyphicon-horse"></span> Truck horses</label>
              {!!Form::text('horses',null,['class'=>'form-control', 'placeholder'=>'How many?','id'=>'horses'])!!}
            </div>
              @if ($errors->has('horses'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('horses') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('trailer_qty') ? ' has-error' : '' }}">
              <label for="trailer_qty"><span class="glyphicon glyphicon-shopping-cart"></span> Trailers</label>
              {!!Form::text('trailer_qty',null, ['class'=>'form-control',
               'id'=>'trailer_qty', 'placeholder'=>'How many?'])!!}
            </div>
              @if ($errors->has('trailer_qty'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('trailer_qty') }}</strong>
                  </small>
               @endif
            	<div class="form-group  has-feedback {{ $errors->has('trailerList') ? ' has-error' : '' }}">
                	{!!Form::label('trailerList','Select Trailer Types')!!}
                	{!!Form::select('trailerList[]', $trailers, null, ['class'=>'form-control', 'multiple', 'id'=>'trailer'])!!}
                </div> 
                  @if($errors->has('trailerList'))<small class="help-block"> 
                  {{$errors->first('trailerList')}}</small>@endif 
                                      
              <div class="form-group">
                	{!!Form::label('online','Online Tracking System:')!!}
                    {!!Form::hidden('online','0ff',false)!!}
                	{!!Form::checkbox('online',null)!!}
              </div >
                            <button type="submit" class="btn btn-block">Update 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          {!!Form::close()!!}
     
<!--errors  -->
<p>   
<script>
$('#fleetForm').submit(function(){
	$('#contactForm').trigger('reset');
});
</script>  

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
