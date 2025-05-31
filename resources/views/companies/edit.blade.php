@extends('layouts.app')
@section('title', 'Edit ' . $company->name . ' - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('companies.show', $company) }}" class="text-gray-500 hover:text-blue-600">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Company</h1>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Name -->
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('website') border-red-500 @enderror"
                                placeholder="https://example.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $company->location) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-500 @enderror"
                                placeholder="City, Country">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry -->
                        <div>
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                            <input type="text" name="industry" id="industry"
                                value="{{ old('industry', $company->industry) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('industry') border-red-500 @enderror"
                                placeholder="e.g. Technology, Finance">
                            @error('industry')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                required>
                                <option value="active" {{ old('status', $company->status) === 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive" {{ old('status', $company->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="col-span-2">
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                            <div class="flex items-center space-x-4">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}"
                                        class="w-16 h-16 rounded-lg object-cover">
                                @endif
                                <input type="file" name="logo" id="logo"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('logo') border-red-500 @enderror"
                                    accept="image/*">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Leave empty to keep current logo</p>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                placeholder="Tell us about the company...">{{ old('description', $company->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('companies.show', $company) }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection