@if(!$products->isEmpty())
    <table class="table">
        <thead>
        <tr>
            <td width=10px>ID</td>
            <td width=500px>Name</td>
            <td width=200px><center>Cover</center></td>
            <td width=60px>Quantity</td>
            <td width=100px>Price</td>
            <td width=50px>Status</td>
            <td><center>Actions</center></td>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td><center>{{ $product->id }}</center></td>
                <td>
                    @if($admin->hasPermission('view-product'))
                        <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                    @else
                        {{ $product->name }}
                    @endif
                </td>
                <td><center><img src="{{ $product->cover }}" width="100%" height="100%"></center></td>
                <td><center>{{ $product->quantity }}</center></td>
                <td >{{ config('cart.currency') }} {{ $product->price }}</td>
                <td><center>@include('layouts.status', ['status' => $product->status])</center></td>
                <td>
                    <center>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                            @if($admin->hasPermission('update-product'))<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>@endif
                            @if($admin->hasPermission('delete-product'))<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>@endif
                        </div>
                    </form>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif