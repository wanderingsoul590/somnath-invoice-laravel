<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Name</label>
            {!! Form::text('name',Input::old('name'), ['class' => 'form-control','id'=>"name",'placeholder'=>'Enter Name']) !!} 
        </div>                                   
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Phone</label>
            {!! Form::text('number',Input::old('number'), ['class' => 'form-control','id'=>"number",'placeholder'=>'Enter Phone Number']) !!} 
        </div>                                  
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-email">GST</label>
            {!! Form::text('gst',Input::old('gst'), ['class' => 'form-control','id'=>"gst",'placeholder'=>'Enter GST']) !!}
        </div>
    </div>    
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="basic-default-name">Company</label>
            {!! Form::text('company',Input::old('company'), ['class' => 'form-control','id'=>"company",'placeholder'=>'Enter Company']) !!} 
        </div>                                  
    </div> 
    <div class="col-md-9">
        <div class="form-group">
            <label for="accountTextarea">Address</label>
            {!! Form::textarea('address',Input::old('address'), ['class' => 'form-control', 'id' => "address", 'rows' => '4', 'placeholder' => 'Enter Your Address']) !!} 
        </div>                                  
    </div>                                                                   
</div>     
            
<div class="row">
    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
        @if(isset($data->id))
        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 submitbutton" name="submit" value="Submit">Update</button>&nbsp;
        @else
        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 submitbutton" name="submit" value="Submit">Save</button>&nbsp;
        @endif
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
    </div>
</div>    
                                                                                                   