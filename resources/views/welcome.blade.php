<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Dashboard Section -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            @auth
            <a href="{{route('posts.create')}}"  class="navbar-brand" >
                <h3 style="color: rgb(22, 124, 124)">
                create post</h3></a>
           @endauth
            <div class="d-flex align-items-center">
                <!-- User Info -->
              @auth
                <div class="me-3">
                    <a href="{{route('posts.index')}}" style="color: rgb(22, 124, 124)" class="navbar-brand" >  My Posts</a>
                </div>
@endauth
                <!-- Logout Button -->
                @guest
                <div class="me-3">

                   <a href="{{route('login')}}"> <button type="submit" class="btn btn-outline-info"> Log In </button></a>
                </div>
                   <a href="{{route('register')}}"> <button type="submit" class="btn btn-outline-info"> Sign Up </button></a>
@endguest
@auth 
<form method="POST" action="{{ route('logout') }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-danger"> Log Out</button>
</form>
@endauth

            </div>
        </div>
    </nav>
    @if(Session('success'))
    <div class="alert alert-success" role="alert">
    {{Session('success')}}</div>
    @endif

    <div class="container mt-5">
        <!-- Post Section -->
        @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title">title: {{$post->title}}</h2>
                <small class="text-muted">by : {{$post->user->name }}  </small>
            </div>
            <div class="card-body">
                <p class="card-text">{{$post->content}}
                </p>
                <a href="#" class="btn btn-primary">تعديل</a>
                <a href="#" class="btn btn-danger">حذف</a>
            </div>
        </div>
       

        <!-- Comments Section -->
        <div class="card">
          
            <div class="card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    @foreach($post->comments as $comment)
    
                    <!-- Example Comment -->
                    <div class="comment mb-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold">{{$comment->user->name}} </h6>
                            <small class="text-muted"> {{$comment->created_at}}</small>
                        </div>
                        <p> {{$comment->content}}</p>

                        @auth
                        @if(Auth::user()->id == $comment->user->id)
                        <form action="{{ route('comments.destroy',$comment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger">delete</button>
                          </form>
                          @endif
                          @endauth
                    </div>
    
                
    @endforeach
                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <label for="comment" class="form-label">أضف تعليق:</label>
                            <textarea name="content" class="form-control" id="comment" rows="3" placeholder="اكتب تعليقك هنا"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">إرسال التعليق</button>
                    </form>
                </div>
              
        </div>
    </div>
    @endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>