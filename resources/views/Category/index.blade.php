@extends('layout.index')
@section('title','Category Home')

@section('content')
<table class="table text-center">
    <thead>
        <tr>
            <th>Parent Category Name</th>
            <th>child</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody id="bodytable">
        @foreach ($parents as $par)
        <tr>
            <td>
                {{ $par->C_Name }}
            </td>
            <td>
                @method('delete')
                <button name="childs" id="childs" a="{{ $par->id }}" onclick="cli({{ $par->id }})"
                    class="btn btn-primary">Show Childs</button>
            </td>
          
            <td>

                <a class="btn btn-dark" href="/category/{{ $par->id }}" role="button">
                <i class="fas fa-pencil-alt    "></i></a>
                    
            </td>
            <td>
            <form method="post" action="/category/{{ $par->id }}">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <button type=" submit" class="btn btn-danger"><i class="fas fa-trash    "></i> </button>
            </form>
            </td>

        </tr>

        @endforeach


    </tbody>
</table>
@endsection
@section('scripts')
<script>
    function cli(d){
      console.log(d);
        
     
      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/category/childs",
        type:"POST",
        data:{
          id:d,
          _token: _token
        },
        success:function(response){
          console.log(response);
        
          $('#bodytable').empty();
          const data = "Children";
          const nodata = "0";
          const hide ="hidden";
//           if(response[1]){
// console.log('true');
//           }else{
// console.log('false')
//           }
         response[0].forEach(element => {
             if(element.childs>0){
                $('#bodytable').append (
          `<tr>
            <td>
                `+element.C_Name+` 
            </td>
            
            <td>
                <button name="childs" id="childs" a="`+element.id+`" onclick="cli(`+element.id+`)"
                    class="btn btn-primary"
               >
                    Show Childs 
                    </button>
            </td>
            <td>
                <form method="post" action="/category/`+element.id+`">
                    <input type="hidden" name="_token" value="`+_token+`">
                    <input type="hidden" name="_method" value="delete">
                <button type=" submit" class="btn btn-danger"><i class="fas fa-trash    "></i> </button>
                </form>
            </td>

        </tr>`)
             }else{
                $('#bodytable').append (
          `<tr>
            <td>
                `+element.C_Name+` 
            </td>
            
            <td>
          <p> No Children </p>
            </td>
            <td>
                <form method="post" action="/category/`+element.id+`">
                    <input type="hidden" name="_token" value="`+_token+`">
                    <input type="hidden" name="_method" value="delete">
                <button type=" submit" class="btn btn-danger"><i class="fas fa-trash    "></i> </button>
                </form>
            </td>

        </tr>`)
             }
      
         });
        },
       });
  };

</script>
@endsection