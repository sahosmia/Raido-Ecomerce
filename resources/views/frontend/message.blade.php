@extends('layouts.backend')

{{-- nav active satatus --}}
@section('message')
    active
@endsection

{{-- nav active satatus --}}
@section('page_title')
    Dasboard
@endsection

{{-- nav active satatus --}}
@section('exta_css')
        <link rel="stylesheet" href="{{ asset('backend/vendors/bundle.css" type="text/css') }}">
@endsection

@section('content')
<div class="row no-gutters chat-block">

        <!-- begin::chat sidebar -->
        <div class="col-lg-4 chat-sidebar">

            <!-- begin::chat sidebar search -->
            <div class="chat-sidebar-header">
                <h3 class="mb-4">Chats</h3>
                <form class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search chat">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light" type="button">
                                <i class="ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- begin::chat sidebar search -->

            <!-- end::chat list -->
            <div class="chat-sidebar-content">
                <div class="tab-content pt-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="chat-lists">
                            <div class="list-group list-group-flush">
                                @foreach ($messages as $item)
                                @php
                                    $name = $item->name;
                                    $first_latter = strtoupper(substr($name, 0,1));
                                    if($first_latter == "A" || $first_latter == "G" || $first_latter == "M" || $first_latter == "S" || $first_latter == "Y"){
                                        $color = "primary";
                                    }
                                    elseif($first_latter == "B" || $first_latter == "H" || $first_latter == "N" || $first_latter == "T" || $first_latter == "Z"){
                                        $color = "secondary";
                                    }
                                    elseif($first_latter == "C" || $first_latter == "I" || $first_latter == "O" || $first_latter == "U"){
                                        $color = "success";
                                    }
                                    elseif($first_latter == "D" || $first_latter == "J" || $first_latter == "P" || $first_latter == "V"){
                                        $color = "danger";
                                    }
                                    elseif($first_latter == "E" || $first_latter == "K" || $first_latter == "Q" || $first_latter == "W"){
                                        $color = "warning";
                                    }
                                    elseif($first_latter == "F" || $first_latter == "L" || $first_latter == "R" || $first_latter == "X"){
                                        $color = "info";
                                    }

                                @endphp

                                <a href="{{ url('message/view') }}/{{ $item->id }}" class="list-group-item d-flex align-items-center {{ $messages_id->id == $item->id ? "active" : "" }}">
                                    <div class="pr-3">
                                        <div class="avatar">
                                            <span class="avatar-title bg-{{ $color }} rounded-circle">{{ $first_latter }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item->name }}</h6>
                                        <span class="text-muted">{{ $item->message }}</span>
                                    </div>
                                    <div class="text-right ml-auto d-flex flex-column">
                                        <span class="small text-muted">{{ $messages_id->created_at->format('h:i A, d M, Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end::chat list -->

        </div>
        <!-- end::chat sidebar -->

        <!-- begin::chat content -->
        <div class="col-lg-8 chat-content">

            <!-- begin::chat header -->
            <div class="chat-header border-bottom">
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                          @php
                        $name = $messages_id->name;
                        $first_latter = strtoupper(substr($name, 0,1));
                        if($first_latter == "A" || $first_latter == "G" || $first_latter == "M" || $first_latter == "S" || $first_latter == "Y"){
                            $color = "primary";
                        }
                        elseif($first_latter == "B" || $first_latter == "H" || $first_latter == "N" || $first_latter == "T" || $first_latter == "Z"){
                            $color = "secondary";
                        }
                        elseif($first_latter == "C" || $first_latter == "I" || $first_latter == "O" || $first_latter == "U"){
                            $color = "success";
                        }
                        elseif($first_latter == "D" || $first_latter == "J" || $first_latter == "P" || $first_latter == "V"){
                            $color = "danger";
                        }
                        elseif($first_latter == "E" || $first_latter == "K" || $first_latter == "Q" || $first_latter == "W"){
                            $color = "warning";
                        }
                        elseif($first_latter == "F" || $first_latter == "L" || $first_latter == "R" || $first_latter == "X"){
                            $color = "info";
                        }

                    @endphp
                       <div class="avatar">
                            <span class="avatar-title bg-{{ $color }} rounded-circle">{{ $first_latter }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">{{ $messages_id->name }}</p>
                        <p class="mb-0">{{ $messages_id->email }}</p>
                    </div>
                    <div class="ml-auto">
                        <ul class="nav align-items-center">
                            <li class="d-sm-inline d-none dropdown">
                                <a href="#" title="More options" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">Profile</a>
                                    <a href="#" class="dropdown-item">Add contact</a>
                                    <a href="#" class="dropdown-item text-danger">Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end::chat header -->

            <!-- begin::messages -->
            <div class="messages">
                <div class="message-item">
                    <div class="message-item-content">{{ $messages_id->message }}</div>
                    <span class="time small text-muted font-italic">{{ $messages_id->created_at->format('h:i A, d M, Y') }}</span>
                </div>
            </div>
            <!-- end::messages -->
        </div>
        <!-- begin::chat content -->

    </div>

@endsection
@section('exta_js')
<script src="{{ asset('backend/vendors/bundle.js') }}"></script>

@endsection

