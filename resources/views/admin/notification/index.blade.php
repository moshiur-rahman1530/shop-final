@extends('admin.layouts.app')
@section('title','Banner')
@section('content')

<div class="card">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{session('success')}}
                </div>
            @endif


            @if(session('error'))
                <div class="alert alert-danger alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{session('error')}}
                </div>
            @endif
        </div>
    </div>
  <h5 class="card-header">Notifications</h5>
  <div class="card-body">
    @if(count(Auth::user()->Notifications)>0)
    <table class="table  table-hover admin-table" id="notification-dataTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Time</th>
          <th scope="col">Title</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( Auth::user()->Notifications as $notification)

        <tr class="@if($notification->unread()) bg-light border-left-light @else border-left-success @endif">
          <td scope="row">{{$loop->index +1}}</td>
          <td>{{$notification->created_at->format('F d, Y h:i A')}}</td>
          <td>{{$notification->data['name']}}</td>
          <td>
            <a href="{{route('admin.notification', $notification->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
            <form method="POST" action="{{ route('notification.delete', $notification->id) }}">
              @csrf
              @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$notification->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
    @else
      <h2>Notifications Empty!</h2>
    @endif
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">

        $('#notification-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }

        $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this data!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                    form.submit();
                  } else {
                      swal("Your data is safe!");
                  }
              });
        })
    })

</script>
@endsection
