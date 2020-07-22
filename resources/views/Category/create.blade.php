@extends('layout.index')

@section('content')
<div class="row text-center">
    <div class="col">
        <form method="POST" action='{{ isset($EditCategory) ? "/category/$EditCategory->id" :"/category" }}''>
            @csrf
            @isset($EditCategory)
            @method(' put') <div class="form-group">
            
            <input type="hidden" class="form-control" name="ddd" id="ddd" value="{{ $EditCategory->id }}">

            @endisset


            <div class="form-group">
                <label for="Category Name">Category Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name"
                    value="{{ isset($EditCategory)? $EditCategory->C_Name:"" }}">

                <div class="form-group">
                    <label for="Category Description">Category Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"
                        placeholder="Description">{{ isset($EditCategory)? $EditCategory->C_Description:"" }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection