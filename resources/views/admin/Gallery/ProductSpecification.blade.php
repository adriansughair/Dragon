@extends('layouts.app')

@section('content')
   <div class="container mt-5 ">
   <a  href="{{ url('viewAddCategory') }}">
     <button type="button" class="btn btn-success justify-content-center ">Add Category</button>
   </a>   
   <?php $count =1?>
    @foreach($dataCategory as $Category)
       <h4 class="container mt-5 ">   {{ $Category->NameCategory }}</h4>
       <div class="container d-flex justify-content-center ">
            <table class="table  table-striped"> 
              <thead>
               <tr>
                 <th>Item</th>
                 <th> 
                 
                    <div class="d-flex">
                    
                     <a href="{{url('/viewEditCategory/'.$Category->id)}}" class="mr-1">
                       <button type="button" class="btn btn-dark"  >Edit</button>
                     </a> 
                 
                     <form action="{{url('delete/Category/'.$Category->id)}}" method="POST"> 
                         @csrf
                         <input type="hidden" name="_method" value="delete">
                         <button type="submit" class="btn btn-danger" value="Delete">delete  </button>
                      </form> 
                    </div>  
                </ul>
                 </th>
                 
               </tr> 
              </thead>
              <tbody>
              @foreach($dataItme as $Itme)
             
              @if($Category->id == $Itme->categories_id)
              <tr>
                <td>saasc</td>
                <td></td>
               
              </tr> 
              @endif
              @endforeach  
              </tbody>
        
            </table>
        
        
            </div>

      @endforeach
<!-- Button trigger modal -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
var focus = 0,
blur = 0;
$( "p" )
.focusout(function() {
  focus++;
  $( "#focus-count" ).text( "focusout fired: " + focus + "x" );
})
.blur(function() {
  blur++;
  $( "#blur-count" ).text( "blur fired: " + blur + "x" );
});
</script>
@endsection
