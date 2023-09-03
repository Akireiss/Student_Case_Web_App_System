@extends('layouts.app')
@section('content')
@include('components.nav')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-5">
    <!-- Left Col -->
    <div class="flex flex-col justify-center items-center md:items-start text-center lg:text-left">
      <p class="uppercase tracking-loose w-full">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</p>
      <h1 class="my-1 text-5xl font-bold leading-tight text-black text-left">
        A Happy School,
      </h1>
      <h1 class="my-1 text-5xl font-bold leading-tight text-black text-left">
        Sustaining Excellence.
      </h1>
    </div>

    <!-- Right Col -->
    <div class="py-6 text-center">
      <img class="w-full md:w-1/2  z-50" src="{{ url('assets/image/main.svg') }}" />
    </div>
  </div>

  <div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
          <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
          <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
          <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
        </g>
      </g>
    </svg>
  </div>

@endsection
