@extends('layouts.app')
@section('title', 'Profile - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full text-center ml-0">
            <h1 class="text-3xl font-bold text-blue-700 mb-4">Profile</h1>
            <div class="flex flex-col items-center gap-4 mb-6">
                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-2 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff&size=128"
                        alt="User Avatar" class="w-24 h-24 object-cover rounded-full">
                </div>
                <div>
                    <div class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="text-left text-gray-600 space-y-2">
                <div><span class="font-semibold">Role:</span> {{ Auth::user()->role ?? 'User' }}</div>
                <div><span class="font-semibold">Joined:</span>
                    {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</div>
            </div>
        </div>
    </div>
@endsection