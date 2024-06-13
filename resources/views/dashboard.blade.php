<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Shop!!') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">List Product</h1>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Updated At</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" width="100">
                                </td>
                                <td class="align-middle">{{ $product->title }}</td>
                                <td class="align-middle">{{ $product->category }}</td>
                                <td class="align-middle">{{ $product->price }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($product->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($product->updated_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Product not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 2000); // 2000ms = 2 seconds
        });
    </script>
</x-app-layout>