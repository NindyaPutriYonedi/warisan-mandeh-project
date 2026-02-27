@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Store Reviews</h3>

<div class="content-box">

<table class="table align-middle">
    <thead>
        <tr>
            <th>Name</th>
            <th>Rating</th>
            <th>Review</th>
            <th class="text-end">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($reviews as $r)
        <tr>
            <td>{{ $r->name }}</td>

            {{-- STAR RATING --}}
            <td>
                <div class="rating justify-content-start">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    @endfor
                </div>
            </td>

            <td>{{ $r->message }}</td>

            <td class="text-end">
                <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
