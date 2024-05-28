@extends('admin.layout')

@section('body')
@include('success')
<table class="table">
    <thead>
        <td>{{__("message.Name")}}</td>
        <td>{{__("message.Price")}}</td>
        <td>{{__("message.Quantity")}}</td>
        <td>{{__("message.Image")}}</td>
        <td>{{__("message.Action")}}</td>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>
                {{ $product->name }}
            </td>
            <td>
                ${{$product->price}}
            </td>
            <td>
                {{$product->quantity}}
            </td>
            <td width="20%">
                <img src="{{asset("storage/$product->image")}}" alt="" style="width: 30%; height: 50%;">
            </td>
            <td>
                <div class="dropdown">
                    <button aria-expanded="false" aria-haspopup="true"
                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                        type="button">actions<i class="text-danger fas fa-trash-alt"></i></button>
                    <div class="dropdown-menu tx-13">
                        {{-- Restore --}}
                        <a class="dropdown-item" href="{{url("archive/restore/$product->id")}}">
                            <div class="btn btn-info">Restore</div>
                        </a>

                        {{-- delete --}}
                        <form action="{{url("archive/delete/$product->id")}}" method="post">
                            @csrf
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-danger mt-2">{{(__("message.Delete"))}}</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{--  --}}
@endsection