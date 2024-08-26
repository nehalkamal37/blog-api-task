<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Dashboard Section -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a href="{{route('posts.create')}}" class="navbar-brand" ><h3 style="color: rgb(22, 124, 124)">
                Create Post</h3></a></a>
            <div class="d-flex align-items-center">
                <!-- User Info -->
                <img src="{{asset('user.png')}}" alt="User Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                <div class="me-3">
                    <h6 class="mb-0"> {{Auth::user()->name}}</h6>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"> Log Out</button>
                </form>
            </div>
            <a href="{{route('home.index')}}" class="navbar-brand" style="color: rgb(22, 124, 124)" >Home Page</a>

        </div>
    </nav>
    @if(Session('success'))
    <div class="alert alert-success" role="alert">
    {{Session('success')}}</div>
    @endif

    <div class="container mt-5">
        <!-- Post Section -->
        @if(count($posts) == 0 ) <h3 style="color: rgb(22, 124, 124)">no posts yet</h3> @endif

        @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title"> {{$post->title}}</h2>
                <small class="text-muted">by :  {{$post->user->name }} </small>
            </div>
            <div class="card-body">
                <p class="card-text">{{$post->content}}
                </p>
                <a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">edit</a>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
    delete
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">delete post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        are you shure you want to elete this!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{ route('posts.destroy',$post->id)}}" method="POST">
            @csrf
            @method('DELETE')
          <button type="submit" class="btn btn-danger">delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
                      
            </div>
        </div>
       

        <!-- Comments Section -->
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

                    @if(Auth::user()->id == $comment->user->id)
                    <form action="{{ route('comments.destroy',$comment->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger">delete</button>
                      </form>
                      @endif
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
    @endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>