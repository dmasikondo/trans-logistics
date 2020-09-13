
  <!-- Modal -->
  <div class="modal fade" id="directorModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-hand-left"></span> Directors</h4>
        </div>
        <div class="modal-body">
    @if(count($user->director)>0) 
    	@foreach($user->director as $dir)
          {!!Form::model($dir,['action'=>['DirectorsController@update',$dir->id],
          'class'=>'role','method'=>'PATCH','id'=>'directorForm'])!!}
       	@endforeach
    @else
          {!!Form::open(['action'=>['DirectorsController@store'],
          'class'=>'role','id'=>'directorForm'])!!}
          {!!Form::hidden('user_id',$user->id)!!}    
   	@endif
            <div class="form-group has-feedback {{ $errors->has('name1') ? ' has-error' : '' }}">
              <label for="name1"><span class="glyphicon glyphicon-list"></span> Director1's Name</label>
              {!!Form::text('name1',null,['class'=>'form-control', 'placeholder'=>'Director1 Name?','id'=>'name1'])!!}
            </div>
              @if ($errors->has('name1'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('name1') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('address1') ? ' has-error' : '' }}">
              <label for="address1"><span class="glyphicon glyphicon-tent"></span> Address1</label>
              {!!Form::text('address1',null, ['class'=>'form-control',
               'id'=>'address1', 'placeholder'=>'Director1 Address?'])!!}
            </div>
              @if ($errors->has('address1'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('address1') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('phone1') ? ' has-error' : '' }}">
              <label for="phone1"><span class="glyphicon glyphicon-phone"></span> Contact Phone</label>
              {!!Form::text('phone1',null, ['class'=>'form-control',
               'id'=>'phone1', 'placeholder'=>'Director1 Phone?'])!!}
            </div>
              @if ($errors->has('phone1'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('phone1') }}</strong>
                  </small>
               @endif
                                      
            <div class="form-group has-feedback {{ $errors->has('name2') ? ' has-error' : '' }}">
              <label for="name2"><span class="glyphicon glyphicon-list"></span> Director2's Name </label>
              {!!Form::text('name2',null,['class'=>'form-control', 'placeholder'=>'Name2?','id'=>'name2'])!!}
            </div>
              @if ($errors->has('name2'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('name2') }}</strong>
                  </small>
              @endif   
            <div class="form-group has-feedback {{ $errors->has('address2') ? ' has-error' : '' }}">
              <label for="address1"><span class="glyphicon glyphicon-tent"></span> Address2</label>
              {!!Form::text('address2',null, ['class'=>'form-control',
               'id'=>'address2', 'placeholder'=>'Director2 Address?'])!!}
            </div>
              @if ($errors->has('address2'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('address2') }}</strong>
                  </small>
               @endif
            <div class="form-group has-feedback {{ $errors->has('phone2') ? ' has-error' : '' }}">
              <label for="phone2"><span class="glyphicon glyphicon-phone"></span> Contact Phone</label>
              {!!Form::text('phone2',null, ['class'=>'form-control',
               'id'=>'phone2', 'placeholder'=>'Director2 Phone?'])!!}
            </div>
              @if ($errors->has('phone2'))
                  <small class="help-block  col-md-offset-4">
                      <strong>{{ $errors->first('phone2') }}</strong>
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
