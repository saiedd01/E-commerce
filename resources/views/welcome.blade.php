@extends('user.layout')

@section('title')
    <title> Home </title>
@endsection

@section('latest')
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>{{ __('message.Latest Products') }}</h2>
                        <a href="products.html">{{ __('message.View all products') }} <i class="fa fa-angle-right"></i></a>
                    </div>
                    {{-- Error Msg --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- Search --}}
                    <form action="{{ url('search') }}" method="get" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="key" class="form-control" placeholder="Search..."
                                aria-label="Search" aria-describedby="button-search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-search">Search</button>
                            </div>
                        </div>
                    </form>
                    {{-- Sort Form --}}
                    <form action="{{ url('sort') }}" method="post" class="mb-4">
                        @csrf
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="sortDropdown">
                                <button class="dropdown-item" type="submit" name="sort" value="name_asc">Name
                                    ASC</button>
                                <button class="dropdown-item" type="submit" name="sort" value="name_desc">Name
                                    DESC</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" type="submit" name="sort" value="price_asc">Price
                                    ASC</button>
                                <button class="dropdown-item" type="submit" name="sort" value="price_desc">Price
                                    DESC</button>
                            </div>
                        </div>
                    </form>
                </div>
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="container w-100 h-100 mx-2 my-1">
                                <a href="{{ route('Show', ['id' => $product->id]) }}">
                                    <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}"
                                        style="width: 50%;"></a>
                            </div>
                            <div class="down-content">
                                <a href="{{ route('Show', ['id' => $product->id]) }}">
                                    <h4>{{ $product->name }}</h4>
                                </a>
                                <p>{{ $product->desc }}</p>
                                @if ($product->Discount != 0.0)
                                    <h5 style="color: green;">
                                        $@php
                                            $priceAfterDiscount = $product->price - $product->Discount;
                                            echo $priceAfterDiscount;
                                        @endphp
                                    </h5>
                                    <h6 style="text-decoration: line-through; color: red;">
                                        ${{ $product->price }}
                                    </h6>
                                @else
                                    <h6 style="color: green;">
                                        ${{ $product->price }}
                                    </h6>
                                @endif
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span>{{ __('message.Reviews') }} (24)</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{ $products->links() }}
@endsection
