@extends ('layout.layout')

@section('content')
<div class="jumbotron">
        <h1>Add a new Alert</h1>
            <form method="POST" action="/alerts">
                @csrf
                <div class="form-group">
                        <label for="name">Alert Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Alert Name">
                </div>

                <div class="form-group">
                        <label for="keywords">Search Keywords</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Search Keywords">
                </div>
                
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
</div>
@endsection()