@extends('layouts.main')

@section('content')

 <!-- content -->
 
            <div class="panel panel-default" >
              <table class="table">
              @foreach($contacts as $contact)
                <tr>
                  <td class="middle">
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <!-- <img class="media-object" src="http://placehold.it/100x100" alt="..."> -->
                          <!-- @if($contact->image != null)
                            <img src="{{ URL('/') }}/uploads/{{$contact->image}}" style="max-height:50px"/>
                            @else
                                No image
                          @endif -->
                          
                          @if($contact->image != null)
                            {!!Html::image('uploads/'. $contact->image, $contact->name, ['class' => 'media-object' , 'widh'=> 100 , 'height' =>100]) !!}
                          @else
                          <img src="/uploads/default.png" style="height:100px"/>
                            @endif
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">{{$contact->name}}</h4>
                        <address>
                          <strong>{{$contact->company}}</strong><br>
                          {{$contact->email}}
                        </address>
                      </div>
                    </div>
                  </td>
                  <td width="100" class="middle">
                    <div>
                    {!!Form::open(['method' => 'DELETE', 'route'=>['contacts.destroy',$contact->id]])!!}
                    <a href="{{ route('contacts.edit', ['contact' => $contact->id]) }}" class="btn btn-circle btn-default btn-xs" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      <button onclick="return confirm('Are you sure you want to delete it')" class="btn btn-circle btn-danger btn-xs" title="Delete">
                        <i class="glyphicon glyphicon-remove"></i>
                      </button>
                    </div>
                    {!! Form::close()!!}
                  </td>
                </tr>
                @endforeach
                <!-- <tr>
                  <td class="middle">
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="http://placehold.it/100x100" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Contact 2</h4>
                        <address>
                          <strong>Job 2</strong><br>
                          contact2@sample.com
                        </address>
                      </div>
                    </div>
                  </td>
                  <td width="100" class="middle">
                    <div>
                      <a href="#" class="btn btn-circle btn-default btn-xs" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      <a href="#" class="btn btn-circle btn-danger btn-xs" title="Edit">
                        <i class="glyphicon glyphicon-remove"></i>
                      </a>
                    </div>
                  </td>
                </tr> -->
              </table>    

            </div>
            <div class="text-center">
                  <nav >
                      <!-- <ul class="pagination">
                        <li >
                          <a href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span> 
                          </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        
                        <li >
                          <a  href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span> 
                          </a>
                        </li>
                        
                      </ul> -->
                      {!! $contacts->appends( Request::query() )->render()!!}
                    </nav>
                    </div>
                   

@endsection