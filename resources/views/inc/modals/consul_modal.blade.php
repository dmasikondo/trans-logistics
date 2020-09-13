@if(Auth::check()) <!-- if logged in -->

<script>
$(function(){
$('#date_required').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>

  <!-- Modal -->
  <div class="modal fade" id="consulModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-cog"></span> Consultancy - Please fill in this form & we will contact you</h4>
        </div>
        <div class="modal-body">
    @if($user->consultancy->count()) 
    	@foreach($user->consultancy as $consul)
          {!!Form::model($consul,['action'=>['ConsultationController@store',$consul->id],
          'class'=>'role','method'=>'PATCH','id'=>'coonsulForm'])!!}
       	@endforeach
    @else
          {!!Form::open(['action'=>['ConsultationController@store'],
          'class'=>'role','id'=>'consulForm1'])!!}
          {!!Form::hidden('user_id',$user->id)!!}   
           <input type="hidden" name="modal_id" value="consulModal" /> 
   	@endif
            <div class="form-group has-feedback {{ $errors->has('requirements') ? ' has-error' : '' }}">
              <label for="requirements"><span class="glyphicon glyphicon-tasks"></span> Required?</label>
              {!!Form::text('requirements',null,['class'=>'form-control', 
              	'placeholder'=>'Service required','id'=>'requirements'])!!}
            </div>
              @if ($errors->has('requirements'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('requirements') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description"><span class="glyphicon glyphicon-comment"></span> Description</label>
              {!!Form::text('description',null, ['class'=>'form-control',
               'id'=>'description', 'placeholder'=>'Tell us more'])!!}
            </div>
              @if ($errors->has('description'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('description') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('date_required') ? ' has-error' : '' }}">
              <label for="date_required"><span class="glyphicon glyphicon-calendar"></span> Date required</label>
              {!!Form::text('date_required',null, ['class'=>'form-control',
               'id'=>'date_required', 'placeholder'=>'When?'])!!}
            </div>
              @if ($errors->has('date_required'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('date_required') }}</strong>
                  </small>
               @endif               
              <button type="submit" class="btn btn-block">Request 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          {!!Form::close()!!}
  <p>  
@if($errors->all()) 
  <script>
	$('#consulModal').modal('show');
</script>
@endif
 </p>    
  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p></p>
        </div>
       
      </div>
    </div>
  </div>

@endif