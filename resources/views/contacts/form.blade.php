<div class="panel-body">
              <div class="form-horizontal">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="name" class="col-md-3 control-label">Name</label>
                      <div class="col-md-8">
                        <!-- <input type="text" name="name" id="name" class="form-control"> -->
                        {{Form::text('name' ,null, ['class'=> 'form-control']) }}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="company" class="col-md-3 control-label">Company</label>
                      <div class="col-md-8">
                        <!-- <input type="text" name="company" id="company" class="form-control"> -->
                        {{Form::text('company',null, ['class'=> 'form-control'])}}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email" class="col-md-3 control-label">Email</label>
                      <div class="col-md-8">
                        <!-- <input type="text" name="email" id="email" class="form-control"> -->
                        {{Form::text('email',null, ['class'=> 'form-control'])}}

                      </div>
                    </div>

                    <div class="form-group">
                      <label for="phone" class="col-md-3 control-label">Phone</label>
                      <div class="col-md-8">
                        <!-- <input type="text" name="phone" id="phone" class="form-control"> -->
                        {{Form::text('phone',null, ['class'=> 'form-control'])}}

                      </div>
                    </div>

                    <div class="form-group">
                      <label for="name" class="col-md-3 control-label">Address</label>
                      <div class="col-md-8">
                        <!-- <textarea name="address" id="address" rows="3" class="form-control"></textarea> -->
                        {{Form::textarea('address',null, ['class'=> 'form-control', 'rows' => 3])}}

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="group" class="col-md-3 control-label">Group</label>
                      <div class="col-md-5">
                      {{Form::select('group', $groups, ! empty($contact->group_id ) ? "$contact->group_id": "" , ['class'=> 'form-control','placeholder'=>'Choose group'] )}}
                       <!-- {{Form::select('group', $groups,! empty($contact->group_id ) ? "selected": "",['class'=> 'form-control','placeholder'=>'Choose group'] )}} -->
                      </div>
                      <div class="col-md-3">
                        <a href="#" id="add-group-btn" class="btn btn-default btn-block">Add Group</a>
                      </div>
                    </div>
                    <div class="form-group" id="add-new-group" style="display; none;">
                      <div class="col-md-offset-3 col-md-8">
                        <!-- <div class="input-group">
                          <input type="text" class="form-control" name="group_id" placeholder="Enter group name" aria-label="Enter group name" aria-describedby="button-addon2">
                          <span class="input-group-btn">
                            <a class="btn btn-default" type="button" id="button-addon2">
                              <i class="glyphicon glyphicon-ok"></i>
                            </a>
                          </span>
                        </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                        <!-- <img src="http://via.placeholder.com/150x150"  alt="photo"> -->
                        @if($contact->image != null)
                            {!!Html::image('uploads/'. $contact->image, $contact->name, ['class' => 'media-object' , 'widh'=> 100 , 'height' =>100]) !!}
                          @else
                          <img src="/uploads/default.png" style="height:100%; width:100%;"/>
                            @endif
                      </div>
                      <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div> -->
                      <div class="text-center">
                        <span class=" btn-file">{{Form::file('image',[ 'accept' => 'image/*'])}}</span>
                        <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-6">
                        <button type="submit" class="btn btn-primary">{{ ! empty($contact->id) ? "Update" : "Save"}}</button>
                        <a href="#" class="btn btn-default">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>