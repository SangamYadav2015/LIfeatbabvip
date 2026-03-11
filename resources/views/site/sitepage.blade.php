@extends('site.layout.app')

@section('content')
@php
@endphp
@foreach($pageSectiponData as $item)
    @php
         $path = strtolower( preg_replace('/[^A-Za-z0-9]/', '-',$item->section->section_name));
         $sectionName = strtolower( preg_replace('/[^A-Za-z0-9]/', '', $item->sectionStyle->section_style_name));
        // Generate the view path dynamically
         $viewPath = 'site.' . $path . '.' . $sectionName;
    @endphp
    {{-- Check if the view exists before including it --}}
    @if(view()->exists($viewPath))
        @include($viewPath, ['page_data' => $item->page_section_data])
    @else
        {{-- Handle case where view doesn't exist --}}
        <p>View {{ $viewPath }} not found.</p>
    @endif
@endforeach


@endsection