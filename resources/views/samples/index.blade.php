@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Samples</h2>
            </div>
            <div class="pull-right">
                @can('sample-create')
                <a class="btn btn-success" href="{{ route('samples.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($samples as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>
                <form action="{{ route('samples.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('samples.show',$product->id) }}">Show</a>
                    @can('sample-edit')
                    <a class="btn btn-primary" href="{{ route('samples.edit',$product->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('sample-delete')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $samples->links() !!}


<p class="text-center text-primary"><small>Testing Footer</small></p>
@endsection