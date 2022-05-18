@extends('user.template.base')
@section('title', 'Your Posts')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <h4 class="card-title">Your Post List</h4>
                        <p class="card-description">
                            {{ auth()->user()->name }} <code><a href="{{ route('user.create-post') }}"
                                    class="btn btn-outline-primary btn-sm">Crate Post</a></code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Content
                                        </th>
                                        <th>
                                            Images
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($post as $post)
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td style="word-wrap: break-word;">
                                                {{ $post->content }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/thumbnail/' . $post->image) }}" alt="image"
                                                     />
                                            </td>
                                            <td>
                                              <form action="{{ route('user.delete.post', $post->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('user.edit.post', $post->id) }}">
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>
                                                  <button type="submit" class="btn btn-danger">
                                                        <i class="remove ti-close"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                        <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
