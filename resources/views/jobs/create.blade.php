@extends('layouts.app')
@section('title', 'Add Job - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Add New Job</h1>
            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-4">
                        <i class="fa fa-briefcase fa-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Job Application Form</h2>
                        <p class="text-gray-500 text-base">Fill in the details below to add a new job application to your
                            tracker.</p>
                    </div>
                </div>
                <form action="{{ route('jobs.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    @csrf
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="company_name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. Google">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="position" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. Frontend Developer">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. Mountain View, CA">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date Applied</label>
                        <input type="date" name="date_applied"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Applied Via</label>
                        <input type="text" name="applied_via"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. LinkedIn, Career Website, Jobstreet">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apply Link</label>
                        <input type="url" name="apply_link"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. https://www.linkedin.com/jobs/view/123">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Application Status</label>
                        <select name="application_status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option>Applied</option>
                            <option>Interview</option>
                            <option>Offer</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Result</label>
                        <input type="text" name="result"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            placeholder="e.g. Passed, Not Passed, -">
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400"
                            rows="3" placeholder="Additional notes..."></textarea>
                    </div>
                    <div class="col-span-1 md:col-span-2 flex justify-between items-center mt-6">
                        <a href="{{ route('jobs.index') }}"
                            class="text-gray-500 hover:text-blue-600 font-medium flex items-center"><i
                                class="fa fa-arrow-left mr-2"></i>Back to All Jobs</a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold shadow transition flex items-center gap-2"><i
                                class="fa fa-save"></i> Save Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection