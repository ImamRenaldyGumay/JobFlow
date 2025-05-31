@extends('layouts.app')
@section('title', 'Add Company - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Add New Company</h1>
            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-4">
                        <i class="fa fa-building fa-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Company Information</h2>
                        <p class="text-gray-500 text-base">Fill in the details below to add a new company to your tracker.
                        </p>
                    </div>
                </div>

                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" required value="{{ old('name') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                                placeholder="e.g. Google">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" value="{{ old('website') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                                placeholder="e.g. https://www.google.com">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                                placeholder="e.g. Mountain View, CA">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                            <input type="text" name="industry" value="{{ old('industry') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                                placeholder="e.g. Technology">
                            @error('industry')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status <span
                                    class="text-red-500">*</span></label>
                            <select name="status" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                            <input type="file" name="logo" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            @error('logo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                                placeholder="Enter company description...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('companies.index') }}"
                            class="text-gray-500 hover:text-blue-600 font-medium flex items-center">
                            <i class="fa fa-arrow-left mr-2"></i>Back to Companies
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold shadow transition flex items-center gap-2">
                            <i class="fa fa-save"></i> Save Company
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection