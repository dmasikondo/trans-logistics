<script>
$(function(){
$('#date_required').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
  <!-- Modal -->
  <div class="modal fade" id="bidModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-usd"></span> Place a Freight Bid</h4>
        </div>
        <div class="modal-body">
        <?php if(!$fre->bidByUser()){ $pickupdate = null;}else{$pickupdate= $mybid->pickup_date;}?>
  @if($errors->any())
  	<ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    	<li>{{$error}}</li>
    @endforeach
    </ul>
  @endif

  @if($fre->bidByUser())    
          {!!Form::model($mybid,['action'=>['BidsController@update',$mybid->id],
          'class'=>'role','method'=>'PATCH','id'=>'bidsForm'])!!}
            {!!Form::hidden('freight_id',$fre->id)!!} 
            
 @else
          {!!Form::open(['action'=>['BidsController@store'],
          'class'=>'role','id'=>'bidsForm1'])!!}
          {!!Form::hidden('freight_id',$fre->id)!!}  
           
@endif
			<p>Shipper preferred pick up date is: {{$fre->datefrom->format('l d F Y')}}, which is 
            	<kbd>{{$fre->datefrom->diffForHumans()}}</kbd>
            <div class="form-group has-feedback {{ $errors->has('amt') ? ' has-error' : '' }}">
              <label for="name"><span class="glyphicon glyphicon-usd"></span> Your Offer Price $</label>
              {!!Form::text('amt',null,['class'=>'form-control', 'placeholder'=>'How much in US$?','id'=>'amt'
               ])!!}
            </div>
              @if ($errors->has('amt'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('amt') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('pickup_date') ? ' has-error' : '' }}">
              <label for="pickup_date"><span class="glyphicon glyphicon-calendar"></span> Proposed pickup date</label>
              {!!Form::date('pickup_date', $pickupdate, ['class'=>'form-control',
               'id'=>'date_required', 'placeholder'=>'When?'])!!}
            </div>
              @if ($errors->has('pickup_date'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('pickup_date') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('vehicle_location') ? ' has-error' : '' }}">
              <label for="vehicle_location"><span class="glyphicon glyphicon-calendar"></span>Current vehicle location</label>
              {!!Form::text('vehicle_location', null, ['class'=>'form-control',
               'id'=>'date_required', 'placeholder'=>'Where is this vehicle?'])!!}
            </div>
              @if ($errors->has('vehicle_location'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('vehicle_location') }}</strong>
                  </small>
               @endif  
            <div class="form-group has-feedback {{ $errors->has('regno') ? ' has-error' : '' }}">
              <label for="regno"><span class="glyphicon glyphicon-calendar"></span>Truck Reg No</label>
              {!!Form::text('regno', null, ['class'=>'form-control',
               'placeholder'=>'Truck Reg No.'])!!}
            </div>
              @if ($errors->has('regno'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('regno') }}</strong>
                  </small>
               @endif                            
              <button type="submit" class="btn btn-block">Place Bid 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
              
            
          {!!Form::close()!!}


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
