@extends ('layout.layout')

@section('content')
<div class="jumbotron">
        <h1>Add a new Alert</h1>
            <form method="POST" action="/alerts">
                <div class="form-group">
                        <label for="name">Alert Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Alert Name">
                </div>

                <div class="form-group">
                        <label for="keywords">Search Keywords</label>
                        <input type="text" class="form-control" id="keywords" placeholder="Search Keywords">
                </div>
                
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
</div>
@endsection()