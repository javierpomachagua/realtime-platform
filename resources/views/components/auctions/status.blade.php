@props(['status'])

@php
    use App\Enums\AuctionStatus;

    $statusColors = [
        AuctionStatus::Pending->value => 'bg-blue-100 text-blue-800',
        AuctionStatus::Active->value => 'bg-green-100 text-green-800',
        AuctionStatus::Closed->value => 'bg-gray-100 text-gray-800',
    ];
@endphp

<span
    class="relative z-10 rounded-full  px-3 py-1.5 font-medium uppercase {{ $statusColors[$status] }}">{{ $status }}</span>
